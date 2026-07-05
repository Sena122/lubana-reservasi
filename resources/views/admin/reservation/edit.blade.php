@extends('layouts.admin')

@section('title', 'Edit Reservasi - Lubana Sengkol')

@section('content')

<style>
    /* ============================================
   EDIT FORM - SAME STYLE AS CREATE
   ============================================ */

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
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.03), 0 1px 3px rgba(0, 0, 0, 0.02);
        border: 1px solid #f1f5f9;
        transition: box-shadow 0.3s ease;
        padding: 1.5rem 2rem;
    }

    .form-card:hover {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.04), 0 1px 3px rgba(0, 0, 0, 0.02);
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
        position: relative;
        overflow: hidden;
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
    }

    .btn-primary:active {
        transform: scale(0.96);
    }

    .btn-primary::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, transparent 40%, rgba(255, 255, 255, 0.05) 50%, transparent 60%);
        transform: translateX(-100%);
        transition: transform 0.6s;
    }

    .btn-primary:hover::after {
        transform: translateX(100%);
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

    .btn-back i {
        transition: transform 0.2s ease;
    }

    .btn-back:hover i {
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

    .toggle-switch {
        position: relative;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
    }

    .toggle-switch input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        width: 3.5rem;
        height: 2rem;
        background: #e2e8f0;
        border-radius: 9999px;
        transition: all 0.3s ease;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.06);
        position: relative;
    }

    .toggle-slider::after {
        content: '';
        position: absolute;
        top: 0.25rem;
        left: 0.25rem;
        width: 1.5rem;
        height: 1.5rem;
        background: white;
        border-radius: 50%;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .toggle-switch input:checked+.toggle-slider {
        background: #10b981;
    }

    .toggle-switch input:checked+.toggle-slider::after {
        transform: translateX(1.5rem);
    }

    .dp-status-box {
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 1.5rem;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s ease;
    }

    .dp-status-box:hover {
        background: #f1f5f9;
    }

    /* Menu Summary */
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
        .form-card {
            padding: 1.25rem !important;
            border-radius: 1.5rem !important;
        }

        .section-title {
            font-size: 1.25rem;
        }

        .btn-primary {
            padding: 0.875rem 1.5rem;
        }
    }
</style>

<div class="max-w-4xl mx-auto mb-12">
    <!-- Back Button -->
    <a href="{{ route('admin.reservation.table') }}" class="btn-back group">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        Kembali ke Arsip Data
    </a>

    <!-- Header -->
    <div class="mt-4 mb-8">
        <h1 class="section-title">Perbarui Data Reservasi</h1>
        <p class="section-subtitle">
            Mengubah arsip dokumen digital ID: <span>LS-{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}</span>
        </p>
    </div>

    <!-- Form -->
    <div class="form-card">
        <form action="{{ route('admin.reservation.update', $reservation->id) }}" method="POST" id="editForm">
            @csrf
            @method('PUT')

            <!-- SECTION 1: Identitas Pelanggan -->
            <div class="form-card-header">
                <div class="icon-box">
                    <i data-lucide="user" class="w-4 h-4"></i>
                </div>
                <h2>I. Informasi Pelanggan</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Nama Pemesan <span class="text-rose-500">*</span>
                    </label>
                    <div class="form-input-group">
                        <input type="text" name="name" id="field_name" required
                            value="{{ old('name', $reservation->name) }}">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        No. Telepon <span class="text-rose-500">*</span>
                    </label>
                    <div class="form-input-group">
                        <input type="text" name="phone" id="field_phone" required
                            value="{{ old('phone', $reservation->phone) }}">
                    </div>
                </div>

                <div class="space-y-1 md:col-span-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Instansi / Perusahaan (Opsional)
                    </label>
                    <div class="form-input-group">
                        <input type="text" name="institution" id="field_institution"
                            value="{{ old('institution', $reservation->institution) }}">
                    </div>
                </div>

                <div class="space-y-1 md:col-span-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Alamat Lengkap (Opsional)
                    </label>
                    <div class="form-input-group">
                        <textarea name="address" id="field_address" rows="3"
                            class="resize-none">{{ old('address', $reservation->address) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Detail Kedatangan -->
            <div class="form-card-header">
                <div class="icon-box">
                    <i data-lucide="map-pin" class="w-4 h-4"></i>
                </div>
                <h2>II. Detail Kedatangan & Tempat</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Tanggal <span class="text-rose-500">*</span>
                    </label>
                    <div class="form-input-group">
                        <input type="date" name="date" id="field_date" required
                            value="{{ old('date', \Carbon\Carbon::parse($reservation->date)->format('Y-m-d')) }}">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Waktu <span class="text-rose-500">*</span>
                    </label>
                    <div class="form-input-group">
                        <input type="time" name="booking_time" id="field_booking_time" required
                            value="{{ old('booking_time', \Carbon\Carbon::parse($reservation->booking_time)->format('H:i')) }}">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Jumlah Pax <span class="text-rose-500">*</span>
                    </label>
                    <div class="form-input-group" style="background: #ecfdf5; border-color: #d1fae5;">
                        <input type="number" name="guest_count" id="field_guest_count" min="1" required
                            value="{{ old('guest_count', $reservation->guest_count) }}"
                            style="color: #065f46; font-weight: 900; font-size: 1.125rem;">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Sesi <span class="text-rose-500">*</span>
                    </label>
                    <div class="form-input-group">
                        <select name="session" id="field_session" required>
                            <option value="1" {{ old('session', $reservation->session) == 1 ? 'selected' : '' }}>Sesi 1 (Pagi - Siang)</option>
                            <option value="2" {{ old('session', $reservation->session) == 2 ? 'selected' : '' }}>Sesi 2 (Siang - Sore)</option>
                            <option value="3" {{ old('session', $reservation->session) == 3 ? 'selected' : '' }}>Sesi 3 (Sore - Malam)</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Area <span class="text-rose-500">*</span>
                    </label>
                    <div class="form-input-group">
                        <select name="area" id="field_area" required>
                            <option value="RESTO" {{ old('area', $reservation->area) == 'RESTO' ? 'selected' : '' }}>RESTO AREA</option>
                            <option value="MONSTER" {{ old('area', $reservation->area) == 'MONSTER' ? 'selected' : '' }}>MONSTER FISH AREA</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Tipe Pelanggan <span class="text-rose-500">*</span>
                    </label>
                    <div class="form-input-group">
                        <select name="type" id="field_type" required>
                            <option value="REGULAR" {{ old('type', $reservation->type) == 'REGULAR' ? 'selected' : '' }}>REGULAR</option>
                            <option value="VIP" {{ old('type', $reservation->type) == 'VIP' ? 'selected' : '' }}>VIP</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Nomor Saung / Meja
                    </label>
                    <div class="form-input-group">
                        <input type="text" name="saung_number" id="field_saung_number"
                            placeholder="Contoh: Saung 08"
                            value="{{ old('saung_number', $reservation->saung_number) }}">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Status <span class="text-rose-500">*</span>
                    </label>
                    <div class="form-input-group">
                        <select name="status" id="field_status" required>
                            <option value="pending" {{ old('status', $reservation->status) == 'pending' ? 'selected' : '' }}>⏳ PENDING (Menunggu)</option>
                            <option value="confirmed" {{ old('status', $reservation->status) == 'confirmed' ? 'selected' : '' }}>✅ CONFIRMED (Disetujui)</option>
                            <option value="done" {{ old('status', $reservation->status) == 'done' ? 'selected' : '' }}>✔️ DONE (Selesai)</option>
                            <option value="canceled" {{ old('status', $reservation->status) == 'canceled' ? 'selected' : '' }}>❌ CANCELED (Dibatalkan)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SECTION 3: Menu & Pembayaran -->
            <div class="form-card-header">
                <div class="icon-box">
                    <i data-lucide="utensils" class="w-4 h-4"></i>
                </div>
                <h2>III. Menu & Pembayaran</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Menu Summary dari Session -->
                @if(session()->has('selected_menus') && count(session('selected_menus')) > 0)
                <div class="md:col-span-2">
                    <div class="menu-summary">
                        <h3 class="text-xs font-black text-emerald-900 mb-3 flex items-center gap-2 uppercase tracking-wider">
                            <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                            Ringkasan Menu yang Dipesan
                        </h3>
                        <div>
                            @php $totalSemua = 0; @endphp
                            @foreach(session('selected_menus') as $item)
                            <div class="menu-item-row">
                                <div>
                                    <span class="menu-item-name">{{ $item['name'] }}</span>
                                    <span class="menu-item-qty">x{{ $item['qty'] }}</span>
                                </div>
                                <span class="menu-item-price">
                                    Rp{{ number_format($item['subtotal'], 0, ',', '.') }}
                                </span>
                            </div>
                            @php $totalSemua += $item['subtotal']; @endphp
                            @endforeach
                        </div>
                        <div class="menu-total">
                            <span>TOTAL ESTIMASI MENU:</span>
                            <span>Rp{{ number_format($totalSemua, 0, ',', '.') }}</span>
                        </div>
                        @foreach(session('selected_menus') as $item)
                        <input type="hidden" name="ordered_menus[{{ $item['id'] }}]" value="{{ $item['qty'] }}">
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- PERBAIKAN: Tombol Pilih Menu menggunakan route ke menu selection -->
                <div class="md:col-span-2">
                    <a href="{{ route('menu.pilihan') }}"
                        id="menuSelectionBtn"
                        onclick="saveFormToStorage()"
                        class="w-full flex items-center justify-center bg-gray-50 hover:bg-emerald-50 text-gray-700 hover:text-emerald-700 border-2 border-dashed border-gray-200 hover:border-emerald-300 p-5 rounded-2xl font-black text-xs uppercase tracking-widest transition-all duration-300 gap-2 group">
                        <i data-lucide="utensils-crossed" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                        <span>
                            {{ session()->has('selected_menus') && count(session('selected_menus')) > 0 ? 'Ubah Pilihan Menu' : 'Pilih Menu' }}
                        </span>
                    </a>
                </div>

                <div class="space-y-1 md:col-span-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Catatan Khusus
                    </label>
                    <div class="form-input-group">
                        <textarea name="special_note" id="field_special_note" rows="3"
                            class="resize-none">{{ old('special_note', $reservation->special_note) }}</textarea>
                    </div>
                </div>

                <div class="space-y-1 md:col-span-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Lain-Lain
                    </label>
                    <div class="form-input-group">
                        <input type="text" name="other_note" id="field_other_note"
                            value="{{ old('other_note', $reservation->other_note) }}">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Uang Muka / DP (Rp)
                    </label>
                    <div class="form-input-group">
                        <input type="number" name="down_payment" id="field_down_payment" min="0"
                            value="{{ old('down_payment', (int)$reservation->down_payment) }}">
                    </div>
                </div>

                <!-- DP Status Toggle -->
                <div class="md:col-span-2">
                    <div class="dp-status-box">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Validasi Status DP</p>
                            <p class="text-xs font-bold text-gray-500">Aktifkan jika DP sudah diterima</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="dp_status" id="field_dp_status" value="1"
                                {{ old('dp_status', $reservation->dp_status) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-end gap-4">
                <a href="{{ route('admin.reservation.table') }}" class="btn-secondary">
                    Batalkan
                </a>
                <button type="submit" class="btn-primary">
                    <i data-lucide="save" class="w-4 h-4 inline-block mr-2"></i>
                    Simpan & Perbarui Dokumen Arsip
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // ============================================
    // STORAGE KEY FOR EDIT
    // ============================================
    const storageKey = 'temporary_edit_form_{{ $reservation->id }}';

    // ============================================
    // SAVE FORM TO STORAGE
    // ============================================
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
            saung_number: document.getElementById('field_saung_number')?.value || '',
            guest_count: document.getElementById('field_guest_count')?.value || '',
            special_note: document.getElementById('field_special_note')?.value || '',
            down_payment: document.getElementById('field_down_payment')?.value || '',
            type: document.getElementById('field_type')?.value || 'REGULAR',
            other_note: document.getElementById('field_other_note')?.value || '',
            dp_status: document.getElementById('field_dp_status')?.checked || false,
            status: document.getElementById('field_status')?.value || 'pending'
        };
        localStorage.setItem(storageKey, JSON.stringify(formData));
    }

    // ============================================
    // LOAD FORM FROM STORAGE
    // ============================================
    function loadFormFromStorage() {
        const savedForm = localStorage.getItem(storageKey);
        if (savedForm) {
            try {
                const data = JSON.parse(savedForm);
                const fields = {
                    'field_name': 'name',
                    'field_phone': 'phone',
                    'field_institution': 'institution',
                    'field_address': 'address',
                    'field_date': 'date',
                    'field_booking_time': 'booking_time',
                    'field_session': 'session',
                    'field_area': 'area',
                    'field_saung_number': 'saung_number',
                    'field_guest_count': 'guest_count',
                    'field_special_note': 'special_note',
                    'field_down_payment': 'down_payment',
                    'field_type': 'type',
                    'field_other_note': 'other_note',
                    'field_status': 'status'
                };

                Object.keys(fields).forEach(fieldId => {
                    const el = document.getElementById(fieldId);
                    if (el) {
                        const key = fields[fieldId];
                        if (el.type === 'checkbox') {
                            el.checked = data.dp_status || false;
                        } else {
                            el.value = data[key] || '';
                        }
                    }
                });

                // Handle checkbox separately
                const dpCheckbox = document.getElementById('field_dp_status');
                if (dpCheckbox) {
                    dpCheckbox.checked = data.dp_status || false;
                }

                return true;
            } catch (e) {
                console.log('Error loading form data:', e);
                return false;
            }
        }
        return false;
    }

    // ============================================
    // CLEAR STORAGE
    // ============================================
    function clearStorage() {
        localStorage.removeItem(storageKey);
        sessionStorage.removeItem('returning_from_menu_edit');
    }

    // ============================================
    // AUTO SAVE ON INPUT CHANGE
    // ============================================
    function setupAutoSave() {
        const fields = [
            'field_name', 'field_phone', 'field_institution', 'field_address',
            'field_date', 'field_booking_time', 'field_session', 'field_area',
            'field_saung_number', 'field_guest_count', 'field_special_note',
            'field_down_payment', 'field_type', 'field_other_note',
            'field_dp_status', 'field_status'
        ];

        fields.forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('change', saveFormToStorage);
                el.addEventListener('input', saveFormToStorage);
            }
        });
    }

    // ============================================
    // INIT ON PAGE LOAD
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        // Handle menu button click
        const menuBtn = document.getElementById('menuSelectionBtn');
        if (menuBtn) {
            menuBtn.addEventListener('click', function(e) {
                saveFormToStorage();
                sessionStorage.setItem('returning_from_menu_edit', 'true');
            });
        }

        // Handle form submit
        const form = document.getElementById('editForm');
        if (form) {
            form.addEventListener('submit', function() {
                clearStorage();
            });
        }

        const isReturningFromMenu = sessionStorage.getItem('returning_from_menu_edit');

        if (isReturningFromMenu === 'true') {
            const loaded = loadFormFromStorage();
            if (loaded) {
                console.log('Edit form data restored from menu return');
            }
            sessionStorage.removeItem('returning_from_menu_edit');
        }

        setupAutoSave();

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

@endsection