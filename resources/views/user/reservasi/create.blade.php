@extends('layouts.customer')

@section('title', 'Formulir Reservasi - Lubana Sengkol')

@section('content')

<style>
    .form-input-group {
        background: #f8fafc;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid #f1f5f9;
        border-radius: 1.5rem;
        padding: 1rem;
    }
    .form-input-group:focus-within {
        background: #ffffff;
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.08);
    }
    .form-input-group input,
    .form-input-group textarea,
    .form-input-group select {
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        font-weight: 700;
        letter-spacing: 0.02em;
        color: #0f172a;
        width: 100%;
        outline: none;
    }
    .form-input-group input::placeholder,
    .form-input-group textarea::placeholder {
        color: #94a3b8;
        font-weight: 600;
        letter-spacing: 0.05em;
    }
    .form-input-group select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%2364758b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
        background-position: right 0 center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2rem !important;
    }
    .form-card {
        background: #ffffff;
        border-radius: 2rem !important;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03);
        border: 1px solid #f1f5f9;
        padding: 1.5rem 2rem;
    }
    .form-card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }
    .form-card-header .icon-box {
        width: 2rem;
        height: 2rem;
        background: linear-gradient(135deg, #1e293b, #0f172a);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .form-card-header .icon-box i {
        color: white !important;
    }
    .form-card-header h2 {
        font-size: 0.65rem;
        font-weight: 900;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #1e293b;
        margin: 0;
    }
    .btn-primary {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        border: none;
        box-shadow: 0 12px 24px -8px rgba(16, 185, 129, 0.35);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        color: white;
        font-weight: 900;
        padding: 1rem 2.5rem;
        border-radius: 1.5rem;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        cursor: pointer;
        width: 100%;
    }
    .btn-primary:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 20px 32px -10px rgba(16, 185, 129, 0.5);
        background: linear-gradient(135deg, #047857 0%, #059669 100%);
        color: white !important;
    }
    .btn-secondary {
        width: 100%;
        text-align: center;
        border: 2px solid #e2e8f0;
        background: #ffffff;
        color: #475569;
        font-weight: 900;
        padding: 1rem 2rem;
        border-radius: 1.5rem;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    .btn-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .btn-back {
        color: #059669;
        font-size: 0.65rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }
    .btn-back:hover {
        color: #047857;
        transform: translateX(-4px);
    }
    .section-title {
        font-size: 1.5rem;
        font-weight: 900;
        color: #0f172a;
        letter-spacing: -0.025em;
    }
    .section-subtitle {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94a3b8;
        margin-top: 0.125rem;
    }
    .section-subtitle span {
        color: #059669;
    }
    .menu-summary {
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        border: 1px solid rgba(16, 185, 129, 0.15);
        border-radius: 1.5rem;
        padding: 1.25rem;
    }
    .menu-item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.625rem 0;
        border-bottom: 1px solid rgba(16, 185, 129, 0.1);
        font-size: 0.75rem;
    }
    .menu-item-row:last-child {
        border-bottom: none;
    }
    .menu-item-name {
        font-weight: 700;
        color: #1e293b;
    }
    .menu-item-qty {
        color: #059669;
        font-weight: 900;
        background: rgba(16, 185, 129, 0.1);
        padding: 0.125rem 0.5rem;
        border-radius: 0.375rem;
        margin-left: 0.375rem;
    }
    .menu-item-price {
        font-weight: 900;
        color: #065f46;
    }
    .menu-total {
        padding-top: 0.75rem;
        margin-top: 0.5rem;
        border-top: 2px solid rgba(16, 185, 129, 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
        font-weight: 900;
        color: #064e3b;
    }
    .menu-total span:last-child {
        font-size: 1rem;
        color: #065f46;
    }
    @media (max-width: 768px) {
        .form-card { padding: 1.25rem !important; }
        .section-title { font-size: 1.25rem; }
        .btn-primary { padding: 0.875rem 1.5rem; }
    }
</style>

<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <a href="{{ route('customer.booking') }}" class="btn-back group">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Pilihan
            </a>
            <h1 class="section-title">Formulir Reservasi</h1>
            <p class="section-subtitle">Isi data diri Anda untuk melakukan <span>pemesanan</span></p>
        </div>
        <div class="hidden sm:block">
            <div class="w-12 h-12 bg-gradient-to-br from-emerald-50 to-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center shadow-sm">
                <i class="bi bi-file-text fs-4"></i>
            </div>
        </div>
    </div>

    <form action="{{ route('customer.booking.store') }}" method="POST" id="reservationForm">
        @csrf

        <!-- SECTION 1: Identitas -->
        <div class="form-card space-y-6">
            <div class="form-card-header">
                <div class="icon-box"><i class="bi bi-person"></i></div>
                <h2>Identitas Diri</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <div class="form-input-group">
                        <input type="text" name="name" id="field_name" required placeholder="Contoh: Andi Pratama" value="{{ old('name') }}">
                    </div>
                    @error('name')<p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">No. Telepon <span class="text-rose-500">*</span></label>
                    <div class="form-input-group">
                        <input type="text" name="phone" id="field_phone" required placeholder="Contoh: 08123456789" value="{{ old('phone') }}">
                    </div>
                    @error('phone')<p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-1 md:col-span-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Institusi / Perusahaan (Opsional)</label>
                    <div class="form-input-group">
                        <input type="text" name="institution" id="field_institution" placeholder="Contoh: PT. Maju Jaya" value="{{ old('institution') }}">
                    </div>
                </div>
                <div class="space-y-1 md:col-span-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Alamat (Opsional)</label>
                    <div class="form-input-group">
                        <textarea name="address" id="field_address" rows="2" placeholder="Masukkan alamat lengkap Anda..." class="resize-none">{{ old('address') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Waktu & Lokasi -->
        <div class="form-card space-y-6 mt-6">
            <div class="form-card-header">
                <div class="icon-box"><i class="bi bi-calendar-event"></i></div>
                <h2>Waktu Kunjungan & Lokasi</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal <span class="text-rose-500">*</span></label>
                    <div class="form-input-group">
                        <input type="date" name="date" id="field_date" required value="{{ old('date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}">
                    </div>
                    @error('date')<p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Jam Tiba <span class="text-rose-500">*</span></label>
                    <div class="form-input-group">
                        <input type="time" name="booking_time" id="field_booking_time" required value="{{ old('booking_time', '11:00') }}">
                    </div>
                    @error('booking_time')<p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Sesi <span class="text-rose-500">*</span></label>
                    <div class="form-input-group">
                        <select name="session" id="field_session" required>
                            <option value="1" {{ old('session', '1') == '1' ? 'selected' : '' }}>Sesi 1 (09:00 - 12:00)</option>
                            <option value="2" {{ old('session') == '2' ? 'selected' : '' }}>Sesi 2 (12:00 - 15:00)</option>
                            <option value="3" {{ old('session') == '3' ? 'selected' : '' }}>Sesi 3 (15:00 - 18:00)</option>
                        </select>
                    </div>
                    @error('session')<p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Area <span class="text-rose-500">*</span></label>
                    <div class="form-input-group">
                        <select name="area" id="field_area" required>
                            <option value="RESTO" {{ old('area', 'RESTO') == 'RESTO' ? 'selected' : '' }}>Restoran Alam</option>
                            <option value="MONSTER" {{ old('area') == 'MONSTER' ? 'selected' : '' }}>Pemancingan Premium</option>
                        </select>
                    </div>
                    @error('area')<p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tipe Layanan <span class="text-rose-500">*</span></label>
                    <div class="form-input-group">
                        <select name="type" id="field_type" required>
                            <option value="REGULAR" {{ old('type', 'REGULAR') == 'REGULAR' ? 'selected' : '' }}>Regular</option>
                            <option value="VIP" {{ old('type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                        </select>
                    </div>
                    @error('type')<p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Jumlah Orang <span class="text-rose-500">*</span></label>
                    <div class="form-input-group" style="background: #ecfdf5; border-color: #d1fae5;">
                        <input type="number" name="guest_count" id="field_guest_count" min="1" required placeholder="Jumlah Orang" value="{{ old('guest_count', '') }}" style="color: #065f46; font-weight: 900; font-size: 1.125rem;">
                    </div>
                    @error('guest_count')<p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- SECTION 3: Menu & Catatan -->
        <div class="form-card space-y-6 mt-6">
            <div class="form-card-header">
                <div class="icon-box"><i class="bi bi-utensils"></i></div>
                <h2>Menu & Catatan</h2>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">Pilihan Menu</label>

                    @if(session()->has('selected_menus') && count(session('selected_menus')) > 0)
                    <div class="menu-summary">
                        <h3 class="text-xs font-black text-emerald-900 mb-3 flex items-center gap-2 uppercase tracking-wider">
                            <i class="bi bi-clipboard-check"></i> Ringkasan Menu yang Dipesan
                        </h3>
                        @php $totalSemua = 0; @endphp
                        @foreach(session('selected_menus') as $item)
                        <div class="menu-item-row">
                            <div>
                                <span class="menu-item-name">{{ $item['name'] }}</span>
                                <span class="menu-item-qty">x{{ $item['qty'] }}</span>
                            </div>
                            <span class="menu-item-price">Rp{{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                        </div>
                        @php $totalSemua += $item['subtotal']; @endphp
                        @endforeach
                        <div class="menu-total">
                            <span>TOTAL ESTIMASI MENU:</span>
                            <span>Rp{{ number_format($totalSemua, 0, ',', '.') }}</span>
                        </div>
                        @foreach(session('selected_menus') as $item)
                        <input type="hidden" name="ordered_menus[{{ $item['id'] }}]" value="{{ $item['qty'] }}">
                        @endforeach
                    </div>
                    @endif

                    <a href="{{ route('customer.menu') }}" onclick="saveFormToStorage()" class="w-full flex items-center justify-center bg-gray-50 hover:bg-emerald-50 text-gray-700 hover:text-emerald-700 border-2 border-dashed border-gray-200 hover:border-emerald-300 p-5 rounded-2xl font-black text-xs uppercase tracking-widest transition-all duration-300 gap-2 group">
                        <i class="bi bi-plus-circle group-hover:scale-110 transition-transform"></i>
                        <span>{{ session()->has('selected_menus') && count(session('selected_menus')) > 0 ? 'Ubah Pilihan Menu' : 'Pilih Menu' }}</span>
                    </a>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Catatan Khusus</label>
                    <div class="form-input-group">
                        <textarea name="special_note" id="field_special_note" rows="3" placeholder="Contoh: Minta saung dekat area anak..." class="resize-none">{{ old('special_note') }}</textarea>
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Catatan Lainnya</label>
                    <div class="form-input-group">
                        <input type="text" name="other_note" id="field_other_note" placeholder="Keterangan tambahan..." value="{{ old('other_note') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Penting -->
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mt-6">
            <div class="flex items-start gap-3">
                <i class="bi bi-info-circle text-amber-600 text-xl mt-0.5"></i>
                <div>
                    <p class="text-xs font-bold text-amber-800">Informasi Penting</p>
                    <ul class="text-xs text-amber-700 mt-1 space-y-1 list-disc list-inside">
                        <li>Reservasi akan diproses oleh admin dan dikonfirmasi maksimal 1x24 jam</li>
                        <li>Pembayaran DP akan diinfokan setelah reservasi dikonfirmasi</li>
                        <li>Pastikan data yang diisi benar dan dapat dihubungi</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-6">
            <a href="{{ route('customer.booking') }}" class="btn-secondary">Batalkan</a>
            <button type="submit" class="btn-primary"><i class="bi bi-send me-2"></i> Kirim Reservasi</button>
        </div>
    </form>
</div>

<script>
    const storageKey = 'temporary_customer_reservation_form';

    function saveFormToStorage() {
        const formData = {
            name: document.getElementById('field_name')?.value || '',
            phone: document.getElementById('field_phone')?.value || '',
            institution: document.getElementById('field_institution')?.value || '',
            address: document.getElementById('field_address')?.value || '',
            date: document.getElementById('field_date')?.value || '',
            booking_time: document.getElementById('field_booking_time')?.value || '',
            session: document.getElementById('field_session')?.value || '1',
            area: document.getElementById('field_area')?.value || 'RESTO',
            type: document.getElementById('field_type')?.value || 'REGULAR',
            guest_count: document.getElementById('field_guest_count')?.value || '',
            special_note: document.getElementById('field_special_note')?.value || '',
            other_note: document.getElementById('field_other_note')?.value || ''
        };
        localStorage.setItem(storageKey, JSON.stringify(formData));
    }

    function loadFormFromStorage() {
        const savedForm = localStorage.getItem(storageKey);
        if (savedForm) {
            try {
                const data = JSON.parse(savedForm);
                const fields = {
                    'field_name': 'name', 'field_phone': 'phone', 'field_institution': 'institution',
                    'field_address': 'address', 'field_date': 'date', 'field_booking_time': 'booking_time',
                    'field_session': 'session', 'field_area': 'area', 'field_type': 'type',
                    'field_guest_count': 'guest_count', 'field_special_note': 'special_note',
                    'field_other_note': 'other_note'
                };
                Object.keys(fields).forEach(fieldId => {
                    const el = document.getElementById(fieldId);
                    if (el) { el.value = data[fields[fieldId]] || ''; }
                });
                return true;
            } catch (e) { return false; }
        }
        return false;
    }

    function clearStorage() {
        localStorage.removeItem(storageKey);
        sessionStorage.removeItem('returning_from_menu');
        sessionStorage.removeItem('menu_selected');
    }

    // ✅ Load menu dari localStorage ke session saat halaman dimuat
    function loadMenuFromStorage() {
        const storageKeyMenu = 'customer_selected_menus_temporary';
        const savedData = localStorage.getItem(storageKeyMenu);
        
        if (savedData) {
            try {
                const items = JSON.parse(savedData);
                const selectedMenus = Object.values(items);
                
                if (selectedMenus.length > 0) {
                    fetch('{{ route("customer.menu.sync") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ menus: selectedMenus })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    })
                    .catch(error => console.log('Error loading menu:', error));
                }
            } catch (e) {
                console.log('Error parsing menu data:', e);
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('reservationForm');
        if (form) { form.addEventListener('submit', clearStorage); }

        // Cek apakah ada menu yang perlu di-sync
        @if(!session()->has('selected_menus') || count(session('selected_menus')) == 0)
            const menuSelected = sessionStorage.getItem('menu_selected');
            if (menuSelected === 'true') {
                loadMenuFromStorage();
                sessionStorage.removeItem('menu_selected');
            }
        @endif

        // Load form data
        if (sessionStorage.getItem('returning_from_menu') === 'true') {
            loadFormFromStorage();
            sessionStorage.removeItem('returning_from_menu');
        } else {
            // Coba load dari storage jika form kosong
            const nameField = document.getElementById('field_name');
            if (nameField && !nameField.value) {
                loadFormFromStorage();
            }
        }

        // Auto save
        document.querySelectorAll('#reservationForm input, #reservationForm select, #reservationForm textarea')
            .forEach(el => {
                el.addEventListener('change', saveFormToStorage);
                el.addEventListener('input', saveFormToStorage);
            });

        window.addEventListener('beforeunload', saveFormToStorage);
    });
</script>
@endsection