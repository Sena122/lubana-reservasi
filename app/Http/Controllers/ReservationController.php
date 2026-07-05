<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Menu;
use App\Models\MenuCategory;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    /**
     * ============================================
     * DASHBOARD ADMIN
     * ============================================
     */
    public function adminDashboard(Request $request)
    {
        $query = Reservation::query();

        // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('institution', 'LIKE', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter type
        if ($request->filled('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        // Statistics with optimization
        $stats = [
            'total' => Reservation::count(),
            'pending' => Reservation::where('status', 'pending')->count(),
            'confirmed' => Reservation::where('status', 'confirmed')->count(),
            'canceled' => Reservation::where('status', 'canceled')->count(),
            'done' => Reservation::where('status', 'done')->count(),
        ];

        // Growth calculation
        $lastMonth = Reservation::whereBetween('created_at', [now()->subMonth(), now()])->count();
        $previousMonth = Reservation::whereBetween('created_at', [now()->subMonths(2), now()->subMonth()])->count();
        $stats['growth'] = $previousMonth > 0 ? round((($lastMonth - $previousMonth) / $previousMonth) * 100) : null;

        // Canceled growth
        $lastMonthCanceled = Reservation::where('status', 'canceled')
            ->whereBetween('created_at', [now()->subMonth(), now()])
            ->count();
        $previousMonthCanceled = Reservation::where('status', 'canceled')
            ->whereBetween('created_at', [now()->subMonths(2), now()->subMonth()])
            ->count();
        $stats['canceled_growth'] = $previousMonthCanceled > 0
            ? round((($lastMonthCanceled - $previousMonthCanceled) / $previousMonthCanceled) * 100)
            : null;

        // Get reservations with pagination
        $reservations = $query->latest()->paginate(10);

        return view('admin.index', compact('reservations', 'stats'));
    }

    /**
     * ============================================
     * RESERVATION MANAGEMENT
     * ============================================
     */

    public function table(Request $request)
    {
        $query = Reservation::with('menus');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('institution', 'LIKE', "%{$search}%")
                    ->orWhere('saung_number', 'LIKE', "%{$search}%");
            });
        }

        // Date filter
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        // Area filter
        if ($request->filled('area') && $request->area !== '') {
            $query->where('area', $request->area);
        }

        // Status filter
        if ($request->filled('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Type filter
        if ($request->filled('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        $reservations = $query->latest()->paginate(15)->withQueryString();

        return view('admin.reservation.table', compact('reservations'));
    }

    public function create()
    {
        $categories = Menu::with('category')
            ->get()
            ->groupBy(function ($menu) {
                return $menu->category ? $menu->category->name : 'Uncategorized';
            });

        return view('admin.reservation.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'institution' => 'nullable|string|max:255',
                'address' => 'nullable|string',
                'date' => 'required|date|after_or_equal:today',
                'booking_time' => 'required|date_format:H:i',
                'session' => 'required|in:1,2,3',
                'area' => 'required|in:RESTO,MONSTER',
                'saung_number' => 'nullable|string|max:50',
                'guest_count' => 'required|integer|min:1|max:100',
                'special_note' => 'nullable|string',
                'down_payment' => 'nullable|numeric|min:0',
                'type' => 'required|in:REGULAR,VIP',
                'other_note' => 'nullable|string',
            ]);

            // Check availability
            $isAvailable = $this->checkAvailabilitySlot($validated['date'], $validated['booking_time']);
            if (!$isAvailable) {
                return back()->withInput()->with('error', 'Slot waktu sudah penuh! Silakan pilih waktu lain.');
            }

            $validated['dp_status'] = $request->has('dp_status') ? 1 : 0;
            $validated['down_payment'] = $validated['down_payment'] ?? 0;
            $validated['status'] = 'pending';
            $validated['created_by'] = Auth::id();

            $reservation = Reservation::create($validated);

            // Attach selected menus dari session
            if (Session::has('selected_menus') && count(Session::get('selected_menus')) > 0) {
                foreach (Session::get('selected_menus') as $item) {
                    $reservation->menus()->attach($item['id'], [
                        'quantity' => $item['qty'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal'] ?? ($item['price'] * $item['qty'])
                    ]);
                }
            }

            DB::commit();
            Session::forget('selected_menus');
            Session::forget('selected_menus_total');

            return redirect()->route('admin.reservation.table')
                ->with('success', '✅ Reservasi berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating reservation: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal membuat reservasi: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $reservation = Reservation::with(['menus' => function ($query) {
            $query->select('menus.*', 'reservation_menu.quantity', 'reservation_menu.subtotal');
        }])->findOrFail($id);

        // Calculate totals
        $totalMenuPrice = $reservation->menus->sum(function ($menu) {
            return $menu->pivot->subtotal ?? ($menu->price * $menu->pivot->quantity);
        });

        return view('admin.reservation.show', compact('reservation', 'totalMenuPrice'));
    }

    public function edit($id)
    {
        $reservation = Reservation::with(['menus' => function ($query) {
            $query->select('menus.*', 'reservation_menu.quantity');
        }])->findOrFail($id);

        // CEK: Apakah session sudah ada? Jika tidak, ambil dari database
        if (!Session::has('selected_menus') || count(Session::get('selected_menus')) == 0) {
            // Ambil menu yang sudah dipilih dari database
            $selectedMenus = [];
            foreach ($reservation->menus as $menu) {
                $selectedMenus[] = [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'price' => $menu->price,
                    'qty' => $menu->pivot->quantity,
                    'subtotal' => $menu->price * $menu->pivot->quantity
                ];
            }

            // Simpan ke session
            Session::put('selected_menus', $selectedMenus);

            // Hitung total
            $totalPrice = array_sum(array_column($selectedMenus, 'subtotal'));
            Session::put('selected_menus_total', $totalPrice);
        }

        // Get all menu categories
        $categories = Menu::with('category')
            ->get()
            ->groupBy(function ($menu) {
                return $menu->category ? $menu->category->name : 'Uncategorized';
            });

        return view('admin.reservation.edit', compact('reservation', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $reservation = Reservation::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'institution' => 'nullable|string|max:255',
                'address' => 'nullable|string',
                'date' => 'required|date',
                'booking_time' => 'required|date_format:H:i',
                'session' => 'required|in:1,2,3',
                'area' => 'required|in:RESTO,MONSTER',
                'saung_number' => 'nullable|string|max:50',
                'guest_count' => 'required|integer|min:1|max:100',
                'special_note' => 'nullable|string',
                'down_payment' => 'nullable|numeric|min:0',
                'type' => 'required|in:REGULAR,VIP',
                'other_note' => 'nullable|string',
                'status' => 'required|in:pending,confirmed,done,canceled',
            ]);

            $validated['dp_status'] = $request->has('dp_status') ? 1 : 0;
            $validated['down_payment'] = $validated['down_payment'] ?? 0;

            $reservation->update($validated);

            // Sync menus dari session
            if (Session::has('selected_menus') && count(Session::get('selected_menus')) > 0) {
                $syncData = [];
                foreach (Session::get('selected_menus') as $item) {
                    $syncData[$item['id']] = [
                        'quantity' => $item['qty'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal'] ?? ($item['price'] * $item['qty'])
                    ];
                }
                $reservation->menus()->sync($syncData);
            } else {
                $reservation->menus()->detach();
            }

            DB::commit();
            Session::forget('selected_menus');
            Session::forget('selected_menus_total');

            return redirect()->route('admin.reservation.table')
                ->with('success', '✅ Reservasi berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating reservation: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui reservasi: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $reservation = Reservation::findOrFail($id);

            // Detach all related menus
            $reservation->menus()->detach();

            // Delete the reservation
            $reservation->delete();

            DB::commit();

            return redirect()->route('admin.reservation.table')
                ->with('success', '✅ Reservasi berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting reservation: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus reservasi: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);

            $validated = $request->validate([
                'status' => 'required|in:pending,confirmed,done,canceled'
            ]);

            $reservation->status = $validated['status'];
            $reservation->save();

            $statusLabels = [
                'pending' => 'Menunggu',
                'confirmed' => 'Disetujui',
                'done' => 'Selesai',
                'canceled' => 'Dibatalkan'
            ];

            return redirect()->back()->with(
                'success',
                '✅ Status berhasil diubah menjadi ' . ($statusLabels[$validated['status']] ?? $validated['status'])
            );
        } catch (\Exception $e) {
            Log::error('Error updating status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }

    /**
     * ============================================
     * MENU SELECTION (FIXED - dd() REMOVED)
     * ============================================
     */
    public function reservationMenuIndex(Request $request)
    {
        try {
            $reservationId = $request->query('res_id');
            $reservation = $reservationId ? Reservation::find($reservationId) : null;

            // Ambil semua menu yang tersedia
            $menus = Menu::with('category')->where('is_available', true)->get();
            $categories = $menus->isNotEmpty()
                ? $menus->groupBy(function ($menu) {
                    return $menu->category ? $menu->category->name : 'Uncategorized';
                })
                : collect();

            // Menu yang sudah dipilih sebelumnya - PRIORITASKAN SESSION
            $selectedMenuIds = [];
            $selectedQuantities = [];

            // CEK SESSION DULU (prioritas utama)
            if (Session::has('selected_menus') && count(Session::get('selected_menus')) > 0) {
                foreach (Session::get('selected_menus') as $item) {
                    $selectedMenuIds[] = $item['id'];
                    $selectedQuantities[$item['id']] = $item['qty'] ?? 1;
                }
            }
            // Jika session kosong, cek dari database (untuk edit)
            elseif ($reservation) {
                foreach ($reservation->menus as $menu) {
                    $selectedMenuIds[] = $menu->id;
                    $selectedQuantities[$menu->id] = $menu->pivot->quantity ?? 1;
                }
            }

            return view('admin.reservation.menu_selection', compact(
                'categories',
                'reservation',
                'reservationId',
                'selectedMenuIds',
                'selectedQuantities'
            ));
        } catch (\Exception $e) {
            Log::error('Error loading menu selection: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memuat pilihan menu: ' . $e->getMessage());
        }
    }

    public function storeMenu(Request $request)
    {
        try {
            $request->validate([
                'menu_ids' => 'required|array',
                'menu_ids.*' => 'exists:menus,id',
            ]);

            $selectedMenus = [];
            $totalPrice = 0;

            // Ambil menu yang sudah ada di session (jika ada)
            $existingMenus = Session::get('selected_menus', []);
            $existingMenuIds = array_column($existingMenus, 'id');

            foreach ($request->menu_ids as $menuId) {
                $qty = $request->quantities[$menuId] ?? 1;
                $menu = Menu::find($menuId);

                if ($menu) {
                    // Cek apakah menu sudah ada di session sebelumnya
                    $existingIndex = array_search($menuId, $existingMenuIds);
                    if ($existingIndex !== false) {
                        // Update quantity jika sudah ada
                        $existingMenus[$existingIndex]['qty'] = $qty;
                        $existingMenus[$existingIndex]['subtotal'] = $menu->price * $qty;
                    } else {
                        // Tambah menu baru
                        $existingMenus[] = [
                            'id' => $menu->id,
                            'name' => $menu->name,
                            'price' => $menu->price,
                            'qty' => $qty,
                            'subtotal' => $menu->price * $qty,
                        ];
                    }
                }
            }

            // Hitung ulang total
            $totalPrice = array_sum(array_column($existingMenus, 'subtotal'));

            Session::put('selected_menus', $existingMenus);
            Session::put('selected_menus_total', $totalPrice);

            if ($request->filled('res_id')) {
                return redirect()->route('admin.reservation.edit', $request->res_id)
                    ->with('success', '✅ Menu berhasil diperbarui! Total: Rp' . number_format($totalPrice, 0, ',', '.'));
            }

            return redirect()->route('admin.reservation.create')
                ->with('success', '✅ Menu berhasil dipilih! Total: Rp' . number_format($totalPrice, 0, ',', '.'));
        } catch (\Exception $e) {
            Log::error('Error storing menu selection: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan pilihan menu: ' . $e->getMessage());
        }
    }

    /**
     * ============================================
     * MENU MANAGEMENT (CRUD)
     * ============================================
     */
    public function menuIndex(Request $request)
    {
        $query = Menu::with('category');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Availability filter
        if ($request->filled('is_available')) {
            $query->where('is_available', $request->is_available);
        }

        $menus = $query->latest()->paginate(12)->withQueryString();

        // Group menus by category name
        $allMenus = Menu::with('category')->get();
        $categories = $allMenus->groupBy(function ($menu) {
            return $menu->category ? $menu->category->name : 'Uncategorized';
        });

        // Statistics
        $stats = [
            'total' => Menu::count(),
            'categories' => MenuCategory::count(),
            'max_price' => Menu::max('price') ?? 0,
            'min_price' => Menu::min('price') ?? 0,
        ];

        // Flag untuk mode management
        $isSelectionMode = false;

        return view('admin.menu.index', compact('menus', 'categories', 'isSelectionMode', 'stats'));
    }

    public function menuCreate()
    {
        $categories = MenuCategory::all();
        return view('admin.menu.create', compact('categories'));
    }

    public function menuStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                'price' => 'required|numeric|min:0|max:9999999',
                'category_id' => 'required|exists:menu_categories,id',
                'is_available' => 'boolean',
            ]);

            $validated['is_available'] = $request->has('is_available') ? 1 : 0;

            Menu::create($validated);

            return redirect()->route('admin.menu.index')
                ->with('success', '✅ Menu berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Error creating menu: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menambahkan menu: ' . $e->getMessage());
        }
    }

    public function menuEdit($id)
    {
        $menu = Menu::with('category')->findOrFail($id);
        $categories = MenuCategory::all();
        return view('admin.menu.edit', compact('menu', 'categories'));
    }

    public function menuUpdate(Request $request, $id)
    {
        try {
            $menu = Menu::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                'price' => 'required|numeric|min:0|max:9999999',
                'category_id' => 'required|exists:menu_categories,id',
                'is_available' => 'boolean',
            ]);

            $validated['is_available'] = $request->has('is_available') ? 1 : 0;

            $menu->update($validated);

            return redirect()->route('admin.menu.index')
                ->with('success', '✅ Menu berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error updating menu: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui menu: ' . $e->getMessage());
        }
    }

    public function menuDestroy($id)
    {
        try {
            $menu = Menu::findOrFail($id);

            // Check if menu is used in any reservation
            $isUsed = $menu->reservations()->exists();
            if ($isUsed) {
                return back()->with('error', '⚠️ Menu sedang digunakan dalam reservasi, tidak bisa dihapus!');
            }

            $menu->delete();

            return redirect()->route('admin.menu.index')
                ->with('success', '✅ Menu berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Error deleting menu: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus menu: ' . $e->getMessage());
        }
    }

    /**
     * ============================================
     * REPORT & PDF
     * ============================================
     */

    public function report(Request $request)
    {
        $query = Reservation::query();

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        if ($request->filled('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->filled('area') && $request->area !== '') {
            $query->where('area', $request->area);
        }

        $reservations = $query->with('menus')->get();

        // Calculate totals
        $totalRevenue = $reservations->sum('down_payment');
        $totalGuests = $reservations->sum('guest_count');
        $totalReservations = $reservations->count();

        // Group by status
        $statusCounts = $reservations->groupBy('status')->map->count();

        // Group by area
        $areaCounts = $reservations->groupBy('area')->map->count();

        return view('admin.reservation.report', compact(
            'reservations',
            'totalRevenue',
            'totalGuests',
            'totalReservations',
            'statusCounts',
            'areaCounts'
        ));
    }

    public function downloadPdf($id)
    {
        try {
            $reservation = Reservation::with(['menus' => function ($query) {
                $query->select('menus.*', 'reservation_menu.quantity', 'reservation_menu.subtotal');
            }])->findOrFail($id);

            $pdf = Pdf::loadView('admin.reservation.pdf', compact('reservation'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                ]);

            return $pdf->download('Reservasi_LS-' . $reservation->id . '.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return back()->with('error', 'Gagal generate PDF: ' . $e->getMessage());
        }
    }

    /**
     * ============================================
     * CUSTOMER ROUTES
     * ============================================
     */

    public function customerIndex()
    {
        return view('user.index');
    }

    public function customerCreate()
    {
        $menus = Menu::with('category')->where('is_available', true)->get();
        $menuCategories = $menus->isNotEmpty()
            ? $menus->groupBy(function ($menu) {
                return $menu->category ? $menu->category->name : 'Uncategorized';
            })
            : collect();

        return view('user.reservasi.create', compact('menuCategories'));
    }

    public function customerStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'date' => 'required|date|after_or_equal:today',
                'booking_time' => 'required|date_format:H:i',
                'session' => 'required|in:1,2,3',
                'guest_count' => 'required|integer|min:1|max:50',
                'special_note' => 'nullable|string|max:500',
            ]);

            // Check availability
            $isAvailable = $this->checkAvailabilitySlot($validated['date'], $validated['booking_time']);
            if (!$isAvailable) {
                return back()->withInput()->with('error', 'Maaf, slot waktu sudah penuh! Silakan pilih waktu lain.');
            }

            $additionalData = [
                'institution' => $request->input('institution'),
                'address' => $request->input('address'),
                'session' => $request->input('session', 1),
                'saung_number' => null,
                'down_payment' => 0,
                'dp_status' => 0,
                'type' => $request->input('type', 'REGULAR'),
                'area' => $request->input('area', 'RESTO'),
                'status' => 'pending'
            ];

            $reservation = Reservation::create(array_merge($additionalData, $validated));

            // Attach selected menus from session
            if (Session::has('selected_menus') && count(Session::get('selected_menus')) > 0) {
                foreach (Session::get('selected_menus') as $item) {
                    $reservation->menus()->attach($item['id'], [
                        'quantity' => $item['qty'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal']
                    ]);
                }
            }

            DB::commit();
            Session::forget('selected_menus');
            Session::forget('selected_menus_total');

            return redirect()->route('customer.booking.success', $reservation->id)
                ->with('success', '✅ Reservasi berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating customer reservation: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal membuat reservasi: ' . $e->getMessage());
        }
    }

    public function customerSyncMenu(Request $request)
    {
        try {
            $menus = $request->input('menus', []);
            $selectedMenus = [];
            $totalPrice = 0;

            foreach ($menus as $item) {
                if ($item['qty'] > 0) {
                    $selectedMenus[] = [
                        'id' => $item['id'],
                        'name' => $item['name'],
                        'qty' => $item['qty'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal']
                    ];
                    $totalPrice += $item['subtotal'];
                }
            }

            Session::put('selected_menus', $selectedMenus);
            Session::put('selected_menus_total', $totalPrice);

            return response()->json(['success' => true, 'total' => $totalPrice]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function customerMenuPage(Request $request)
    {
        $menus = Menu::with('category')->where('is_available', true)->get();
        $categories = $menus->isNotEmpty()
            ? $menus->groupBy(function ($menu) {
                return $menu->category ? $menu->category->name : 'Uncategorized';
            })
            : collect();

        // Ambil data dari session untuk selected quantities
        $selectedQuantities = [];
        if (Session::has('selected_menus')) {
            foreach (Session::get('selected_menus') as $item) {
                $selectedQuantities[$item['id']] = $item['qty'] ?? 0;
            }
        }

        return view('user.menuCust', compact('categories', 'menus', 'selectedQuantities'));
    }

    public function customerSaveMenu(Request $request)
    {
        try {
            $inputMenus = $request->input('menus', []);
            $selectedMenus = [];
            $totalPrice = 0;

            foreach ($inputMenus as $menuId => $qty) {
                if ($qty > 0) {
                    $menu = Menu::find($menuId);
                    if ($menu) {
                        $subtotal = $menu->price * $qty;
                        $selectedMenus[] = [
                            'id' => $menu->id,
                            'name' => $menu->name,
                            'qty' => $qty,
                            'price' => $menu->price,
                            'subtotal' => $subtotal
                        ];
                        $totalPrice += $subtotal;
                    }
                }
            }

            Session::put('selected_menus', $selectedMenus);
            Session::put('selected_menus_total', $totalPrice);

            return redirect()->route('customer.booking.create')
                ->with('success', '✅ Menu berhasil dipilih! Total: Rp' . number_format($totalPrice, 0, ',', '.'));
        } catch (\Exception $e) {
            Log::error('Error saving customer menu: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan menu: ' . $e->getMessage());
        }
    }

    public function customerSuccess($id)
    {
        $reservation = Reservation::with(['menus' => function ($query) {
            $query->select('menus.*', 'reservation_menu.quantity', 'reservation_menu.subtotal');
        }])->findOrFail($id);

        $totalPrice = $reservation->menus->sum(function ($menu) {
            return $menu->pivot->subtotal ?? ($menu->price * $menu->pivot->quantity);
        });

        return view('user.success', compact('reservation', 'totalPrice'));
    }

    public function uploadBukti(Request $request, $id)
    {
        try {
            $request->validate([
                'payment_proof' => 'required|image|max:2048|mimes:jpg,jpeg,png,pdf',
            ]);

            $reservation = Reservation::findOrFail($id);

            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('payment_proofs', $filename, 'public');

                $reservation->payment_proof = $path;
                $reservation->save();

                return redirect()->back()->with('success', '✅ Bukti pembayaran berhasil diupload!');
            }

            return back()->with('error', 'Gagal upload bukti pembayaran.');
        } catch (\Exception $e) {
            Log::error('Error uploading payment proof: ' . $e->getMessage());
            return back()->with('error', 'Gagal upload bukti: ' . $e->getMessage());
        }
    }

    /**
     * ============================================
     * HELPER FUNCTIONS
     * ============================================
     */

    private function checkAvailabilitySlot($date, $time, $excludeId = null)
    {
        $maxCapacity = 10; // Maximum reservations per slot

        $query = Reservation::whereDate('date', $date)
            ->where('booking_time', $time)
            ->whereIn('status', ['pending', 'confirmed']);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $count = $query->count();

        return $count < $maxCapacity;
    }

    public function checkAvailability(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|date',
                'booking_time' => 'required|date_format:H:i',
                'guest_count' => 'required|integer|min:1',
            ]);

            $isAvailable = $this->checkAvailabilitySlot($request->date, $request->booking_time);
            $existingCount = Reservation::whereDate('date', $request->date)
                ->where('booking_time', $request->booking_time)
                ->whereIn('status', ['pending', 'confirmed'])
                ->count();

            $maxCapacity = 10;
            $remaining = $maxCapacity - $existingCount;

            return response()->json([
                'available' => $isAvailable,
                'remaining' => $remaining,
                'message' => $isAvailable
                    ? "✅ Waktu tersedia! Tersisa {$remaining} slot"
                    : "❌ Maaf, waktu sudah penuh. Tersisa {$remaining} slot"
            ]);
        } catch (\Exception $e) {
            Log::error('Error checking availability: ' . $e->getMessage());
            return response()->json([
                'available' => false,
                'message' => 'Terjadi kesalahan, silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * ============================================
     * AUTHENTICATION
     * ============================================
     */

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();

                Log::info('User logged in', ['user_id' => Auth::id(), 'email' => Auth::user()->email]);

                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', '👋 Selamat datang kembali, ' . Auth::user()->name . '!');
            }

            return back()->withErrors([
                'email' => 'Email atau password tidak cocok.',
            ])->onlyInput('email');
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat login.');
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', '👋 Anda telah logout.');
        } catch (\Exception $e) {
            Log::error('Logout error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Gagal logout.');
        }
    }
}
