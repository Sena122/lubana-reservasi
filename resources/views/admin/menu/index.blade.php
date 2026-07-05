@extends('layouts.admin')

@section('title', isset($isSelectionMode) && $isSelectionMode ? 'Pilih Menu - Lubana Sengkol' : 'Manajemen Menu - Lubana Sengkol')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <div>
            <h1 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight">
                {{ isset($isSelectionMode) && $isSelectionMode ? '📋 Pilih Menu' : '🍽️ Manajemen Menu' }}
            </h1>
            <p class="text-sm text-gray-500 mt-1 font-medium">
                {{ isset($isSelectionMode) && $isSelectionMode ? 'Pilih menu untuk reservasi pelanggan' : 'Kelola daftar menu kuliner Lubana Sengkol' }}
                <span class="text-emerald-600 font-bold">Lubana Sengkol</span>
            </p>
        </div>
        @if(!isset($isSelectionMode) || !$isSelectionMode)
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.menu.create') }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all duration-300 shadow-lg shadow-emerald-200/50 hover:shadow-emerald-300/50 hover:scale-105">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Tambah Menu
            </a>
            <button onclick="window.print()"
                class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all duration-300">
                <i data-lucide="printer" class="w-4 h-4"></i>
                Cetak
            </button>
        </div>
        @endif
    </div>

    <!-- Filter & Search -->
    @if(!isset($isSelectionMode) || !$isSelectionMode)
    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <form method="GET" action="{{ route('admin.menu.index') }}" class="flex flex-col md:flex-row items-start md:items-center gap-4">
            <div class="flex-1 w-full">
                <div class="relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari menu..."
                        class="w-full pl-9 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300">
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <select name="category" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300">
                    <option value="">Semua Kategori</option>
                    @foreach($categories ?? [] as $category => $items)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all duration-300 shadow-md hover:shadow-lg">
                    <i data-lucide="filter" class="w-4 h-4 inline mr-1"></i>
                    Filter
                </button>
                @if(request()->has('search') || request()->has('category'))
                <a href="{{ route('admin.menu.index') }}" class="text-gray-400 hover:text-gray-600 text-xs font-bold uppercase tracking-widest transition-colors">
                    <i data-lucide="x" class="w-4 h-4 inline"></i> Reset
                </a>
                @endif
            </div>
        </form>
    </div>
    @endif

    <!-- Statistics Cards -->
    @if(!isset($isSelectionMode) || !$isSelectionMode)
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Menu</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">{{ $stats['total'] ?? $menus->total() ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl flex items-center justify-center">
                    <i data-lucide="utensils" class="w-5 h-5 text-emerald-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Kategori</p>
                    <p class="text-2xl font-black text-blue-600 mt-1">{{ $stats['categories'] ?? count($categories ?? []) }}</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl flex items-center justify-center">
                    <i data-lucide="folder" class="w-5 h-5 text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Termahal</p>
                    <p class="text-sm font-black text-gray-900 mt-1 truncate">Rp{{ number_format($stats['max_price'] ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl flex items-center justify-center">
                    <i data-lucide="crown" class="w-5 h-5 text-amber-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Termurah</p>
                    <p class="text-sm font-black text-gray-900 mt-1 truncate">Rp{{ number_format($stats['min_price'] ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-rose-50 to-rose-100 rounded-xl flex items-center justify-center">
                    <i data-lucide="trending-down" class="w-5 h-5 text-rose-600"></i>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Menu Categories -->
    @if(isset($categories) && count($categories) > 0)
    @foreach($categories as $category => $menuItems)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <!-- Category Header -->
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50/50 to-transparent flex flex-col md:flex-row items-start md:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i data-lucide="book-open" class="w-5 h-5 text-emerald-600"></i>
                </div>
                <div>
                    <h3 class="text-sm font-black text-gray-800 uppercase tracking-wider">{{ $category }}</h3>
                    <p class="text-[10px] text-gray-400 font-medium">{{ count($menuItems) }} menu</p>
                </div>
            </div>
            @if(!isset($isSelectionMode) || !$isSelectionMode)
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-gray-400">Total: Rp{{ number_format($menuItems->sum('price'), 0, ',', '.') }}</span>
                <span class="text-xs font-bold text-gray-300">|</span>
                <span class="text-xs font-bold text-emerald-600">Rata-rata: Rp{{ number_format($menuItems->avg('price'), 0, ',', '.') }}</span>
            </div>
            @endif
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
                                    {{ $menu->category ? $menu->category->name : $category }}
                                </span>
                                @if(isset($menu->is_available) && $menu->is_available)
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">
                                    Tersedia
                                </span>
                                @else
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-100 text-rose-700">
                                    Tidak Tersedia
                                </span>
                                @endif
                            </div>
                        </div>
                        @if(isset($isSelectionMode) && $isSelectionMode)
                        <div class="flex-shrink-0 pt-1">
                            <input type="checkbox"
                                name="menu_ids[]"
                                value="{{ $menu->id }}"
                                {{ in_array($menu->id, $selectedMenuIds ?? []) ? 'checked' : '' }}
                                class="w-5 h-5 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 transition-all duration-200 cursor-pointer">
                        </div>
                        @else
                        <div class="flex-shrink-0 flex flex-col gap-1">
                            <a href="{{ route('admin.menu.edit', $menu->id) }}"
                                class="p-1.5 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors duration-200"
                                title="Edit">
                                <i data-lucide="edit-2" class="w-4 h-4 text-amber-600"></i>
                            </a>
                            <form action="{{ route('admin.menu.destroy', $menu->id) }}"
                                method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-1.5 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors duration-200"
                                    title="Hapus">
                                    <i data-lucide="trash-2" class="w-4 h-4 text-rose-600"></i>
                                </button>
                            </form>
                        </div>
                        @endif
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
            <p class="text-sm text-gray-400 mt-1">Mulai tambahkan menu kuliner untuk Lubana Sengkol</p>
            @if(!isset($isSelectionMode) || !$isSelectionMode)
            <a href="{{ route('admin.menu.create') }}"
                class="mt-6 inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-bold text-sm transition-all duration-300 shadow-lg shadow-emerald-200/50 hover:shadow-emerald-300/50">
                <i data-lucide="plus" class="w-5 h-5"></i>
                Tambah Menu Pertama
            </a>
            @endif
        </div>
    </div>
    @endif

    <!-- Pagination -->
    @if(isset($menus) && $menus->hasPages())
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-4">
        {{ $menus->links('pagination::tailwind') }}
    </div>
    @endif
</div>

@if(isset($isSelectionMode) && $isSelectionMode)
<!-- Selection Mode Footer -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg p-4 z-50">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-4">
            <span class="text-sm font-bold text-gray-700">Total Dipilih: <span id="selectedCount">0</span> menu</span>
            <button onclick="selectAll()" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
                Pilih Semua
            </button>
            <button onclick="deselectAll()" class="text-xs font-bold text-gray-400 hover:text-gray-600 transition-colors">
                Batal Pilih
            </button>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="closeSelection()" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
                Batal
            </button>
            <button onclick="confirmSelection()" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-xs uppercase tracking-widest transition-all shadow-lg shadow-emerald-200/50 hover:shadow-emerald-300/50">
                <i data-lucide="check" class="w-4 h-4 inline mr-1"></i>
                Konfirmasi Pilihan
            </button>
        </div>
    </div>
</div>

<script>
    function updateSelectedCount() {
        const checkboxes = document.querySelectorAll('input[name="menu_ids[]"]:checked');
        const countEl = document.getElementById('selectedCount');
        if (countEl) {
            countEl.textContent = checkboxes.length;
        }
    }

    function selectAll() {
        document.querySelectorAll('input[name="menu_ids[]"]').forEach(cb => cb.checked = true);
        updateSelectedCount();
    }

    function deselectAll() {
        document.querySelectorAll('input[name="menu_ids[]"]').forEach(cb => cb.checked = false);
        updateSelectedCount();
    }

    function confirmSelection() {
        const selected = document.querySelectorAll('input[name="menu_ids[]"]:checked');
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

        const ids = Array.from(selected).map(cb => cb.value);

        // Kirim ke parent window atau form action
        if (window.opener) {
            window.opener.postMessage({
                type: 'menuSelection',
                menuIds: ids
            }, '*');
            window.close();
        } else {
            // Submit form ke route store_menu
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("admin.reservation.store_menu") }}';

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'menu_ids[]';
                input.value = id;
                form.appendChild(input);
            });

            // Tambahkan res_id jika ada
            @if(isset($reservationId) && $reservationId)
            const resId = document.createElement('input');
            resId.type = 'hidden';
            resId.name = 'res_id';
            resId.value = '{{ $reservationId }}';
            form.appendChild(resId);
            @endif

            document.body.appendChild(form);
            form.submit();
        }
    }

    function closeSelection() {
        if (window.opener) {
            window.close();
        } else {
            window.location.href = '{{ route("admin.reservation.create") }}';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize checkbox change events
        document.querySelectorAll('input[name="menu_ids[]"]').forEach(cb => {
            cb.addEventListener('change', updateSelectedCount);
        });
        updateSelectedCount();

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
@endif

@push('styles')
<style>
    /* Custom styles for menu management */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .group:hover .group-hover\:text-emerald-700 {
        color: #059669;
    }

    /* Selection mode fixed footer */
    .fixed {
        position: fixed;
    }

    @media print {
        .fixed {
            position: static;
        }
    }

    /* Checkbox styling */
    input[type="checkbox"] {
        accent-color: #10b981;
        cursor: pointer;
    }

    input[type="checkbox"]:checked {
        background-color: #10b981;
        border-color: #10b981;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons with retry
        setTimeout(function() {
            if (typeof lucide !== 'undefined') {
                try {
                    lucide.createIcons();
                } catch (e) {
                    console.warn('Lucide init error:', e);
                }
            }
        }, 100);
    });
</script>
@endpush
@endsection