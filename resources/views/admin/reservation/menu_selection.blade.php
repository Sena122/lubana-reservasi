@extends('layouts.admin')

@section('title', 'Pilih Menu untuk Reservasi - Lubana Sengkol')

@section('content')
<div class="space-y-6 pb-24">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <div>
            <h1 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight">
                📋 Pilih Menu untuk Reservasi
            </h1>
            <p class="text-sm text-gray-500 mt-1 font-medium">
                Pilih menu yang akan dipesan oleh pelanggan
                <span class="text-emerald-600 font-bold">Lubana Sengkol</span>
            </p>
        </div>
        <div>
            @if(isset($reservationId) && $reservationId)
            <a href="{{ route('admin.reservation.edit', $reservationId) }}"
                class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all duration-300">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Edit
            </a>
            @else
            <a href="{{ route('admin.reservation.create') }}"
                class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all duration-300">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Form
            </a>
            @endif
        </div>
    </div>

    <!-- Menu Categories -->
    @if(isset($categories) && count($categories) > 0)
    @foreach($categories as $category => $menuItems)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <!-- Category Header -->
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50/50 to-transparent">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i data-lucide="book-open" class="w-5 h-5 text-emerald-600"></i>
                </div>
                <div>
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-wider">{{ $category }}</h3>
                    <p class="text-[10px] text-gray-400 font-medium">{{ count($menuItems) }} menu</p>
                </div>
            </div>
        </div>

        <!-- Menu Items Grid -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($menuItems as $menu)
                <div class="group bg-white rounded-xl border border-gray-100 p-4 shadow-sm hover:shadow-lg hover:border-emerald-200 transition-all duration-300 hover:scale-[1.02]">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-sm text-gray-900 truncate group-hover:text-emerald-700 transition-colors">
                                {{ $menu->name }}
                            </h4>
                            <p class="text-lg font-black text-emerald-600 mt-1">
                                Rp{{ number_format($menu->price, 0, ',', '.') }}
                            </p>
                            @if($menu->description)
                            <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ $menu->description }}</p>
                            @endif
                            <div class="mt-2 flex items-center gap-2 flex-wrap">
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-gray-100 text-gray-600">
                                    {{ $menu->category->name ?? $category }}
                                </span>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">
                                    Tersedia
                                </span>
                            </div>
                        </div>
                        <div class="flex-shrink-0 pt-1">
                            <input type="checkbox"
                                class="menu-checkbox w-5 h-5 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 transition-all duration-200 cursor-pointer"
                                value="{{ $menu->id }}"
                                data-price="{{ $menu->price }}"
                                data-name="{{ $menu->name }}"
                                {{ in_array($menu->id, $selectedMenuIds ?? []) ? 'checked' : '' }}>
                        </div>
                    </div>
                    <!-- Quantity Input -->
                    <div class="mt-3 flex items-center gap-2 border-t border-gray-50 pt-3">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Qty:</label>
                        <input type="number"
                            class="qty-input w-16 px-2 py-1 text-center text-sm font-bold border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none"
                            data-menu-id="{{ $menu->id }}"
                            value="{{ $selectedQuantities[$menu->id] ?? 1 }}"
                            min="1"
                            max="99">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
    @else
    <!-- Empty State -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
        <div class="flex flex-col items-center max-w-sm mx-auto">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                <i data-lucide="utensils" class="w-10 h-10 text-gray-300"></i>
            </div>
            <h3 class="text-lg font-black text-gray-700">Belum Ada Menu</h3>
            <p class="text-sm text-gray-400 mt-1">Belum ada menu yang tersedia untuk dipilih</p>
        </div>
    </div>
    @endif
</div>

<!-- Fixed Footer Selection -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg p-4 z-50">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-4 flex-wrap">
            <span class="text-sm font-bold text-gray-700">Total Dipilih: <span id="selectedCount" class="text-emerald-600">0</span> menu</span>
            <span class="text-sm font-bold text-gray-700">Total: Rp<span id="totalPrice" class="text-emerald-600">0</span></span>
            <button onclick="selectAll()" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
                Pilih Semua
            </button>
            <button onclick="deselectAll()" class="text-xs font-bold text-gray-400 hover:text-gray-600 transition-colors">
                Batal Pilih
            </button>
        </div>
        <div class="flex items-center gap-3">
            @if(isset($reservationId) && $reservationId)
            <a href="{{ route('admin.reservation.edit', $reservationId) }}"
                class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
                Batal
            </a>
            @else
            <a href="{{ route('admin.reservation.create') }}"
                class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
                Batal
            </a>
            @endif
            <button onclick="confirmSelection()" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-xs uppercase tracking-widest transition-all shadow-lg shadow-emerald-200/50 hover:shadow-emerald-300/50">
                <i data-lucide="check" class="w-4 h-4 inline mr-1"></i>
                Konfirmasi Pilihan
            </button>
        </div>
    </div>
</div>

<script>
    // ============================================
    // UPDATE SUMMARY
    // ============================================
    function updateSummary() {
        const checkboxes = document.querySelectorAll('.menu-checkbox:checked');
        const count = checkboxes.length;
        let total = 0;

        checkboxes.forEach(cb => {
            const menuId = cb.value;
            const qtyInput = document.querySelector(`.qty-input[data-menu-id="${menuId}"]`);
            const qty = parseInt(qtyInput?.value || 1);
            const price = parseInt(cb.dataset.price || 0);
            total += price * qty;
        });

        document.getElementById('selectedCount').textContent = count;
        document.getElementById('totalPrice').textContent = total.toLocaleString('id-ID');
    }

    // ============================================
    // SELECT ALL / DESELECT ALL
    // ============================================
    function selectAll() {
        document.querySelectorAll('.menu-checkbox').forEach(cb => cb.checked = true);
        updateSummary();
    }

    function deselectAll() {
        document.querySelectorAll('.menu-checkbox').forEach(cb => cb.checked = false);
        updateSummary();
    }

    // ============================================
    // CONFIRM SELECTION
    // ============================================
    function confirmSelection() {
        const selected = document.querySelectorAll('.menu-checkbox:checked');
        if (selected.length === 0) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Silakan pilih minimal satu menu',
                    icon: 'warning',
                    confirmButtonColor: '#10b981'
                });
            } else {
                alert('Silakan pilih minimal satu menu');
            }
            return;
        }

        // Buat form untuk submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("menu.pilihan.simpan") }}';

        // CSRF Token
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);

        // Menu IDs dan Quantities
        selected.forEach(cb => {
            const menuId = cb.value;

            const inputId = document.createElement('input');
            inputId.type = 'hidden';
            inputId.name = 'menu_ids[]';
            inputId.value = menuId;
            form.appendChild(inputId);

            const qtyInput = document.querySelector(`.qty-input[data-menu-id="${menuId}"]`);
            const qty = qtyInput?.value || 1;

            const inputQty = document.createElement('input');
            inputQty.type = 'hidden';
            inputQty.name = `quantities[${menuId}]`;
            inputQty.value = qty;
            form.appendChild(inputQty);
        });

        // Reservation ID jika ada
        @if(isset($reservationId) && $reservationId)
        const resId = document.createElement('input');
        resId.type = 'hidden';
        resId.name = 'res_id';
        resId.value = '{{ $reservationId }}';
        form.appendChild(resId);
        @endif

        document.body.appendChild(form);

        // Tampilkan loading
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Memproses...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        form.submit();
    }

    // ============================================
    // INIT
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        // Event listeners untuk checkbox
        document.querySelectorAll('.menu-checkbox').forEach(cb => {
            cb.addEventListener('change', updateSummary);
        });

        // Event listeners untuk quantity
        document.querySelectorAll('.qty-input').forEach(input => {
            input.addEventListener('change', updateSummary);
            input.addEventListener('input', updateSummary);
        });

        // Initial update
        updateSummary();

        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            try {
                lucide.createIcons();
            } catch (e) {
                console.warn('Lucide init error:', e);
            }
        }
    });
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .fixed {
        position: fixed;
    }

    @media print {
        .fixed {
            position: static;
        }
    }

    /* Smooth transition for checkbox */
    .menu-checkbox {
        transition: all 0.2s ease;
    }

    .menu-checkbox:checked {
        transform: scale(1.1);
    }

    /* Quantity input styling */
    .qty-input {
        transition: all 0.2s ease;
    }

    .qty-input:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    /* Footer shadow */
    .fixed.bottom-0 {
        box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.06);
    }
</style>
@endsection