@extends('layouts.customer')

@section('title', 'Booking - Lubana Sengkol')

@section('content')
<div class="py-8 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 bg-brand-accent/10 text-brand-accent font-semibold text-xs px-4 py-2 rounded-full mb-4 tracking-wide">
                <i class="bi bi-calendar-check"></i> Booking Online
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-ui-dark leading-tight">
                Pesan Tempat
                <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-accent to-[#b8963a]">Lubana Sengkol</span>
            </h1>
            <p class="text-ui-muted text-sm sm:text-base md:text-lg mt-3 sm:mt-4 max-w-2xl mx-auto px-4">
                Pilih fasilitas yang ingin Anda pesan dan nikmati pengalaman wisata pemancingan keluarga yang tak terlupakan
            </p>
        </div>

        <!-- Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-8 sm:mt-12">
            <!-- Card 1: Restoran -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100/50 group" data-aos="fade-up" data-aos-delay="100">
                <div class="p-6 sm:p-8 text-center">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-2xl bg-gradient-to-br from-brand-primary to-brand-secondary flex items-center justify-center text-white text-2xl sm:text-3xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="bi bi-tree"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-extrabold text-ui-dark mt-4 sm:mt-5">Restoran Alam</h3>
                    <p class="text-ui-muted text-xs sm:text-sm mt-2 leading-relaxed">
                        Nikmati hidangan lezat dengan pemandangan alam yang menakjubkan
                    </p>
                    <ul class="mt-4 space-y-2 text-left text-xs sm:text-sm">
                        <li class="flex items-center gap-2 text-ui-muted">
                            <i class="bi bi-check-circle-fill text-green-600 text-sm"></i>
                            Menu Nusantara
                        </li>
                        <li class="flex items-center gap-2 text-ui-muted">
                            <i class="bi bi-check-circle-fill text-green-600 text-sm"></i>
                            Pemandangan Alam
                        </li>
                        <li class="flex items-center gap-2 text-ui-muted">
                            <i class="bi bi-check-circle-fill text-green-600 text-sm"></i>
                            Kapasitas 50+ orang
                        </li>
                    </ul>
                    <a href="{{ route('customer.booking.create') }}" class="mt-6 inline-flex items-center justify-center w-full bg-gradient-to-r from-brand-primary to-brand-secondary text-white font-bold text-xs sm:text-sm px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        <i class="bi bi-calendar-plus me-2"></i> Pesan Restoran
                    </a>
                </div>
            </div>

            <!-- Card 2: Pemancingan -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100/50 group" data-aos="fade-up" data-aos-delay="200">
                <div class="p-6 sm:p-8 text-center">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-2xl bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center text-white text-2xl sm:text-3xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="bi bi-droplet"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-extrabold text-ui-dark mt-4 sm:mt-5">Pemancingan Premium</h3>
                    <p class="text-ui-muted text-xs sm:text-sm mt-2 leading-relaxed">
                        Area pemancingan dengan berbagai jenis ikan air tawar
                    </p>
                    <ul class="mt-4 space-y-2 text-left text-xs sm:text-sm">
                        <li class="flex items-center gap-2 text-ui-muted">
                            <i class="bi bi-check-circle-fill text-green-600 text-sm"></i>
                            Ikan Nila &amp; Gurame
                        </li>
                        <li class="flex items-center gap-2 text-ui-muted">
                            <i class="bi bi-check-circle-fill text-green-600 text-sm"></i>
                            Area Teduh &amp; Nyaman
                        </li>
                        <li class="flex items-center gap-2 text-ui-muted">
                            <i class="bi bi-check-circle-fill text-green-600 text-sm"></i>
                            Alat Pancing Tersedia
                        </li>
                    </ul>
                    <a href="{{ route('customer.booking.create') }}" class="mt-6 inline-flex items-center justify-center w-full bg-gradient-to-r from-brand-primary to-brand-secondary text-white font-bold text-xs sm:text-sm px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        <i class="bi bi-calendar-plus me-2"></i> Pesan Pemancingan
                    </a>
                </div>
            </div>

            <!-- Card 3: Outbound -->
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100/50 group sm:col-span-2 lg:col-span-1" data-aos="fade-up" data-aos-delay="300">
                <div class="p-6 sm:p-8 text-center">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-2xl bg-gradient-to-br from-brand-accent to-[#b8963a] flex items-center justify-center text-white text-2xl sm:text-3xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="bi bi-people"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-extrabold text-ui-dark mt-4 sm:mt-5">Outbound &amp; Gathering</h3>
                    <p class="text-ui-muted text-xs sm:text-sm mt-2 leading-relaxed">
                        Aktivitas seru untuk keluarga, komunitas, dan korporasi
                    </p>
                    <ul class="mt-4 space-y-2 text-left text-xs sm:text-sm">
                        <li class="flex items-center gap-2 text-ui-muted">
                            <i class="bi bi-check-circle-fill text-green-600 text-sm"></i>
                            10+ Aktivitas Seru
                        </li>
                        <li class="flex items-center gap-2 text-ui-muted">
                            <i class="bi bi-check-circle-fill text-green-600 text-sm"></i>
                            Kapasitas 100+ orang
                        </li>
                        <li class="flex items-center gap-2 text-ui-muted">
                            <i class="bi bi-check-circle-fill text-green-600 text-sm"></i>
                            Paket Corporate Tersedia
                        </li>
                    </ul>
                    <a href="{{ route('customer.booking.create') }}" class="mt-6 inline-flex items-center justify-center w-full bg-gradient-to-r from-brand-primary to-brand-secondary text-white font-bold text-xs sm:text-sm px-4 sm:px-6 py-2.5 sm:py-3 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        <i class="bi bi-calendar-plus me-2"></i> Pesan Outbound
                    </a>
                </div>
            </div>
        </div>

        <!-- Info Tambahan -->
        <div class="mt-10 sm:mt-16 bg-gradient-to-r from-gray-50 to-gray-100/70 rounded-2xl p-4 sm:p-6 md:p-8 border border-gray-200/50" data-aos="fade-up" data-aos-delay="400">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center">
                <div class="space-y-1">
                    <i class="bi bi-whatsapp text-2xl sm:text-3xl text-green-600"></i>
                    <p class="text-[10px] sm:text-xs text-ui-muted">Kontak</p>
                    <a href="https://wa.me/628118065177" target="_blank" class="text-xs sm:text-sm font-bold text-brand-primary hover:text-brand-accent transition-colors no-underline block truncate">
                        +62 811-8065-177
                    </a>
                </div>
                <div class="space-y-1">
                    <i class="bi bi-clock text-2xl sm:text-3xl text-amber-600"></i>
                    <p class="text-[10px] sm:text-xs text-ui-muted">Jam Operasional</p>
                    <p class="text-[10px] sm:text-xs font-semibold text-ui-dark">09.00 - 18.00 <span class="text-ui-muted font-normal">(Sen-Jum)</span></p>
                    <p class="text-[10px] sm:text-xs font-semibold text-ui-dark">09.00 - 20.00 <span class="text-ui-muted font-normal">(Sab-Ming)</span></p>
                </div>
                <div class="space-y-1">
                    <i class="bi bi-geo-alt text-2xl sm:text-3xl text-red-500"></i>
                    <p class="text-[10px] sm:text-xs text-ui-muted">Lokasi</p>
                    <p class="text-[10px] sm:text-xs font-semibold text-ui-dark">Jl. Serpong Lagoon No.1</p>
                    <p class="text-[10px] sm:text-xs font-semibold text-ui-dark">Setu, Tangerang Selatan</p>
                </div>
                <div class="space-y-1">
                    <i class="bi bi-instagram text-2xl sm:text-3xl text-pink-600"></i>
                    <p class="text-[10px] sm:text-xs text-ui-muted">Media Sosial</p>
                    <a href="https://instagram.com/lubanasengkol" target="_blank" class="text-xs sm:text-sm font-bold text-brand-primary hover:text-brand-accent transition-colors no-underline block truncate">
                        @lubanasengkol
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection