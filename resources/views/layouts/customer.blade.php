<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Lubana Sengkol - Wisata Pemancingan Keluarga')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            primary: '#1a4d3e',
                            secondary: '#2c6e49',
                            accent: '#c9a84c',
                            'accent-light': '#f5e6b8',
                            dark: '#0d2b22',
                        },
                        ui: {
                            dark: '#0f172a',
                            muted: '#475569',
                            light: '#fafcfb',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    borderRadius: {
                        'brand-sm': '12px',
                        'brand-md': '18px',
                        'brand-lg': '28px',
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* ============================================
           KEYFRAMES & ANIMATIONS
           ============================================ */
        @keyframes pulse-wa {
            0%, 100% { box-shadow: 0 4px 16px rgba(37, 211, 102, 0.4); }
            50% { box-shadow: 0 4px 30px rgba(37, 211, 102, 0.5), 0 0 0 12px rgba(37, 211, 102, 0.15); }
        }
        .animate-pulse-wa {
            animation: pulse-wa 2s infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* ============================================
           SCROLLBAR
           ============================================ */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #fafcfb; }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #1a4d3e, #2c6e49);
            border-radius: 10px;
        }

        /* ============================================
           NAV LINK EFFECT
           ============================================ */
        .nav-link-effect {
            position: relative;
        }
        .nav-link-effect::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2.5px;
            background: linear-gradient(90deg, #c9a84c, #2c6e49);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateX(-50%);
            border-radius: 4px;
        }
        .nav-link-effect:hover::after,
        .nav-link-effect.active::after {
            width: 40%;
        }

        /* ============================================
           ALERT CLOSE BUTTON
           ============================================ */
        .close-alert-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 4px;
            transition: all 0.2s ease;
        }
        .close-alert-btn:hover {
            transform: scale(1.1);
        }

        /* ============================================
           WHATSAPP TOOLTIP
           ============================================ */
        .group:hover .group-hover\:opacity-100 {
            opacity: 1 !important;
        }
        .group:hover .group-hover\:visible {
            visibility: visible !important;
        }

        /* ============================================
           TRANSITIONS
           ============================================ */
        .transition-400 {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ============================================
           BACKGROUND RADIAL
           ============================================ */
        .bg-radial {
            background: radial-gradient(circle, var(--tw-gradient-from), var(--tw-gradient-to));
        }

        /* ============================================
           RESPONSIVE FIXES
           ============================================ */
        @media (max-width: 640px) {
            .container {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
    @stack('styles')
</head>

<body class="bg-ui-light text-ui-dark font-sans min-h-screen flex flex-col antialiased overflow-x-hidden">

    <!-- ============================================
    FLOATING WHATSAPP BUTTON
    ============================================ -->
    <a href="https://wa.me/628118065177" target="_blank" class="fixed bottom-6 sm:bottom-8 right-6 sm:right-8 z-[999] w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center text-white text-3xl shadow-lg hover:scale-105 hover:-translate-y-1 transition-all duration-300 animate-pulse-wa group" aria-label="Hubungi via WhatsApp">
        <i class="bi bi-whatsapp"></i>
        <span class="absolute right-16 bg-ui-dark text-white px-3 py-1.5 rounded-lg text-xs font-semibold whitespace-nowrap opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 shadow-md">Hubungi Kami</span>
    </a>

    <!-- ============================================
    NAVBAR
    ============================================ -->
    <nav class="sticky top-0 z-[1050] bg-white/85 backdrop-blur-xl border-b border-brand-primary/5 shadow-sm py-3 transition-400" id="mainNav">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <!-- Brand -->
            <a class="font-extrabold text-xl tracking-tight text-brand-primary flex items-center gap-3 no-underline group" href="{{ route('home') }}">
                <span class="w-10 h-10 bg-gradient-to-br from-brand-primary to-brand-secondary rounded-brand-sm flex items-center justify-center text-white text-xl shadow-md group-hover:rotate-[-6deg] group-hover:scale-105 transition-all duration-400">
                    <i class="bi bi-tree"></i>
                </span>
                <span class="leading-tight hidden xs:block">
                    Lubana<span class="text-brand-accent">.</span>Sengkol
                    <span class="block text-[11px] font-medium tracking-normal text-ui-muted mt-0.5">Wisata Pemancingan Keluarga</span>
                </span>
                <span class="leading-tight xs:hidden">
                    Lubana<span class="text-brand-accent">.</span>Sengkol
                </span>
            </a>

            <!-- Mobile Toggle -->
            <button class="lg:hidden text-brand-primary text-2xl focus:outline-none p-1" id="menuToggle" aria-label="Toggle navigation">
                <i class="bi bi-list" id="menuIcon"></i>
            </button>

            <!-- Navbar Menu -->
            <div class="hidden lg:flex flex-col lg:flex-row absolute lg:relative top-full lg:top-auto left-0 w-full lg:w-auto bg-white lg:bg-transparent border-b border-ui-muted/10 lg:border-0 p-4 lg:p-0 shadow-md lg:shadow-none items-stretch lg:items-center gap-2 z-50 transition-all duration-300" id="navbarMenu">
                <ul class="flex flex-col lg:flex-row items-stretch lg:items-center gap-1 lg:gap-2 list-none m-0 p-0 w-full lg:w-auto">
                    <li>
                        <a class="nav-link-effect font-semibold text-sm text-ui-muted hover:text-brand-primary hover:bg-brand-primary/5 px-4 py-2 rounded-brand-sm flex items-center gap-2 transition-all duration-300 {{ Request::routeIs('home') ? 'active text-brand-primary bg-brand-primary/5' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <a class="nav-link-effect font-semibold text-sm text-ui-muted hover:text-brand-primary hover:bg-brand-primary/5 px-4 py-2 rounded-brand-sm flex items-center gap-2 transition-all duration-300" href="#features">
                            <i class="bi bi-grid"></i> Fasilitas
                        </a>
                    </li>
                    <li>
                        <a class="nav-link-effect font-semibold text-sm text-ui-muted hover:text-brand-primary hover:bg-brand-primary/5 px-4 py-2 rounded-brand-sm flex items-center gap-2 transition-all duration-300" href="#location">
                            <i class="bi bi-geo-alt"></i> Lokasi
                        </a>
                    </li>
                    <li>
                        <a class="nav-link-effect font-semibold text-sm text-ui-muted hover:text-brand-primary hover:bg-brand-primary/5 px-4 py-2 rounded-brand-sm flex items-center gap-2 transition-all duration-300" href="#contact">
                            <i class="bi bi-envelope"></i> Kontak
                        </a>
                    </li>
                    <li class="lg:ml-2 mt-2 lg:mt-0 w-full lg:w-auto">
                        <a class="bg-gradient-to-r from-brand-accent to-[#b8963a] text-white font-bold text-xs px-5 py-2.5 rounded-brand-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 flex items-center justify-center gap-2 transition-all duration-300 no-underline w-full lg:w-auto" href="{{ route('customer.booking.create') }}">
                            <i class="bi bi-calendar-check"></i> Booking Sekarang
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ============================================
    MAIN CONTENT
    ============================================ -->
    <main class="flex-grow">
        <div class="container mx-auto px-4 mt-6 max-w-7xl space-y-3">
            <!-- Success Alert -->
            @if(session('success'))
            <div class="alert-premium bg-gradient-to-r from-green-50 to-green-100/70 border-l-4 border-green-700 text-green-900 rounded-brand-md p-4 shadow-md flex items-center justify-between gap-4 transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-700 text-white rounded-brand-sm flex items-center justify-center text-lg flex-shrink-0"><i class="bi bi-check-lg"></i></div>
                    <div>
                        <strong class="block text-sm">Berhasil!</strong>
                        <span class="text-xs text-green-800">{{ session('success') }}</span>
                    </div>
                </div>
                <button type="button" class="close-alert-btn text-green-700 hover:text-green-950"><i class="bi bi-x-lg"></i></button>
            </div>
            @endif

            <!-- Error Alert -->
            @if(session('error'))
            <div class="alert-premium bg-gradient-to-r from-red-50 to-red-100/70 border-l-4 border-red-700 text-red-900 rounded-brand-md p-4 shadow-md flex items-center justify-between gap-4 transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-700 text-white rounded-brand-sm flex items-center justify-center text-lg flex-shrink-0"><i class="bi bi-x-lg"></i></div>
                    <div>
                        <strong class="block text-sm">Gagal!</strong>
                        <span class="text-xs text-red-800">{{ session('error') }}</span>
                    </div>
                </div>
                <button type="button" class="close-alert-btn text-red-700 hover:text-red-950"><i class="bi bi-x-lg"></i></button>
            </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
            <div class="alert-premium bg-gradient-to-r from-red-50 to-red-100/70 border-l-4 border-red-700 text-red-900 rounded-brand-md p-4 shadow-md flex items-center justify-between gap-4 transition-all duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-700 text-white rounded-brand-sm flex items-center justify-center text-lg flex-shrink-0"><i class="bi bi-exclamation-triangle"></i></div>
                    <div>
                        <strong class="block text-sm">Terjadi Kesalahan!</strong>
                        <ul class="text-xs text-red-800 list-disc pl-4 mt-1 space-y-0.5">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="close-alert-btn text-red-700 hover:text-red-950"><i class="bi bi-x-lg"></i></button>
            </div>
            @endif
        </div>

        @yield('content')
    </main>

    <!-- ============================================
    FOOTER
    ============================================ -->
    <footer class="bg-brand-dark text-slate-400 pt-16 pb-8 relative overflow-hidden mt-auto border-t border-white/5" id="contact">
        <!-- Background Decoration -->
        <div class="absolute -top-40 -right-20 w-[400px] h-[400px] bg-radial from-brand-accent/5 to-transparent rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-40 -left-20 w-[300px] h-[300px] bg-radial from-brand-primary/10 to-transparent rounded-full pointer-events-none"></div>

        <div class="container mx-auto px-4 max-w-7xl relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 lg:gap-12">
                <!-- Brand -->
                <div class="lg:col-span-4 space-y-4">
                    <div class="text-white font-extrabold text-2xl tracking-tight">
                        Lubana<span class="text-brand-accent">.</span>Sengkol
                    </div>
                    <p class="text-sm leading-relaxed max-w-sm">
                        Wisata pemancingan keluarga dengan konsep alam yang memukau. Nikmati pengalaman tak terlupakan bersama orang tercinta di tengah suasana yang damai dan asri.
                    </p>
                    <div class="flex flex-wrap gap-2 pt-2">
                        <a href="https://instagram.com/lubanasengkol" target="_blank" class="w-10 h-10 rounded-brand-sm bg-white/5 flex items-center justify-center text-slate-400 border border-white/5 hover:bg-brand-accent hover:text-brand-dark hover:-translate-y-1 transition-all duration-300" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="https://tiktok.com/@lubanasengkol.official" target="_blank" class="w-10 h-10 rounded-brand-sm bg-white/5 flex items-center justify-center text-slate-400 border border-white/5 hover:bg-brand-accent hover:text-brand-dark hover:-translate-y-1 transition-all duration-300" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                        <a href="https://facebook.com/LubanaSengkol" target="_blank" class="w-10 h-10 rounded-brand-sm bg-white/5 flex items-center justify-center text-slate-400 border border-white/5 hover:bg-brand-accent hover:text-brand-dark hover:-translate-y-1 transition-all duration-300" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://wa.me/628118065177" target="_blank" class="w-10 h-10 rounded-brand-sm bg-white/5 flex items-center justify-center text-slate-400 border border-white/5 hover:bg-brand-accent hover:text-brand-dark hover:-translate-y-1 transition-all duration-300" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        <a href="https://youtube.com/@lubanasengkol" target="_blank" class="w-10 h-10 rounded-brand-sm bg-white/5 flex items-center justify-center text-slate-400 border border-white/5 hover:bg-brand-accent hover:text-brand-dark hover:-translate-y-1 transition-all duration-300" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- Navigasi -->
                <div class="lg:col-span-2 col-span-1">
                    <h6 class="text-white font-bold text-xs tracking-wider uppercase mb-4">Navigasi</h6>
                    <ul class="space-y-2 list-none p-0 m-0">
                        <li><a href="{{ route('home') }}" class="text-sm text-slate-400 hover:text-brand-accent hover:translate-x-1 inline-block transition-all duration-200 no-underline">Beranda</a></li>
                        <li><a href="{{ route('customer.booking') }}" class="text-sm text-slate-400 hover:text-brand-accent hover:translate-x-1 inline-block transition-all duration-200 no-underline">Booking</a></li>
                        <li><a href="#features" class="text-sm text-slate-400 hover:text-brand-accent hover:translate-x-1 inline-block transition-all duration-200 no-underline">Fasilitas</a></li>
                        <li><a href="#location" class="text-sm text-slate-400 hover:text-brand-accent hover:translate-x-1 inline-block transition-all duration-200 no-underline">Lokasi</a></li>
                    </ul>
                </div>

                <!-- Fasilitas -->
                <div class="lg:col-span-2 col-span-1">
                    <h6 class="text-white font-bold text-xs tracking-wider uppercase mb-4">Fasilitas</h6>
                    <ul class="space-y-2 list-none p-0 m-0">
                        <li><a href="#" class="text-sm text-slate-400 hover:text-brand-accent hover:translate-x-1 inline-block transition-all duration-200 no-underline">Restoran Alam</a></li>
                        <li><a href="#" class="text-sm text-slate-400 hover:text-brand-accent hover:translate-x-1 inline-block transition-all duration-200 no-underline">Pemancingan</a></li>
                        <li><a href="#" class="text-sm text-slate-400 hover:text-brand-accent hover:translate-x-1 inline-block transition-all duration-200 no-underline">Area Outbound</a></li>
                        <li><a href="#" class="text-sm text-slate-400 hover:text-brand-accent hover:translate-x-1 inline-block transition-all duration-200 no-underline">Gathering Hall</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div class="lg:col-span-4 space-y-3">
                    <h6 class="text-white font-bold text-xs tracking-wider uppercase mb-4">Hubungi Kami</h6>
                    <div class="flex items-start gap-3 text-sm">
                        <i class="bi bi-geo-alt text-brand-accent text-base mt-0.5"></i>
                        <span>Jl. Serpong Lagoon No.1, Setu, Tangerang Selatan</span>
                    </div>
                    <div class="flex items-start gap-3 text-sm">
                        <i class="bi bi-whatsapp text-brand-accent text-base mt-0.5"></i>
                        <a href="https://wa.me/628118065177" target="_blank" class="hover:text-brand-accent transition-colors">+62 811-8065-177</a>
                    </div>
                    <div class="flex items-start gap-3 text-sm">
                        <i class="bi bi-envelope text-brand-accent text-base mt-0.5"></i>
                        <a href="mailto:info@lubanasengkol.com" class="hover:text-brand-accent transition-colors">info@lubanasengkol.com</a>
                    </div>
                    <div class="flex items-start gap-3 text-sm">
                        <i class="bi bi-clock text-brand-accent text-base mt-0.5"></i>
                        <div class="space-y-0.5">
                            <div>Senin-Jumat: 09.00 - 18.00</div>
                            <div>Sabtu-Minggu: 09.00 - 20.00</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/5 my-8"></div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-500">
                <span>&copy; {{ date('Y') }} <strong class="text-white font-semibold">Lubana Sengkol</strong>. All rights reserved.</span>
                <span class="flex items-center gap-1">Made with <i class="bi bi-heart-fill text-red-500"></i> for family</span>
            </div>
        </div>
    </footer>

    <!-- ============================================
    SCRIPTS
    ============================================ -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ============================================
            // AOS ANIMATION
            // ============================================
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 700,
                    once: true,
                    easing: 'ease-out-cubic',
                    offset: 30
                });
            }

            // ============================================
            // NAVBAR SCROLL EFFECT
            // ============================================
            const navbar = document.getElementById('mainNav');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 30) {
                    navbar.classList.add('bg-white/95', 'shadow-md', 'py-1.5');
                    navbar.classList.remove('bg-white/85', 'shadow-sm', 'py-3');
                } else {
                    navbar.classList.add('bg-white/85', 'shadow-sm', 'py-3');
                    navbar.classList.remove('bg-white/95', 'shadow-md', 'py-1.5');
                }
            }, { passive: true });

            // ============================================
            // MOBILE MENU TOGGLE
            // ============================================
            const menuToggle = document.getElementById('menuToggle');
            const navbarMenu = document.getElementById('navbarMenu');
            const menuIcon = document.getElementById('menuIcon');

            if (menuToggle && navbarMenu) {
                menuToggle.addEventListener('click', function() {
                    navbarMenu.classList.toggle('hidden');
                    navbarMenu.classList.toggle('flex');
                    
                    if (navbarMenu.classList.contains('hidden')) {
                        menuIcon.className = 'bi bi-list';
                    } else {
                        menuIcon.className = 'bi bi-x-lg';
                    }
                });
            }

            // ============================================
            // DISMISS ALERTS
            // ============================================
            document.querySelectorAll('.alert-premium').forEach(function(alert) {
                const closeBtn = alert.querySelector('.close-alert-btn');
                
                if (closeBtn) {
                    closeBtn.addEventListener('click', function() {
                        alert.remove();
                    });
                }

                // Auto dismiss after 6 seconds
                setTimeout(function() {
                    if (alert && alert.parentNode) {
                        alert.style.transition = 'opacity 0.5s ease';
                        alert.style.opacity = '0';
                        setTimeout(function() {
                            if (alert && alert.parentNode) alert.remove();
                        }, 500);
                    }
                }, 6000);
            });

            // ============================================
            // SMOOTH SCROLL FOR ANCHOR LINKS
            // ============================================
            document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
                anchor.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    const target = document.querySelector(targetId);
                    if (target) {
                        e.preventDefault();
                        
                        if (navbarMenu && !navbarMenu.classList.contains('hidden') && window.innerWidth < 1024) {
                            menuToggle.click();
                        }

                        const navHeight = navbar ? navbar.offsetHeight : 80;
                        const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navHeight - 12;
                        window.scrollTo({ top: targetPosition, behavior: 'smooth' });
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>