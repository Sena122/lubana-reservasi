@extends('layouts.admin')

@section('title', 'Detail Reservasi - Lubana Sengkol')

@section('content')

<div class="max-w-4xl mx-auto mb-12">
    <a href="{{ route('admin.reservation.table') }}" class="inline-flex items-center text-xs font-black text-gray-400 hover:text-gray-900 uppercase tracking-widest mb-6 transition-all">
        <i class="bi bi-arrow-left me-2"></i> Kembali ke Riwayat Data
    </a>

    <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-hidden mb-6">

        <!-- Header -->
        <div class="bg-gray-900 p-8 md:p-10 text-white flex justify-between items-center">
            <div>
                <span class="text-[9px] font-black bg-emerald-500 text-white px-3 py-1 rounded-md uppercase tracking-widest">Arsip Digital</span>
                <h1 class="text-xl md:text-2xl font-black uppercase tracking-tight mt-2">Detail Formulir Booking</h1>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-0.5">ID Dokumen: LS-{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div class="text-right hidden sm:block">
                <p class="text-lg font-black tracking-tight text-emerald-400 uppercase">Lubana Sengkol</p>
                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-0.5">Management System</p>
            </div>
        </div>

        <div class="p-8 md:p-12 space-y-8">

            <!-- I. Data Pelanggan -->
            <div>
                <h3 class="text-[10px] font-black text-emerald-600 uppercase tracking-widest border-b border-gray-100 pb-2 mb-4">I. Data Pelanggan Utama</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Nama Pelanggan / Pemesan</p>
                        <p class="text-sm font-black text-gray-800 uppercase mt-0.5">{{ $reservation->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Nomor Kontak / WhatsApp</p>
                        <p class="text-sm font-black text-gray-800 mt-0.5">{{ $reservation->phone ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Nama Instansi / Perusahaan</p>
                        <p class="text-sm font-black text-gray-800 uppercase mt-0.5">{{ $reservation->institution ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Alamat Lengkap</p>
                        <p class="text-sm font-bold text-gray-600 uppercase mt-0.5">{{ $reservation->address ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- II. Jadwal & Lokasi -->
            <div>
                <h3 class="text-[10px] font-black text-emerald-600 uppercase tracking-widest border-b border-gray-100 pb-2 mb-4">II. Jadwal Kedatangan &amp; Penempatan</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-6">
                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Tanggal Berkunjung</p>
                        <p class="text-sm font-black text-gray-800 uppercase mt-0.5">{{ $reservation->date ? \Carbon\Carbon::parse($reservation->date)->translatedFormat('d F Y') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Jam Kedatangan</p>
                        <p class="text-sm font-black text-gray-800 mt-0.5">{{ $reservation->booking_time ? \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') : '-' }} WIB</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Jumlah Pax (Personil)</p>
                        <p class="text-sm font-black text-gray-800 mt-0.5">{{ $reservation->guest_count ?? 0 }} Orang</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Sesi Kunjungan</p>
                        <p class="text-sm font-black text-gray-800 uppercase mt-0.5">Sesi {{ $reservation->session ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Area Lokasi</p>
                        <p class="text-sm font-black text-blue-600 uppercase mt-0.5">{{ $reservation->area ?? '-' }} AREA</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Nomor Saung / Meja</p>
                        <p class="text-sm font-black text-purple-600 uppercase mt-0.5">{{ $reservation->saung_number ?? 'Menyesuaikan' }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Tipe Layanan</p>
                        <p class="text-sm font-black text-amber-600 uppercase mt-0.5">{{ $reservation->type ?? 'REGULAR' }}</p>
                    </div>
                </div>
            </div>

            <!-- III. Menu -->
            <div>
                <h3 class="text-[10px] font-black text-emerald-600 uppercase tracking-widest border-b border-gray-100 pb-2 mb-4">III. Pilihan Menu &amp; Uang Muka</h3>
                <div class="space-y-6">

                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider mb-2">Daftar Menu Restoran Terpilih</p>

                        @if($reservation->menus && $reservation->menus->count() > 0)
                        <div class="overflow-hidden border border-gray-100 rounded-2xl shadow-sm">
                            <table class="w-full text-left border-collapse bg-white">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-100">
                                        <th class="p-4 text-[9px] font-black text-gray-400 uppercase tracking-wider w-12 text-center">No</th>
                                        <th class="p-4 text-[9px] font-black text-gray-400 uppercase tracking-wider">Nama Menu</th>
                                        <th class="p-4 text-[9px] font-black text-gray-400 uppercase tracking-wider text-right">Harga Satuan</th>
                                        <th class="p-4 text-[9px] font-black text-gray-400 uppercase tracking-wider text-center w-16">Qty</th>
                                        <th class="p-4 text-[9px] font-black text-gray-400 uppercase tracking-wider text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 text-sm">
                                    @php $grandTotalMenu = 0; @endphp
                                    @foreach($reservation->menus as $index => $menu)
                                    @php
                                    $qty = $menu->pivot->quantity ?? 1;
                                    $subtotal = $menu->price * $qty;
                                    $grandTotalMenu += $subtotal;
                                    @endphp
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="p-4 text-center text-gray-400 font-bold">{{ $index + 1 }}</td>
                                        <td class="p-4 font-black text-gray-800 uppercase text-xs">{{ $menu->name }}</td>
                                        <td class="p-4 text-right text-gray-600 font-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                        <td class="p-4 text-center text-gray-800 font-black">{{ $qty }}</td>
                                        <td class="p-4 text-right text-emerald-600 font-black">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                    <tr class="bg-gray-50/70 font-black">
                                        <td colspan="4" class="p-4 text-right text-[10px] uppercase tracking-widest text-gray-400">Total Akumulasi Menu:</td>
                                        <td class="p-4 text-right text-base text-emerald-600">Rp {{ number_format($grandTotalMenu, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 text-xs font-bold text-gray-400 italic">
                            Tidak ada pemilihan menu khusus (Pemesanan Ala Carte langsung di lokasi).
                        </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Catatan Khusus Acara</p>
                            <p class="text-xs font-bold text-gray-600 mt-0.5">{{ $reservation->special_note ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Catatan Lainnya</p>
                            <p class="text-xs font-bold text-gray-600 mt-0.5">{{ $reservation->other_note ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- DP Box -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-5 bg-emerald-50/50 border border-emerald-100 rounded-2xl gap-4 mt-2">
                        <div>
                            <p class="text-[9px] font-black text-emerald-800 uppercase tracking-wider">Nilai Panjar / Down Payment (DP)</p>
                            <p class="text-xl font-black text-emerald-700 mt-0.5">Rp {{ number_format($reservation->down_payment ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <span class="inline-flex items-center text-[10px] font-black uppercase tracking-wider px-4 py-2 rounded-xl {{ ($reservation->dp_status ?? 0) ? 'bg-emerald-600 text-white' : 'bg-rose-100 text-rose-600' }}">
                                {{ ($reservation->dp_status ?? 0) ? '✅ Uang Muka Lunas' : '⏳ Belum Membayar DP' }}
                            </span>
                        </div>
                    </div>

                    <!-- ============================================
                    BUKTI PEMBAYARAN
                    ============================================ -->
                    @if($reservation->payment_proof)
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-2xl">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center">
                                <i class="bi bi-file-image"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-blue-800">Bukti Pembayaran DP</p>
                                <p class="text-[10px] text-blue-600">File telah diupload oleh pelanggan</p>
                            </div>
                            <div class="ml-auto flex gap-2">
                                <a href="{{ asset('storage/' . $reservation->payment_proof) }}" 
                                   target="_blank" 
                                   class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-[10px] font-bold transition-all">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                                <a href="{{ asset('storage/' . $reservation->payment_proof) }}" 
                                   download 
                                   class="inline-flex items-center gap-1 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-xl text-[10px] font-bold transition-all">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </div>
                        </div>
                        <!-- Preview Gambar -->
                        <div class="mt-3 border border-blue-100 rounded-xl overflow-hidden bg-white">
                            <img src="{{ asset('storage/' . $reservation->payment_proof) }}" 
                                 alt="Bukti Pembayaran" 
                                 class="w-full max-h-64 object-contain"
                                 onerror="this.src='https://via.placeholder.com/400x200/f0f0f0/999?text=Bukti+Pembayaran'">
                        </div>
                    </div>
                    @else
                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-2xl">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-400 text-white rounded-xl flex items-center justify-center">
                                <i class="bi bi-file-image"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-600">Bukti Pembayaran DP</p>
                                <p class="text-[10px] text-gray-400">Belum ada bukti pembayaran yang diupload</p>
                            </div>
                            <span class="ml-auto text-[10px] font-bold text-gray-400 bg-gray-200 px-3 py-1 rounded-full">Menunggu</span>
                        </div>
                    </div>
                    @endif

                    <!-- ============================================
                    STATUS
                    ============================================ -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-gray-50 border border-gray-200 rounded-2xl">
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-wider">Status Reservasi</p>
                            <p class="text-sm font-black text-gray-800 mt-0.5">
                                @php
                                    $statusLabels = [
                                        'pending' => '⏳ Menunggu',
                                        'confirmed' => '✅ Disetujui',
                                        'done' => '✔️ Selesai',
                                        'canceled' => '❌ Dibatalkan'
                                    ];
                                    $statusColors = [
                                        'pending' => 'bg-amber-100 text-amber-700',
                                        'confirmed' => 'bg-emerald-100 text-emerald-700',
                                        'done' => 'bg-blue-100 text-blue-700',
                                        'canceled' => 'bg-rose-100 text-rose-700'
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-black {{ $statusColors[$reservation->status ?? 'pending'] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ $statusLabels[$reservation->status ?? 'pending'] ?? ucfirst($reservation->status ?? 'pending') }}
                                </span>
                            </p>
                        </div>
                        <div class="mt-2 sm:mt-0">
                            <span class="text-[10px] text-gray-400">Dibuat: {{ $reservation->created_at ? $reservation->created_at->format('d/m/Y H:i') : '-' }}</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <a href="{{ route('admin.reservation.pdf', $reservation->id) }}" 
           target="_blank"
           class="w-full bg-gray-900 hover:bg-emerald-600 text-white font-black py-4 rounded-2xl shadow-lg transition-all text-center uppercase tracking-widest text-xs flex items-center justify-center">
            <i class="bi bi-file-pdf me-2"></i> Unduh PDF
        </a>
        <a href="{{ route('admin.reservation.edit', $reservation->id) }}" 
           class="w-full bg-amber-500 hover:bg-amber-600 text-white font-black py-4 rounded-2xl shadow-lg transition-all text-center uppercase tracking-widest text-xs flex items-center justify-center">
            <i class="bi bi-pencil me-2"></i> Edit Reservasi
        </a>
    </div>
</div>

@endsection