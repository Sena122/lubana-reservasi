@extends('layouts.admin')

@section('title', 'Dashboard - Lubana Sengkol')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <div>
            <h1 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight">Dashboard</h1>
            <p class="text-sm text-gray-500 mt-1 font-medium">
                Kelola data pemesanan saung, restoran, dan paket outbound
                <span class="text-emerald-600 font-bold">Lubana Sengkol</span>
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.reservation.create') }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all duration-300 shadow-lg shadow-emerald-200/50 hover:shadow-emerald-300/50 hover:scale-105">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Input Manual
            </a>
            <button onclick="window.print()"
                class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all duration-300">
                <i data-lucide="printer" class="w-4 h-4"></i>
                Cetak
            </button>
            <button onclick="exportData()"
                class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all duration-300">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Reservasi -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Reservasi</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">{{ $stats['total'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i data-lucide="calendar-check" class="w-5 h-5 text-emerald-600"></i>
                </div>
            </div>
            @if(isset($stats['growth']) && $stats['growth'] !== null)
            <div class="mt-3 flex items-center gap-1 text-[10px] font-bold {{ $stats['growth'] >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                <i data-lucide="{{ $stats['growth'] >= 0 ? 'trending-up' : 'trending-down' }}" class="w-3 h-3"></i>
                <span>{{ $stats['growth'] >= 0 ? '+' : '' }}{{ $stats['growth'] }}% dari bulan lalu</span>
            </div>
            @endif
        </div>

        <!-- Menunggu (Pending) -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Menunggu</p>
                    <p class="text-2xl font-black text-amber-600 mt-1">{{ $stats['pending'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i data-lucide="clock" class="w-5 h-5 text-amber-600"></i>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-1 text-[10px] font-bold text-amber-600">
                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                <span>Perlu tindakan</span>
            </div>
        </div>

        <!-- Disetujui (Confirmed) -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Disetujui</p>
                    <p class="text-2xl font-black text-emerald-600 mt-1">{{ $stats['confirmed'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-1 text-[10px] font-bold text-emerald-600">
                <i data-lucide="thumbs-up" class="w-3 h-3"></i>
                <span>Sudah dikonfirmasi</span>
            </div>
        </div>

        <!-- Batal (Canceled) -->
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 hover:scale-[1.02]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Batal</p>
                    <p class="text-2xl font-black text-rose-600 mt-1">{{ $stats['canceled'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-rose-50 to-rose-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i data-lucide="x-circle" class="w-5 h-5 text-rose-600"></i>
                </div>
            </div>
            @if(isset($stats['canceled_growth']) && $stats['canceled_growth'] !== null)
            <div class="mt-3 flex items-center gap-1 text-[10px] font-bold {{ $stats['canceled_growth'] <= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                <i data-lucide="{{ $stats['canceled_growth'] <= 0 ? 'trending-down' : 'trending-up' }}" class="w-3 h-3"></i>
                <span>{{ $stats['canceled_growth'] >= 0 ? '+' : '' }}{{ $stats['canceled_growth'] }}% dari bulan lalu</span>
            </div>
            @endif
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-col md:flex-row items-start md:items-center gap-4">
            <div class="flex-1 w-full">
                <div class="relative">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari reservasi..."
                        class="w-full pl-9 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300">
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <select name="status" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>✅ Disetujui</option>
                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>✔️ Selesai</option>
                    <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>✖️ Batal</option>
                </select>
                <select name="type" class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300">
                    <option value="">Semua Type</option>
                    <option value="REGULAR" {{ request('type') == 'REGULAR' ? 'selected' : '' }}>Regular</option>
                    <option value="VIP" {{ request('type') == 'VIP' ? 'selected' : '' }}>VIP</option>
                </select>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all duration-300 shadow-md hover:shadow-lg">
                    <i data-lucide="filter" class="w-4 h-4 inline mr-1"></i>
                    Filter
                </button>
                @if(request()->has('search') || request()->has('status') || request()->has('type'))
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-xs font-bold uppercase tracking-widest transition-colors">
                    <i data-lucide="x" class="w-4 h-4 inline"></i> Reset
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50/50 to-transparent flex items-center justify-between">
            <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest">Daftar Reservasi Terbaru</h3>
            <span class="text-[10px] font-bold text-gray-400">Total: {{ $reservations->total() ?? 0 }}</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px]">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Area</th>
                        <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Pax</th>
                        <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-3 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($reservations as $reservation)
                    <tr class="hover:bg-gray-50/50 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <div class="font-bold text-sm text-gray-900">{{ $reservation->name }}</div>
                            <div class="text-xs text-gray-500">{{ $reservation->phone }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                            {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                            <div class="text-[10px] text-gray-400">{{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-black px-2.5 py-1 rounded-lg {{ $reservation->area == 'RESTO' ? 'bg-blue-50 text-blue-600' : ($reservation->area == 'MONSTER' ? 'bg-purple-50 text-purple-600' : 'bg-gray-50 text-gray-600') }}">
                                {{ $reservation->area ?? 'RESTO' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-700">{{ $reservation->guest_count ?? 0 }}</td>
                        <td class="px-6 py-4">
                            @php
                            $statusMap = [
                            'pending' => ['bg-amber-100', 'text-amber-700', '⏳ Menunggu'],
                            'confirmed' => ['bg-emerald-100', 'text-emerald-700', '✅ Disetujui'],
                            'done' => ['bg-blue-100', 'text-blue-700', '✔️ Selesai'],
                            'canceled' => ['bg-rose-100', 'text-rose-700', '✖️ Batal'],
                            ];
                            $status = $reservation->status ?? 'pending';
                            $statusClass = $statusMap[$status] ?? $statusMap['pending'];
                            @endphp
                            <span class="text-[10px] font-black px-3 py-1.5 rounded-lg uppercase {{ $statusClass[0] }} {{ $statusClass[1] }}">
                                {{ $statusClass[2] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.reservation.edit', $reservation->id) }}"
                                    class="p-1.5 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors duration-200"
                                    title="Edit">
                                    <i data-lucide="edit-2" class="w-4 h-4 text-amber-600"></i>
                                </a>
                                <form action="{{ route('admin.reservation.destroy', $reservation->id) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-1.5 bg-rose-50 hover:bg-rose-100 rounded-lg transition-colors duration-200"
                                        title="Hapus">
                                        <i data-lucide="trash-2" class="w-4 h-4 text-rose-600"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                    <i data-lucide="inbox" class="w-8 h-8 text-gray-300"></i>
                                </div>
                                <p class="text-sm font-bold text-gray-400">Belum ada reservasi</p>
                                <p class="text-xs text-gray-300 mt-1">Mulai buat reservasi baru sekarang</p>
                                <a href="{{ route('admin.reservation.create') }}"
                                    class="mt-4 inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-bold text-xs transition-colors">
                                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                                    Buat Reservasi Baru
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reservations->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $reservations->links('pagination::tailwind') }}
        </div>
        @endif
    </div>
</div>

<script>
    function exportData() {
        Swal.fire({
            title: 'Export Data',
            text: 'Fitur export akan segera tersedia',
            icon: 'info',
            confirmButtonColor: '#10b981',
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            try {
                lucide.createIcons({
                    attrs: {
                        'stroke-width': 2,
                        'stroke-linecap': 'round',
                        'stroke-linejoin': 'round'
                    }
                });
            } catch (e) {
                console.warn('Lucide init error:', e);
            }
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

@push('styles')
<style>
    /* Dashboard Custom Styles */

    /* Card hover effects */
    .stat-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.08);
    }

    /* Table hover effect */
    tbody tr {
        transition: background-color 0.2s ease;
    }

    /* Custom scrollbar */
    .overflow-x-auto::-webkit-scrollbar {
        height: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Status badge animations */
    .status-badge {
        transition: all 0.3s ease;
    }

    .status-badge:hover {
        transform: scale(1.05);
    }

    /* Print styles */
    @media print {
        .no-print {
            display: none !important;
        }

        .bg-white {
            border: 1px solid #e2e8f0 !important;
            box-shadow: none !important;
        }

        .stat-card {
            break-inside: avoid;
            page-break-inside: avoid;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-in {
        animation: fadeInUp 0.4s ease forwards;
    }
</style>
@endpush