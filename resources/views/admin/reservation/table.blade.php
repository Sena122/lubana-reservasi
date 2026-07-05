@extends('layouts.admin')

@section('title', 'Arsip Data Reservasi - Lubana Sengkol')

@section('content')

<!-- Toast Notification untuk status_updated -->
@if(session('status_updated'))
<div id="toast" class="fixed bottom-6 right-6 z-50 bg-gray-900 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 animate-in">
    <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400"></i>
    <span class="text-xs font-bold uppercase tracking-widest">{{ session('status_updated') }}</span>
    <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-white">✕</button>
</div>
@endif

<div class="flex flex-col lg:flex-row items-start lg:items-center justify-between mb-8 gap-6">
    <div>
        <h1 class="text-2xl md:text-4xl font-black text-gray-900 tracking-tight">Arsip Data Reservasi</h1>
        <p class="text-xs text-gray-500 mt-1 uppercase font-bold tracking-widest">Riwayat Lengkap Formulir Booking Lubana Sengkol</p>
    </div>
    <a href="{{ route('admin.reservation.create') }}" class="flex items-center bg-gray-900 hover:bg-emerald-600 text-white px-7 py-4 rounded-2xl font-black shadow-xl transition-all text-[10px] uppercase tracking-widest">
        <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i> Buat Bookingan Baru
    </a>
</div>

<div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm mb-8">
    <form action="{{ route('admin.reservation.table') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="sm:col-span-2 lg:col-span-1 bg-gray-50 rounded-xl px-4 py-3 flex items-center border-2 border-transparent focus-within:border-emerald-400 focus-within:bg-white transition-all">
            <i data-lucide="search" class="w-4 h-4 text-gray-400 mr-3"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, wa, instansi..." class="bg-transparent border-none p-0 w-full text-xs font-bold text-gray-700 outline-none">
        </div>
        <div class="bg-gray-50 rounded-xl px-4 py-3 flex items-center border-2 border-transparent focus-within:border-emerald-400 focus-within:bg-white transition-all">
            <i data-lucide="calendar" class="w-4 h-4 text-gray-400 mr-3"></i>
            <input type="date" name="date" value="{{ request('date') }}" class="bg-transparent border-none p-0 w-full text-xs font-bold text-gray-700 outline-none">
        </div>
        <div class="bg-gray-50 rounded-xl px-4 py-3 flex items-center border-2 border-transparent focus-within:border-emerald-400 focus-within:bg-white transition-all">
            <i data-lucide="map-pin" class="w-4 h-4 text-gray-400 mr-3"></i>
            <select name="area" class="bg-transparent border-none p-0 w-full text-xs font-black text-gray-700 outline-none">
                <option value="">SEMUA AREA</option>
                <option value="RESTO" {{ request('area') == 'RESTO' ? 'selected' : '' }}>RESTO AREA</option>
                <option value="MONSTER" {{ request('area') == 'MONSTER' ? 'selected' : '' }}>MONSTER FISH</option>
            </select>
        </div>
        <div class="bg-gray-50 rounded-xl px-4 py-3 flex items-center border-2 border-transparent focus-within:border-emerald-400 focus-within:bg-white transition-all">
            <i data-lucide="filter" class="w-4 h-4 text-gray-400 mr-3"></i>
            <select name="status" class="bg-transparent border-none p-0 w-full text-xs font-black text-gray-700 outline-none">
                <option value="">SEMUA STATUS</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>MENUNGGU</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>DISETUJUI</option>
                <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>SELESAI</option>
                <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>BATAL</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-gray-900 hover:bg-gray-800 text-white font-black text-[10px] uppercase tracking-widest rounded-xl py-3 shadow-md">Terapkan Filter</button>
            @if(request()->anyFilled(['search', 'date', 'area', 'status']))
            <a href="{{ route('admin.reservation.table') }}" class="bg-rose-50 text-rose-600 rounded-xl px-4 flex items-center justify-center hover:bg-rose-100 transition-colors"><i data-lucide="refresh-cw" class="w-4 h-4"></i></a>
            @endif
        </div>
    </form>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[1100px]">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Identitas</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-center">Tgl Input</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-center">Waktu/Sesi</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-center">Jenis/Area</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-center">Pax</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-center">DP</th>
                    <th class="px-4 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-center">Status</th>
                    <th class="px-6 py-4 text-[9px] font-black text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($reservations as $r)
                <tr class="hover:bg-gray-50/50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="text-gray-900 font-black text-sm">{{ $r->name ?? 'Tanpa Nama' }}</div>
                        <div class="text-[10px] text-gray-400 font-bold mt-0.5">{{ $r->phone ?? '-' }} {{ $r->institution ? '• '.$r->institution : '' }}</div>
                    </td>
                    <td class="px-4 py-4 text-center text-xs font-black text-gray-700">
                        {{ $r->created_at ? $r->created_at->format('d M Y') : '-' }}<br>
                        <span class="text-[9px] text-gray-400">{{ $r->created_at ? $r->created_at->format('H:i') : '' }} WIB</span>
                    </td>
                    <td class="px-4 py-4 text-center text-sm font-black text-gray-800">
                        {{ $r->booking_time ? \Carbon\Carbon::parse($r->booking_time)->format('H:i') : '-' }}<br>
                        <span class="text-[9px] text-gray-400">SESI {{ $r->session ?? '-' }}</span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <span class="text-[9px] font-black px-1.5 py-0.5 rounded {{ ($r->type ?? '') == 'VIP' ? 'bg-amber-500 text-white' : 'bg-gray-200 text-gray-700' }}">{{ $r->type ?? '-' }}</span>
                        <span class="text-[9px] font-black text-blue-600 bg-blue-50 px-2 py-0.5 rounded">{{ $r->area ?? '-' }}</span>
                    </td>
                    <td class="px-4 py-4 text-center text-sm font-black">{{ $r->guest_count ?? 0 }}</td>
                    <td class="px-4 py-4 text-center">
                        <span class="text-[9px] font-black px-2 py-1 rounded {{ ($r->dp_status ?? false) ? 'text-emerald-700 bg-emerald-50' : 'text-rose-600 bg-rose-50' }}">
                            {{ ($r->dp_status ?? false) ? 'LUNAS ('.number_format($r->down_payment ?? 0, 0, ',', '.').')' : 'BELUM DP' }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-center">
                        <!-- Status dengan Dropdown untuk Update Cepat -->
                        <form action="{{ route('admin.reservation.update-status', $r->id) }}" method="POST" class="status-form inline-block">
                            @csrf
                            @method('PUT')
                            <select name="status"
                                onchange="this.closest('form').submit()"
                                class="text-[9px] font-black px-3 py-1.5 rounded-lg border-2 cursor-pointer transition-all uppercase
                                           {{ ($r->status ?? 'pending') == 'done' ? 'border-emerald-500 bg-emerald-50 text-emerald-700' : '' }}
                                           {{ ($r->status ?? 'pending') == 'confirmed' ? 'border-blue-500 bg-blue-50 text-blue-700' : '' }}
                                           {{ ($r->status ?? 'pending') == 'pending' ? 'border-amber-500 bg-amber-50 text-amber-700' : '' }}
                                           {{ ($r->status ?? 'pending') == 'canceled' ? 'border-rose-500 bg-rose-50 text-rose-700' : '' }}
                                           hover:opacity-80 focus:outline-none focus:ring-2 focus:ring-offset-1
                                           {{ ($r->status ?? 'pending') == 'done' ? 'focus:ring-emerald-500' : '' }}
                                           {{ ($r->status ?? 'pending') == 'confirmed' ? 'focus:ring-blue-500' : '' }}
                                           {{ ($r->status ?? 'pending') == 'pending' ? 'focus:ring-amber-500' : '' }}
                                           {{ ($r->status ?? 'pending') == 'canceled' ? 'focus:ring-rose-500' : '' }}">
                                <option value="pending" {{ ($r->status ?? 'pending') == 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                                <option value="confirmed" {{ ($r->status ?? 'pending') == 'confirmed' ? 'selected' : '' }}>✅ Disetujui</option>
                                <option value="done" {{ ($r->status ?? 'pending') == 'done' ? 'selected' : '' }}>✔️ Selesai</option>
                                <option value="canceled" {{ ($r->status ?? 'pending') == 'canceled' ? 'selected' : '' }}>✖️ Batal</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-1.5">
                            <a href="{{ route('admin.reservation.show', $r->id) }}" class="p-2 bg-gray-100 hover:bg-gray-900 text-gray-600 hover:text-white rounded-lg transition-all" title="Detail">
                                <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                            </a>
                            <a href="{{ route('admin.reservation.edit', $r->id) }}" class="p-2 bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white rounded-lg transition-all" title="Edit">
                                <i data-lucide="edit-2" class="w-3.5 h-3.5"></i>
                            </a>
                            <a href="{{ route('admin.reservation.pdf', $r->id) }}" target="_blank" class="p-2 bg-blue-50 hover:bg-blue-500 text-blue-600 hover:text-white rounded-lg transition-all" title="Download PDF">
                                <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
                            </a>
                            <form action="{{ route('admin.reservation.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-rose-50 hover:bg-rose-500 text-rose-600 hover:text-white rounded-lg transition-all" title="Hapus">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-10 text-xs text-gray-400 font-bold">Data tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(isset($reservations) && $reservations->hasPages())
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
        {{ $reservations->links('pagination::tailwind') }}
    </div>
    @endif
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

        // Auto dismiss toast
        setTimeout(function() {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.style.transition = 'opacity 0.5s ease';
                toast.style.opacity = '0';
                setTimeout(function() {
                    toast.remove();
                }, 500);
            }
        }, 5000);

        // Auto dismiss success messages
        setTimeout(function() {
            const successMsg = document.querySelector('.bg-gradient-to-r.from-emerald-500');
            if (successMsg) {
                successMsg.style.transition = 'opacity 0.5s ease';
                successMsg.style.opacity = '0';
                setTimeout(function() {
                    successMsg.remove();
                }, 500);
            }
        }, 5000);

        // Confirm delete with SweetAlert if available
        document.querySelectorAll('form[onsubmit*="confirm"]').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                if (typeof Swal !== 'undefined') {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin hapus data ini?',
                        text: 'Data yang dihapus tidak dapat dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                }
            });
        });
    });
</script>

<style>
    .animate-in {
        animation: slideIn 0.3s ease forwards;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* Status select styling */
    .status-form select {
        min-width: 100px;
    }

    .status-form select option {
        font-weight: 700;
        padding: 4px 8px;
    }

    /* Hover effect for action buttons */
    .group:hover .p-2 {
        transform: scale(1.05);
    }
</style>

@endsection