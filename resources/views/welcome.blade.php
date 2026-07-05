@extends('layouts.customer')

@section('title', 'Lubana Sengkol - Wisata Pemancingan Keluarga')

@section('content')
<!-- ============================================
HERO SECTION
============================================ -->
<section class="relative min-h-[90vh] flex items-center overflow-hidden bg-gradient-to-br from-brand-primary via-brand-secondary to-brand-dark" id="home">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-brand-accent rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-brand-accent rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-white/5 rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] border border-white/10 rounded-full"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10 py-12">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div data-aos="fade-right" data-aos-duration="800">
                <span class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white/90 text-xs font-semibold px-4 py-2 rounded-full border border-white/10 mb-6">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    Wisata Pemancingan Keluarga
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-[1.1]">
                    Selamat Datang di
                    <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-accent to-[#f5e6b8]">Lubana Sengkol</span>
                </h1>
                <p class="text-white/70 text-base md:text-lg mt-4 max-w-lg leading-relaxed">
                    Tempat wisata pemancingan keluarga dengan konsep alam yang memukau. Nikmati pengalaman tak terlupakan bersama orang tercinta.
                </p>

                <!-- Stats -->
                <div class="flex flex-wrap gap-6 md:gap-10 mt-6 border-t border-white/10 pt-6">
                    <div>
                        <span class="text-2xl md:text-3xl font-extrabold text-brand-accent">15K+</span>
                        <p class="text-white/50 text-xs font-medium">Pengunjung</p>
                    </div>
                    <div>
                        <span class="text-2xl md:text-3xl font-extrabold text-brand-accent">4.8★</span>
                        <p class="text-white/50 text-xs font-medium">Rating</p>
                    </div>
                    <div>
                        <span class="text-2xl md:text-3xl font-extrabold text-brand-accent">25+</span>
                        <p class="text-white/50 text-xs font-medium">Paket Wisata</p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="{{ route('customer.booking.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-brand-accent to-[#b8963a] text-white font-bold px-8 py-3.5 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <i class="bi bi-calendar-check"></i> Booking Sekarang
                    </a>
                    <a href="#features" class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white font-semibold px-8 py-3.5 rounded-xl border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <i class="bi bi-arrow-down"></i> Lihat Fasilitas
                    </a>
                </div>
            </div>

            <!-- Right Content - Hero Image -->
            <div class="relative" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-white/10">
                    <img src="https://tangselife.com/wp-content/uploads/2023/12/LUBANA-SENGKOL.jpg"
                        alt="Lubana Sengkol - Wisata Pemancingan Keluarga"
                        class="w-full h-72 md:h-96 object-cover"
                        loading="lazy"
                        onerror="this.src='https://via.placeholder.com/600x400/1a4d3e/ffffff?text=Lubana+Sengkol'">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-dark/60 to-transparent"></div>
                </div>
                
                <!-- Floating Card -->
                <div class="absolute -bottom-6 -left-6 bg-white/95 backdrop-blur-sm rounded-xl shadow-lg p-4 flex items-center gap-3 animate-float">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-primary to-brand-secondary flex items-center justify-center text-white text-xl">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div>
                        <p class="font-bold text-ui-dark text-sm">Lubana Sengkol</p>
                        <p class="text-xs text-ui-muted">Setu, Tangerang Selatan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/30 flex flex-col items-center gap-1 animate-bounce">
        <span class="text-[10px] font-medium uppercase tracking-wider">Scroll</span>
        <i class="bi bi-chevron-down text-xl"></i>
    </div>
</section>

<!-- ============================================
FEATURES SECTION
============================================ -->
<section class="py-16 md:py-20 bg-ui-light" id="features">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto" data-aos="fade-up">
            <span class="inline-block text-xs font-bold text-brand-accent uppercase tracking-wider bg-brand-accent/10 px-4 py-1.5 rounded-full mb-4">Fasilitas</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-ui-dark">
                Nikmati Pengalaman
                <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-primary to-brand-secondary">Tak Terlupakan</span>
            </h2>
            <p class="text-ui-muted mt-3 text-base">Berbagai fasilitas terbaik untuk kenyamanan Anda</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mt-12">
            <!-- Feature 1 -->
            <div class="group bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100/50" data-aos="fade-up" data-aos-delay="100">
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-brand-primary to-brand-secondary flex items-center justify-center text-white text-3xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i class="bi bi-tree"></i>
                </div>
                <h3 class="text-xl font-extrabold text-ui-dark mt-5">Restoran Alam</h3>
                <p class="text-ui-muted text-sm mt-2 leading-relaxed">Nikmati hidangan lezat dengan pemandangan alam yang menakjubkan</p>
                <span class="inline-block mt-4 text-xs font-bold text-brand-accent bg-brand-accent/10 px-3 py-1 rounded-full">Populer</span>
            </div>

            <!-- Feature 2 -->
            <div class="group bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100/50" data-aos="fade-up" data-aos-delay="200">
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center text-white text-3xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i class="bi bi-droplet"></i>
                </div>
                <h3 class="text-xl font-extrabold text-ui-dark mt-5">Pemancingan Premium</h3>
                <p class="text-ui-muted text-sm mt-2 leading-relaxed">Area pemancingan dengan berbagai jenis ikan air tawar</p>
                <span class="inline-block mt-4 text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Premium</span>
            </div>

            <!-- Feature 3 -->
            <div class="group bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-gray-100/50" data-aos="fade-up" data-aos-delay="300">
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-brand-accent to-[#b8963a] flex items-center justify-center text-white text-3xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i class="bi bi-people"></i>
                </div>
                <h3 class="text-xl font-extrabold text-ui-dark mt-5">Outbound &amp; Gathering</h3>
                <p class="text-ui-muted text-sm mt-2 leading-relaxed">Petualangan seru dengan berbagai aktivitas outbound</p>
                <span class="inline-block mt-4 text-xs font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full">Aktif</span>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
LOCATION SECTION
============================================ -->
<section class="py-16 md:py-20 bg-white" id="location">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto" data-aos="fade-up">
            <span class="inline-block text-xs font-bold text-brand-accent uppercase tracking-wider bg-brand-accent/10 px-4 py-1.5 rounded-full mb-4">Lokasi</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-ui-dark">
                Temukan Kami
                <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-primary to-brand-secondary">Dengan Mudah</span>
            </h2>
            <p class="text-ui-muted mt-3 text-base">Berlokasi strategis di kawasan Setu, Tangerang Selatan</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 mt-12">
            <!-- Location Info -->
            <div class="bg-gradient-to-br from-brand-primary to-brand-dark rounded-2xl p-8 text-white" data-aos="fade-right">
                <h4 class="text-xl font-extrabold mb-4">
                    <i class="bi bi-geo-alt-fill text-brand-accent me-2"></i> Alamat Resmi
                </h4>
                <p class="text-white/70 text-sm leading-relaxed">
                    Jl. Serpong Lagoon No.1, RW.5, Muncul,<br>
                    Kec. Setu, Kota Tangerang Selatan,<br>
                    Banten 15314, Indonesia.
                </p>
                <hr class="border-white/10 my-6">

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-white/50 text-xs font-medium">Jam Operasional</p>
                        <p class="text-sm font-semibold">09.00 - 18.00 <span class="text-white/50 text-xs font-normal">(Sen-Jum)</span></p>
                        <p class="text-sm font-semibold">09.00 - 20.00 <span class="text-white/50 text-xs font-normal">(Sab-Ming)</span></p>
                    </div>
                    <div>
                        <p class="text-white/50 text-xs font-medium">Kontak</p>
                        <a href="https://wa.me/628118065177" target="_blank" class="text-sm font-semibold text-brand-accent hover:text-white transition-colors no-underline">
                            <i class="bi bi-whatsapp me-1"></i> +62 811-8065-177
                        </a>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-white/5 rounded-xl border border-white/10">
                    <p class="text-xs text-white/60 italic">
                        <i class="bi bi-info-circle me-1"></i>
                        "Berlokasi strategis di kawasan Setu, dekat dengan area perumahan Serpong Lagoon.
                        Akses mudah melalui tol Jakarta-Serpong (keluar di BSD/Serpong)."
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 mt-6">
                    <a href="https://maps.google.com/?q=Jl.+Serpong+Lagoon+No.1,+Setu,+Tangerang+Selatan" target="_blank" class="inline-flex items-center gap-2 bg-white text-brand-primary font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-gray-100 transition-colors no-underline">
                        <i class="bi bi-map"></i> Buka Google Maps
                    </a>
                    <a href="https://wa.me/628118065177" target="_blank" class="inline-flex items-center gap-2 bg-[#25D366] text-white font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-[#1da851] transition-colors no-underline">
                        <i class="bi bi-whatsapp"></i> Hubungi WhatsApp
                    </a>
                </div>
            </div>

            <!-- Map -->
            <div class="rounded-2xl overflow-hidden shadow-lg h-[400px] lg:h-auto" data-aos="fade-left">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63471.123456789!2d106.7!3d-6.3!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTgnMzAuMCJTIDEwNsKwNDInMzAuMCJF!5e0!3m2!1sen!2sid!4v1234567890"
                    width="100%"
                    height="100%"
                    style="border:0; min-height:400px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
CTA SECTION
============================================ -->
<section class="py-16 md:py-20 bg-ui-light">
    <div class="container mx-auto px-4">
        <div class="bg-gradient-to-r from-brand-primary to-brand-secondary rounded-2xl p-8 md:p-12 text-center md:text-left" data-aos="zoom-in">
            <div class="grid md:grid-cols-3 gap-6 items-center">
                <div class="md:col-span-2 text-white">
                    <h2 class="text-2xl md:text-3xl font-extrabold">Siap Untuk Liburan?</h2>
                    <p class="text-white/70 text-sm md:text-base mt-2 max-w-lg">
                        Booking sekarang dan dapatkan pengalaman tak terlupakan di Lubana Sengkol
                    </p>
                    <div class="flex flex-wrap gap-4 mt-3 text-sm">
                        <span class="flex items-center gap-1 text-brand-accent"><i class="bi bi-whatsapp"></i> +62 811-8065-177</span>
                        <span class="text-white/30 hidden md:block">|</span>
                        <span class="flex items-center gap-1 text-brand-accent"><i class="bi bi-instagram"></i> @lubanasengkol</span>
                        <span class="text-white/30 hidden md:block">|</span>
                        <span class="flex items-center gap-1 text-brand-accent"><i class="bi bi-clock"></i> 09.00 - 18.00 WIB</span>
                    </div>
                </div>
                <div class="text-center md:text-right">
                    <a href="{{ route('customer.booking.create') }}" class="inline-flex items-center gap-2 bg-white text-brand-primary font-bold px-8 py-3.5 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 no-underline">
                        <i class="bi bi-calendar-check"></i> Booking Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
ADDITIONAL STYLES
============================================ -->
<style>
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .animate-bounce {
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateX(-50%) translateY(0);
        }

        50% {
            transform: translateX(-50%) translateY(-8px);
        }
    }
</style>
@endsection