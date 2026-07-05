@extends('layouts.customer')

@section('title', 'Reservasi Berhasil - Lubana Sengkol')

@section('content')
<div class="max-w-md mx-auto mb-12 text-center px-4">
    
    <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden p-8 md:p-10 space-y-6 relative">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-emerald-500"></div>

        <!-- Icon Sukses -->
        <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto shadow-inner p-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <!-- Judul -->
        <div>
            <h2 class="text-2xl font-black text-gray-800 tracking-tight">Booking Berhasil!</h2>
            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-1">Kode Booking: LS-{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>

        <!-- Detail Reservasi -->
        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100 text-left space-y-2.5 text-xs font-bold text-gray-600">
            <div class="flex justify-between items-center border-b border-gray-200/60 pb-2">
                <span class="text-[9px] text-gray-400 uppercase tracking-wider">Nama:</span>
                <span class="text-gray-800 uppercase font-black">{{ $reservation->name }}</span>
            </div>
            <div class="flex justify-between items-center border-b border-gray-200/60 pb-2">
                <span class="text-[9px] text-gray-400 uppercase tracking-wider">Tanggal:</span>
                <span class="text-gray-800">{{ \Carbon\Carbon::parse($reservation->date)->translatedFormat('d F Y') }}</span>
            </div>
            <div class="flex justify-between items-center border-b border-gray-200/60 pb-2">
                <span class="text-[9px] text-gray-400 uppercase tracking-wider">Jam:</span>
                <span class="text-gray-800">{{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }} WIB</span>
            </div>
            <div class="flex justify-between items-center border-b border-gray-200/60 pb-2">
                <span class="text-[9px] text-gray-400 uppercase tracking-wider">Pax:</span>
                <span class="text-gray-800">{{ $reservation->guest_count }} Orang</span>
            </div>
            <div class="flex justify-between items-center border-b border-gray-200/60 pb-2">
                <span class="text-[9px] text-gray-400 uppercase tracking-wider">Area:</span>
                <span class="text-blue-600 uppercase font-black">{{ $reservation->area }}</span>
            </div>
            @if($reservation->menus && $reservation->menus->count() > 0)
            <div class="flex justify-between items-center border-b border-gray-200/60 pb-2">
                <span class="text-[9px] text-gray-400 uppercase tracking-wider">Total Menu:</span>
                <span class="text-emerald-600 font-black">Rp{{ number_format($totalPrice ?? 0, 0, ',', '.') }}</span>
            </div>
            @endif
            <div class="flex justify-between items-center">
                <span class="text-[9px] text-gray-400 uppercase tracking-wider">Status:</span>
                <span class="px-2.5 py-0.5 bg-amber-500 text-white text-[9px] rounded-md font-black uppercase tracking-wider">MENUNGGU KONFIRMASI</span>
            </div>
        </div>

        <!-- ⭐ TOMBOL KONFIRMASI VIA WHATSAPP ⭐ -->
        <div class="space-y-3">
            @php
                $waNumber = '628118065177'; // Ganti dengan nomor staff
                $message = "Halo Admin Lubana Sengkol,%0A%0A";
                $message .= "Saya ingin konfirmasi reservasi dengan kode: LS-" . str_pad($reservation->id, 4, '0', STR_PAD_LEFT) . "%0A%0A";
                $message .= "📋 *Detail Reservasi*:%0A";
                $message .= "Nama: " . $reservation->name . "%0A";
                $message .= "Tanggal: " . \Carbon\Carbon::parse($reservation->date)->translatedFormat('d F Y') . "%0A";
                $message .= "Jam: " . \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') . " WIB%0A";
                $message .= "Pax: " . $reservation->guest_count . " Orang%0A";
                $message .= "Area: " . $reservation->area . "%0A";
                if($reservation->menus && $reservation->menus->count() > 0) {
                    $message .= "Total Menu: Rp" . number_format($totalPrice ?? 0, 0, ',', '.') . "%0A";
                }
                $message .= "%0A";
                $message .= "Mohon dibantu konfirmasi ketersediaan dan info pembayaran DP.%0A";
                $message .= "Terima kasih. 🙏";
                
                $waUrl = "https://wa.me/" . $waNumber . "?text=" . $message;
            @endphp

            <a href="{{ $waUrl }}" 
               target="_blank" 
               class="block w-full bg-[#25D366] hover:bg-[#1da851] text-white font-black py-4 rounded-xl transition-all text-center uppercase tracking-widest text-sm shadow-lg shadow-green-200/50">
                <i class="bi bi-whatsapp me-2"></i> Konfirmasi via WhatsApp
            </a>
            
            <p class="text-[10px] text-gray-400">
                Klik tombol di atas untuk mengirim pesan konfirmasi ke admin via WhatsApp
            </p>
        </div>

        <hr class="border-gray-100">

        <!-- Tombol -->
        <div class="flex flex-col gap-3">
            <a href="{{ route('customer.booking.create') }}" class="block w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-4 rounded-xl transition-all text-center uppercase tracking-widest text-[10px] shadow-md">
                Buat Reservasi Baru
            </a>
            <a href="{{ route('home') }}" class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-black py-4 rounded-xl transition-all text-center uppercase tracking-widest text-[10px]">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeInUp 0.5s ease forwards;
    }
</style>
@endsection