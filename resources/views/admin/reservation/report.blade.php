@extends('layouts.admin')

@section('title', 'Laporan Reservasi - Lubana Sengkol')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
        <div>
            <h1 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight">📊 Laporan Reservasi</h1>
            <p class="text-sm text-gray-500 mt-1 font-medium">
                Rekap data reservasi <span class="text-emerald-600 font-bold">Lubana Sengkol</span>
            </p>
        </div>
        <button onclick="window.print()" 
            class="inline-flex items-center gap-2 bg-gray-900 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all duration-300 shadow-lg shadow-gray-200/50 hover:shadow-emerald-300/50">
            <i data-lucide="printer" class="w-4 h-4"></i>
            Cetak Laporan
        </button>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">Dari Tanggal</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>
            <div>
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">Sampai Tanggal</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">
            </div>
            <div>
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">Status</label>
                <select name="status" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Disetujui</option>
                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Selesai</option>
                    <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>
            <div>
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-1">Area</label>
                <select name="area" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="">Semua Area</option>
                    <option value="RESTO" {{ request('area') == 'RESTO' ? 'selected' : '' }}>RESTO</option>
                    <option value="MONSTER" {{ request('area') == 'MONSTER' ? 'selected' : '' }}>MONSTER</option>
                </select>
            </div>
            <div class="md:col-span-4 flex gap-3">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest transition-all">
                    <i data-lucide="filter" class="w-4 h-4 inline mr-1"></i>
                    Filter
                </button>
                <a href="{{ route('admin.reservation.report') }}" class="text-gray-400 hover:text-gray-600 text-xs font-bold uppercase tracking-widest transition-colors flex items-center">
                    <i data-lucide="x" class="w-4 h-4 inline mr-1"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Reservasi</p>
            <p class="text-2xl font-black text-gray-900 mt-1">{{ $totalReservations ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Tamu</p>
            <p class="text-2xl font-black text-blue-600 mt-1">{{ $totalGuests ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total DP</p>
            <p class="text-2xl font-black text-emerald-600 mt-1">Rp{{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Rata-rata Tamu</p>
            <p class="text-2xl font-black text-amber-600 mt-1">
                {{ $totalReservations > 0 ? round($totalGuests / $totalReservations, 1) : 0 }}
            </p>
        </div>
    </div>

    <!-- Status Distribution -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Distribusi Status</h3>
            <div class="space-y-2">
                @foreach($statusCounts ?? [] as $status => $count)
                <div class="flex items-center justify-between">
                    <span class="text-sm font-bold text-gray-600">
                        {{ ucfirst($status) }}
                    </span>
                    <span class="text-sm font-black text-gray-900">{{ $count }}</span>
                </div>
                @endforeach
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Distribusi Area</h3>
            <div class="space-y-2">
                @foreach($areaCounts ?? [] as $area => $count)
                <div class="flex items-center justify-between">
                    <span class="text-sm font-bold text-gray-600">{{ $area }}</span>
                    <span class="text-sm font-black text-gray-900">{{ $count }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-r from-gray-50/50 to-transparent">
            <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest">Detail Reservasi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px]">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Area</th>
                        <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Pax</th>
                        <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">DP</th>
                        <th class="px-6 py-3 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($reservations ?? [] as $r)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-sm text-gray-900">{{ $r->name }}</div>
                            <div class="text-xs text-gray-500">{{ $r->phone }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-700">
                            {{ \Carbon\Carbon::parse($r->date)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs font-black px-2.5 py-1 rounded-lg {{ $r->area == 'RESTO' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                                {{ $r->area ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-bold text-gray-700">{{ $r->guest_count ?? 0 }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-emerald-600">
                            Rp{{ number_format($r->down_payment ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                            $statusMap = [
                                'pending' => 'bg-amber-100 text-amber-700',
                                'confirmed' => 'bg-emerald-100 text-emerald-700',
                                'done' => 'bg-blue-100 text-blue-700',
                                'canceled' => 'bg-rose-100 text-rose-700',
                            ];
                            @endphp
                            <span class="text-[10px] font-black px-3 py-1.5 rounded-lg uppercase {{ $statusMap[$r->status ?? 'pending'] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($r->status ?? 'pending') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-sm font-bold text-gray-400">
                            Belum ada data reservasi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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