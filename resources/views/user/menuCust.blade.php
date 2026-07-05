@extends('layouts.customer')

@section('title', 'Pilih Menu - Lubana Sengkol')

@section('content')
<div class="py-8 md:py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6 md:mb-8">
            <div>
                <a href="{{ route('customer.booking.create') }}" class="inline-flex items-center gap-2 text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
                    <i class="bi bi-arrow-left"></i> Kembali ke Form Reservasi
                </a>
                <h1 class="text-2xl md:text-3xl font-extrabold text-ui-dark mt-2">Pilih Menu Restoran</h1>
                <p class="text-sm text-ui-muted mt-0.5">Pilih hidangan yang ingin Anda pesan</p>
            </div>
            <div class="hidden sm:block">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="bi bi-utensils"></i>
                </div>
            </div>
        </div>

        @if(isset($categories) && count($categories) > 0)
        <div class="space-y-6">
            @foreach($categories as $categoryName => $menuItems)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-3 bg-gradient-to-r from-gray-50/50 to-transparent border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                        <i class="bi bi-bookmark"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-ui-dark uppercase tracking-wider">{{ is_string($categoryName) ? $categoryName : 'Kategori' }}</h3>
                        <p class="text-[10px] text-ui-muted">{{ count($menuItems) }} menu</p>
                    </div>
                </div>
                <div class="p-4 md:p-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                        @foreach($menuItems as $menu)
                        <div class="bg-gray-50/50 hover:bg-white rounded-xl border border-gray-100 hover:border-emerald-200 p-4 transition-all duration-300 hover:shadow-md group">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-sm text-ui-dark group-hover:text-emerald-700 transition-colors">{{ $menu->name }}</h4>
                                    <p class="text-emerald-600 font-extrabold text-sm mt-0.5">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                    @if($menu->description)<p class="text-xs text-ui-muted mt-1 line-clamp-2">{{ $menu->description }}</p>@endif
                                    <div class="mt-2 flex items-center gap-2 flex-wrap">
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-gray-100 text-gray-600">{{ $menu->category ? $menu->category->name : $categoryName }}</span>
                                        @if(isset($menu->is_available) && $menu->is_available)
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">Tersedia</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="flex items-center gap-1.5">
                                        <button onclick="updateQty({{ $menu->id }}, -1)" class="w-7 h-7 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold flex items-center justify-center transition-colors"><i class="bi bi-dash"></i></button>
                                        <input type="number" id="qty_{{ $menu->id }}" min="0" value="{{ $selectedQuantities[$menu->id] ?? 0 }}" data-id="{{ $menu->id }}" data-name="{{ $menu->name }}" data-price="{{ $menu->price }}" class="customer-menu-qty w-12 text-center text-sm font-extrabold bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all" onchange="updateSummary()">
                                        <button onclick="updateQty({{ $menu->id }}, 1)" class="w-7 h-7 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold flex items-center justify-center transition-colors"><i class="bi bi-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
            <div class="flex flex-col items-center max-w-sm mx-auto">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-4xl text-gray-300"><i class="bi bi-utensils"></i></div>
                <h3 class="text-lg font-extrabold text-ui-dark">Belum Ada Menu</h3>
                <p class="text-sm text-ui-muted mt-1">Menu akan segera tersedia</p>
            </div>
        </div>
        @endif

        <!-- Summary & Actions -->
        <div class="sticky bottom-0 bg-white border-t border-gray-200 shadow-lg rounded-t-2xl p-4 mt-6 -mx-4 sm:mx-0">
            <div class="max-w-5xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="flex items-center gap-4 text-sm">
                    <span class="font-bold text-ui-dark">Total Dipilih: <span id="selectedCount" class="text-emerald-600">0</span> menu</span>
                    <span class="font-bold text-ui-dark">Total: Rp <span id="totalPrice" class="text-emerald-600">0</span></span>
                    <button onclick="resetAll()" class="text-xs font-bold text-red-500 hover:text-red-600 transition-colors"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                </div>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <a href="{{ route('customer.booking.create') }}" class="flex-1 sm:flex-none text-center border-2 border-gray-200 bg-white hover:bg-gray-50 text-gray-700 font-bold px-6 py-2.5 rounded-xl text-xs uppercase tracking-widest transition-all">Batal</a>
                    <button onclick="simpanPilihanMenuCustomer()" class="flex-1 sm:flex-none bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-bold px-8 py-2.5 rounded-xl shadow-lg shadow-emerald-200/50 transition-all text-xs uppercase tracking-widest"><i class="bi bi-check-lg mr-1"></i> Terapkan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
    input[type=number] { -moz-appearance: textfield; }
</style>

<script>
    const storageKeyMenu = 'customer_selected_menus_temporary';

    function updateQty(menuId, delta) {
        const input = document.getElementById('qty_' + menuId);
        if (input) {
            let val = parseInt(input.value) || 0;
            val = Math.max(0, val + delta);
            input.value = val;
            updateSummary();
            autoSaveToStorage();
        }
    }

    function updateSummary() {
        const inputs = document.querySelectorAll('.customer-menu-qty');
        let count = 0, total = 0;
        inputs.forEach(input => {
            const qty = parseInt(input.value) || 0;
            if (qty > 0) {
                count++;
                total += (parseFloat(input.getAttribute('data-price')) || 0) * qty;
            }
        });
        document.getElementById('selectedCount').textContent = count;
        document.getElementById('totalPrice').textContent = total.toLocaleString('id-ID');
    }

    function resetAll() {
        if (confirm('Reset semua pilihan menu?')) {
            document.querySelectorAll('.customer-menu-qty').forEach(input => input.value = 0);
            updateSummary();
            localStorage.removeItem(storageKeyMenu);
        }
    }

    function autoSaveToStorage() {
        const items = {};
        const inputs = document.querySelectorAll('.customer-menu-qty');
        inputs.forEach(input => {
            const qty = parseInt(input.value) || 0;
            if (qty > 0) {
                const id = input.getAttribute('data-id');
                const name = input.getAttribute('data-name');
                const price = parseFloat(input.getAttribute('data-price'));
                items[id] = { id, name, qty, price, subtotal: qty * price };
            }
        });
        localStorage.setItem(storageKeyMenu, JSON.stringify(items));
    }

    function simpanPilihanMenuCustomer() {
        const items = {};
        const inputs = document.querySelectorAll('.customer-menu-qty');
        inputs.forEach(input => {
            const qty = parseInt(input.value) || 0;
            if (qty > 0) {
                const id = input.getAttribute('data-id');
                const name = input.getAttribute('data-name');
                const price = parseFloat(input.getAttribute('data-price'));
                items[id] = { id, name, qty, price, subtotal: qty * price };
            }
        });
        
        localStorage.setItem(storageKeyMenu, JSON.stringify(items));
        sessionStorage.setItem('menu_selected', 'true');
        window.location.href = "{{ route('customer.booking.create') }}";
    }

    document.addEventListener('DOMContentLoaded', function() {
        const savedData = JSON.parse(localStorage.getItem(storageKeyMenu) || '{}');
        Object.keys(savedData).forEach(id => {
            const input = document.getElementById('qty_' + id);
            if (input) {
                input.value = savedData[id].qty;
            }
        });
        updateSummary();

        document.querySelectorAll('.customer-menu-qty').forEach(input => {
            input.addEventListener('change', function() {
                updateSummary();
                autoSaveToStorage();
            });
            input.addEventListener('input', function() {
                updateSummary();
                autoSaveToStorage();
            });
        });
    });
</script>
@endsection