@extends('layouts.admin')

@section('title', 'Edit Menu - Lubana Sengkol')

@section('content')

<style>
    /* ============================================
   MENU EDIT FORM STYLING
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

    .availability-box {
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 1.5rem;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s ease;
    }

    .availability-box:hover {
        background: #f1f5f9;
    }

    .info-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #f1f5f9;
        padding: 0.375rem 1rem;
        border-radius: 9999px;
        font-size: 0.65rem;
        font-weight: 700;
        color: #475569;
    }

    .info-badge i {
        width: 1rem;
        height: 1rem;
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

<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <a href="{{ route('admin.menu.index') }}" class="btn-back group">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                Kembali ke Daftar Menu
            </a>
            <h1 class="section-title">
                Edit Menu
            </h1>
            <p class="section-subtitle">
                Perbarui Data Menu <span>Lubana Sengkol</span>
            </p>
        </div>
        <div class="hidden sm:block">
            <div class="w-12 h-12 bg-gradient-to-br from-amber-50 to-amber-100 text-amber-600 rounded-2xl flex items-center justify-center shadow-sm">
                <i data-lucide="edit-2" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- Info Badge -->
    <div class="mb-6 flex flex-wrap items-center gap-3">
        <span class="info-badge">
            <i data-lucide="hash" class="w-3 h-3"></i>
            ID: #{{ $menu->id }}
        </span>
        <span class="info-badge">
            <i data-lucide="calendar" class="w-3 h-3"></i>
            Dibuat: {{ $menu->created_at ? $menu->created_at->format('d M Y H:i') : '-' }}
        </span>
        <span class="info-badge">
            <i data-lucide="clock" class="w-3 h-3"></i>
            Diperbarui: {{ $menu->updated_at ? $menu->updated_at->format('d M Y H:i') : '-' }}
        </span>
    </div>

    <!-- Form -->
    <div class="form-card">
        <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" id="menuForm">
            @csrf
            @method('PUT')

            <!-- Form Body -->
            <div class="space-y-6">
                <!-- Nama Menu -->
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Nama Menu <span class="text-rose-500">*</span>
                    </label>
                    <div class="form-input-group">
                        <input type="text"
                            name="name"
                            id="field_name"
                            required
                            placeholder="Contoh: Paket Nyeruit 3-5 pax"
                            value="{{ old('name', $menu->name) }}">
                    </div>
                    @error('name')
                    <p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        Deskripsi (Opsional)
                    </label>
                    <div class="form-input-group">
                        <textarea name="description"
                            id="field_description"
                            rows="3"
                            placeholder="Deskripsi menu..."
                            class="resize-none">{{ old('description', $menu->description) }}</textarea>
                    </div>
                    @error('description')
                    <p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga & Kategori -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            Harga (Rp) <span class="text-rose-500">*</span>
                        </label>
                        <div class="form-input-group" style="background: #ecfdf5; border-color: #d1fae5;">
                            <input type="number"
                                name="price"
                                id="field_price"
                                required
                                min="0"
                                placeholder="Contoh: 230000"
                                value="{{ old('price', $menu->price) }}"
                                style="color: #065f46; font-weight: 900; font-size: 1.125rem;">
                        </div>
                        @error('price')
                        <p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            Kategori <span class="text-rose-500">*</span>
                        </label>
                        <div class="form-input-group">
                            <select name="category_id" id="field_category_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                        <p class="text-[10px] font-bold text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Status Ketersediaan -->
                <div class="availability-box">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Status Ketersediaan</p>
                        <p class="text-xs font-bold text-gray-500">Aktifkan jika menu tersedia</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="is_available" id="field_is_available" value="1"
                            {{ old('is_available', $menu->is_available) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-6 mt-6 border-t border-gray-100">
                <a href="{{ route('admin.menu.index') }}" class="btn-secondary">
                    Batalkan
                </a>
                <button type="submit" class="btn-primary">
                    <i data-lucide="save" class="w-4 h-4 inline-block mr-2"></i>
                    Perbarui Menu
                </button>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="mt-6 bg-rose-50 border border-rose-200 rounded-2xl p-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-xs font-black text-rose-700 uppercase tracking-widest">⚠️ Zona Berbahaya</h3>
                <p class="text-xs text-rose-600 mt-1">Tindakan ini tidak dapat dibatalkan</p>
            </div>
            <form action="{{ route('admin.menu.destroy', $menu->id) }}"
                method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini? Data yang dihapus tidak dapat dikembalikan!')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-6 py-2.5 bg-rose-600 hover:bg-rose-700 text-white rounded-xl font-bold text-xs uppercase tracking-widest transition-all duration-300 shadow-lg shadow-rose-200/50 hover:shadow-rose-300/50">
                    <i data-lucide="trash-2" class="w-4 h-4 inline mr-2"></i>
                    Hapus Menu
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            try {
                lucide.createIcons();
            } catch (e) {
                console.warn('Lucide init error:', e);
            }
        }

        // Format price input (add thousand separator on blur)
        const priceInput = document.getElementById('field_price');
        if (priceInput) {
            priceInput.addEventListener('blur', function() {
                if (this.value) {
                    const num = parseInt(this.value.replace(/,/g, ''));
                    if (!isNaN(num)) {
                        this.value = num;
                    }
                }
            });
        }

        // Auto dismiss flash messages
        setTimeout(function() {
            document.querySelectorAll('[role="alert"]').forEach(function(el) {
                el.style.transition = 'opacity 0.5s ease';
                el.style.opacity = '0';
                setTimeout(function() {
                    el.remove();
                }, 500);
            });
        }, 5000);
    });
</script>

@endsection