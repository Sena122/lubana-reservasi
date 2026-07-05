<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Lubana Sengkol')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @stack('styles')

    <style>
        /* ============================================
           GLOBAL STYLES
           ============================================ */
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background: #f8fafc;
        }

        /* ============================================
           SCROLLBAR STYLING
           ============================================ */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* ============================================
           ANIMATIONS
           ============================================ */
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

        .animate-in {
            animation: slideIn 0.3s ease forwards;
        }

        /* ============================================
           SIDEBAR STYLES
           ============================================ */
        #sidebar .sidebar-menu a i {
            transition: all 0.2s ease;
        }

        #sidebar .sidebar-menu a:hover i {
            color: #c9a84c;
        }

        #sidebar .sidebar-menu a.bg-\[\#1a4d3e\] i {
            color: #c9a84c;
        }

        /* Sidebar custom scrollbar */
        #sidebar .sidebar-scroll {
            scrollbar-width: thin;
            scrollbar-color: #c9a84c transparent;
        }

        #sidebar .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        #sidebar .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        #sidebar .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #c9a84c;
            border-radius: 9999px;
        }

        /* ============================================
           FORM STYLES (Global)
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

        /* ============================================
           TOGGLE SWITCH (Global)
           ============================================ */
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

        /* ============================================
           PRINT STYLES
           ============================================ */
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

            #sidebar,
            header.sticky {
                display: none !important;
            }

            #mainWrapper {
                margin-left: 0 !important;
            }
        }

        /* ============================================
           RESPONSIVE FIXES
           ============================================ */
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

        /* ============================================
           UTILITY CLASSES
           ============================================ */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
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
            flex-shrink: 0;
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
    </style>
</head>

<body class="bg-slate-50 text-slate-800 min-h-screen overflow-x-hidden font-['Inter']">

    <!-- Sidebar Overlay (Mobile) -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-[1045] hidden lg:hidden"></div>

    <!-- ============================================
    SIDEBAR
    ============================================ -->
    <aside id="sidebar"
        class="fixed top-0 left-0 bottom-0 w-[260px] bg-[#0f1a15] text-slate-200 z-[1050] 
                  transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] overflow-y-auto overflow-x-hidden 
                  shadow-[4px_0_20px_rgba(0,0,0,0.1)]
                  -translate-x-full lg:translate-x-0
                  [&.collapsed]:w-[70px]
                  [&.collapsed_.brand-text]:hidden
                  [&.collapsed_.menu-text]:hidden
                  [&.collapsed_.badge-menu]:hidden
                  [&.collapsed_.sidebar-brand]:justify-center
                  [&.collapsed_.sidebar-brand]:!px-0
                  [&.collapsed_.sidebar-brand]:!py-5
                  [&.collapsed_.sidebar-menu_a]:justify-center
                  [&.collapsed_.sidebar-menu_a]:!px-[0.7rem]
                  [&.collapsed_.sidebar-menu_a]:!py-[0.7rem]
                  [&.collapsed_.sidebar-menu_a_i]:!text-[1.3rem]
                  [&.collapsed_.sidebar-menu_a_i]:!mr-0
                  [&.show]:translate-x-0">

        <div class="sidebar-scroll h-full">

            <!-- Brand -->
            <div class="sidebar-brand flex items-center gap-3 px-6 py-5 min-h-[64px] border-b border-white/10">
                <div class="w-[38px] h-[38px] bg-gradient-to-br from-[#c9a84c] to-[#f5e6b8] rounded-xl flex items-center justify-center text-white font-extrabold text-lg flex-shrink-0">
                    LS
                </div>
                <span class="brand-text text-white font-extrabold text-[1.15rem] tracking-tight whitespace-nowrap">
                    Lubana<span class="text-[#c9a84c]">.</span>Sengkol
                </span>
            </div>

            <!-- ============================================
            MENU UTAMA
            ============================================ -->

            <!-- 1. Dashboard -->
            <ul class="sidebar-menu list-none px-3 py-4 m-0 space-y-0.5">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="sidebar-menu_a flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/65 hover:bg-[#1a4d3e] hover:text-white transition-all duration-200 font-medium text-sm whitespace-nowrap
                              {{ Request::routeIs('admin.dashboard') ? 'bg-[#1a4d3e] text-white shadow-[0_4px_15px_rgba(26,77,62,0.3)]' : '' }}">
                        <i class="fa-solid fa-gauge-high text-[1.1rem] w-5 text-center flex-shrink-0"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <div class="border-t border-white/5 mx-3"></div>

            <!-- 2. Data Reservasi -->
            <ul class="sidebar-menu list-none px-3 py-4 m-0 space-y-0.5">
                <li>
                    <a href="{{ route('admin.reservation.table') }}"
                        class="sidebar-menu_a flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/65 hover:bg-[#1a4d3e] hover:text-white transition-all duration-200 font-medium text-sm whitespace-nowrap
                              {{ Request::routeIs('admin.reservation.*') && !Request::routeIs('admin.reservation.create') && !Request::routeIs('admin.reservation.edit') ? 'bg-[#1a4d3e] text-white shadow-[0_4px_15px_rgba(26,77,62,0.3)]' : '' }}">
                        <i class="fa-regular fa-calendar-check text-[1.1rem] w-5 text-center flex-shrink-0"></i>
                        <span class="menu-text">Data Reservasi</span>
                        <span class="badge-menu ml-auto bg-[#c9a84c] text-[#0f1a15] text-[0.55rem] font-bold px-2 py-0.5 rounded-full">
                            {{ App\Models\Reservation::where('status', 'pending')->count() }}
                        </span>
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <div class="border-t border-white/5 mx-3"></div>

            <!-- 3. Kelola Menu -->
            <ul class="sidebar-menu list-none px-3 py-4 m-0 space-y-0.5">
                <li>
                    <a href="{{ route('admin.menu.index') }}"
                        class="sidebar-menu_a flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/65 hover:bg-[#1a4d3e] hover:text-white transition-all duration-200 font-medium text-sm whitespace-nowrap
                              {{ Request::routeIs('admin.menu.*') ? 'bg-[#1a4d3e] text-white shadow-[0_4px_15px_rgba(26,77,62,0.3)]' : '' }}">
                        <i class="fa-solid fa-utensils text-[1.1rem] w-5 text-center flex-shrink-0"></i>
                        <span class="menu-text">Kelola Menu</span>
                        <span class="badge-menu ml-auto bg-[#c9a84c] text-[#0f1a15] text-[0.55rem] font-bold px-2 py-0.5 rounded-full">CRUD</span>
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <div class="border-t border-white/5 mx-3"></div>

            <!-- 4. Laporan -->
            <ul class="sidebar-menu list-none px-3 py-4 m-0 space-y-0.5">
                <li>
                    <a href="{{ route('admin.reservation.report') }}"
                        class="sidebar-menu_a flex items-center gap-3 px-4 py-2.5 rounded-xl text-white/65 hover:bg-[#1a4d3e] hover:text-white transition-all duration-200 font-medium text-sm whitespace-nowrap
                              {{ Request::routeIs('admin.reservation.report') ? 'bg-[#1a4d3e] text-white shadow-[0_4px_15px_rgba(26,77,62,0.3)]' : '' }}">
                        <i class="fa-solid fa-chart-simple text-[1.1rem] w-5 text-center flex-shrink-0"></i>
                        <span class="menu-text">Laporan</span>
                    </a>
                </li>
            </ul>

            <!-- Bottom spacer -->
            <div class="h-8"></div>

        </div>
    </aside>

    <!-- ============================================
    MAIN WRAPPER
    ============================================ -->
    <div id="mainWrapper"
        class="ml-0 lg:ml-[260px] transition-all duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] min-h-screen flex flex-col
                [.sidebar.collapsed_~_&]:lg:ml-[70px]">

        <!-- TOPBAR -->
        <header class="sticky top-0 h-16 bg-white/92 backdrop-blur-[12px] border-b border-slate-200 flex items-center justify-between px-4 md:px-6 z-[1040] flex-shrink-0">

            <!-- Left Section -->
            <div class="flex items-center gap-4 min-w-0">
                <button id="sidebarToggle"
                    class="bg-none border-none text-slate-500 text-[1.4rem] px-2 py-1 rounded-lg hover:bg-[#1a4d3e]/10 hover:text-[#1a4d3e] transition-all duration-200 cursor-pointer flex-shrink-0"
                    aria-label="Toggle Sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- Breadcrumb -->
                <nav class="hidden md:block truncate">
                    <ol class="flex items-center gap-2 text-sm text-slate-400 list-none p-0 m-0">
                        @hasSection('breadcrumb')
                        @yield('breadcrumb')
                        @else
                        <li class="flex items-center gap-2 flex-shrink-0">
                            <a href="{{ route('admin.dashboard') }}" class="text-[#1a4d3e] no-underline font-medium hover:text-[#c9a84c]">
                                <i class="fa-solid fa-house"></i>
                            </a>
                        </li>
                        <li class="flex items-center gap-2 truncate [&:not(:last-child)::after]:content-['/'] [&:not(:last-child)::after]:text-slate-400">
                            <span class="text-slate-800 font-semibold truncate" aria-current="page">
                                {{ $pageTitle ?? 'Dashboard' }}
                            </span>
                        </li>
                        @endif
                    </ol>
                </nav>
            </div>

            <!-- Right Section -->
            <div class="flex items-center gap-2 sm:gap-4 flex-shrink-0">
                <!-- Real-time Clock -->
                <div class="hidden sm:flex items-center gap-2 text-[0.7rem] sm:text-[0.8rem] font-semibold text-slate-500 bg-slate-100 px-3 sm:px-4 py-1.5 rounded-lg">
                    <i class="fa-regular fa-clock text-[#c9a84c]"></i>
                    <span id="realTimeClock">{{ now()->format('d/m/Y H:i:s') }}</span>
                </div>

                <!-- Profile Dropdown -->
                <div class="relative">
                    <button id="profileDropdownBtn"
                        class="flex items-center gap-2 bg-none border-none px-2 sm:px-3 py-1.5 rounded-full cursor-pointer transition-all duration-200 hover:bg-[#1a4d3e]/10"
                        aria-expanded="false">
                        <div class="w-[34px] h-[34px] rounded-full bg-gradient-to-br from-[#1a4d3e] to-[#2c6e49] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                            {{ auth()->check() ? strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) : 'A' }}
                        </div>
                        <div class="hidden sm:block text-left min-w-0">
                            <div class="font-semibold text-sm text-slate-800 truncate max-w-[100px]">
                                {{ auth()->check() ? auth()->user()->name : 'Admin' }}
                            </div>
                            <div class="text-[0.7rem] text-slate-400 font-medium">
                                {{ auth()->check() ? ucfirst(auth()->user()->role ?? 'Staff') : 'Staff' }}
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-400 text-[0.7rem] hidden sm:block"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="profileDropdownMenu"
                        class="absolute right-0 top-full mt-2 bg-white border-none rounded-xl shadow-[0_10px_40px_rgba(0,0,0,0.12)] p-2 min-w-[180px] sm:min-w-[200px] hidden z-[1050]">
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-2.5 w-full px-4 py-2.5 rounded-lg font-medium text-sm text-slate-800 hover:bg-[#1a4d3e]/10 hover:text-[#1a4d3e] transition-all duration-200">
                            <i class="fa-solid fa-gauge-high w-5 text-center"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.reservation.table') }}"
                            class="flex items-center gap-2.5 w-full px-4 py-2.5 rounded-lg font-medium text-sm text-slate-800 hover:bg-[#1a4d3e]/10 hover:text-[#1a4d3e] transition-all duration-200">
                            <i class="fa-regular fa-calendar-check w-5 text-center"></i> Reservasi
                        </a>
                        <a href="{{ route('admin.menu.index') }}"
                            class="flex items-center gap-2.5 w-full px-4 py-2.5 rounded-lg font-medium text-sm text-slate-800 hover:bg-[#1a4d3e]/10 hover:text-[#1a4d3e] transition-all duration-200">
                            <i class="fa-solid fa-utensils w-5 text-center"></i> Menu
                        </a>
                        <hr class="my-1 border-slate-100">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-2.5 w-full px-4 py-2.5 rounded-lg font-medium text-sm text-red-600 hover:bg-red-50 transition-all duration-200 border-none bg-none cursor-pointer">
                                <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-3 sm:p-4 md:p-6 lg:p-8">

            <!-- Flash Messages -->
            @if(session('success'))
            <div class="flex items-center gap-3 bg-emerald-50 text-emerald-800 border-l-4 border-emerald-500 rounded-xl px-4 sm:px-5 py-3 sm:py-4 mb-6 shadow-sm animate-in" role="alert">
                <div class="w-8 h-8 sm:w-9 sm:h-9 bg-emerald-500 text-white rounded-lg flex items-center justify-center text-base sm:text-lg flex-shrink-0">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <strong class="text-xs sm:text-sm block">Berhasil!</strong>
                    <span class="text-xs sm:text-sm break-words">{{ session('success') }}</span>
                </div>
                <button type="button" class="bg-none border-none text-inherit opacity-50 hover:opacity-100 cursor-pointer text-base px-1 flex-shrink-0" data-dismiss="alert" aria-label="Close">✕</button>
            </div>
            @endif

            @if(session('error'))
            <div class="flex items-center gap-3 bg-red-50 text-red-800 border-l-4 border-red-500 rounded-xl px-4 sm:px-5 py-3 sm:py-4 mb-6 shadow-sm animate-in" role="alert">
                <div class="w-8 h-8 sm:w-9 sm:h-9 bg-red-500 text-white rounded-lg flex items-center justify-center text-base sm:text-lg flex-shrink-0">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <strong class="text-xs sm:text-sm block">Gagal!</strong>
                    <span class="text-xs sm:text-sm break-words">{{ session('error') }}</span>
                </div>
                <button type="button" class="bg-none border-none text-inherit opacity-50 hover:opacity-100 cursor-pointer text-base px-1 flex-shrink-0" data-dismiss="alert" aria-label="Close">✕</button>
            </div>
            @endif

            @if($errors->any())
            <div class="flex items-start gap-3 bg-red-50 text-red-800 border-l-4 border-red-500 rounded-xl px-4 sm:px-5 py-3 sm:py-4 mb-6 shadow-sm animate-in" role="alert">
                <div class="w-8 h-8 sm:w-9 sm:h-9 bg-red-500 text-white rounded-lg flex items-center justify-center text-base sm:text-lg flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <strong class="text-xs sm:text-sm block">Terjadi Kesalahan!</strong>
                    <ul class="text-xs sm:text-sm list-disc ps-3 mt-1 space-y-0.5 break-words">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="bg-none border-none text-inherit opacity-50 hover:opacity-100 cursor-pointer text-base px-1 flex-shrink-0" data-dismiss="alert" aria-label="Close">✕</button>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- ============================================
    SCRIPTS
    ============================================ -->
    <script>
        (function() {
            'use strict';

            // ============================================
            // SIDEBAR TOGGLE
            // ============================================
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('mainWrapper');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            let isCollapsed = false;

            // Load saved state
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                isCollapsed = true;
                sidebar.classList.add('collapsed');
            }

            function toggleSidebar() {
                const isMobile = window.innerWidth < 1024;

                if (isMobile) {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                } else {
                    isCollapsed = !isCollapsed;
                    sidebar.classList.toggle('collapsed');
                    localStorage.setItem('sidebarCollapsed', isCollapsed);
                }
            }

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                });
            }

            // Close sidebar on resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                }
            });

            // ============================================
            // PROFILE DROPDOWN
            // ============================================
            const profileBtn = document.getElementById('profileDropdownBtn');
            const profileMenu = document.getElementById('profileDropdownMenu');

            if (profileBtn && profileMenu) {
                profileBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    profileMenu.classList.toggle('show');
                    profileMenu.style.display = profileMenu.classList.contains('show') ? 'block' : 'none';
                });

                document.addEventListener('click', function(e) {
                    if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
                        profileMenu.classList.remove('show');
                        profileMenu.style.display = 'none';
                    }
                });
            }

            // ============================================
            // REAL-TIME CLOCK
            // ============================================
            function updateClock() {
                const now = new Date();
                const clockEl = document.getElementById('realTimeClock');
                if (clockEl) {
                    clockEl.textContent = now.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit'
                    });
                }
            }
            setInterval(updateClock, 1000);

            // ============================================
            // AUTO DISMISS ALERTS
            // ============================================
            document.querySelectorAll('[role="alert"]').forEach(function(alert) {
                setTimeout(function() {
                    const closeBtn = alert.querySelector('[data-dismiss="alert"]');
                    if (closeBtn) {
                        closeBtn.click();
                    } else {
                        alert.style.opacity = '0';
                        alert.style.transition = 'opacity 0.5s ease';
                        setTimeout(function() {
                            alert.remove();
                        }, 500);
                    }
                }, 5000);
            });

            // ============================================
            // CLOSE BUTTON FOR ALERTS
            // ============================================
            document.querySelectorAll('[data-dismiss="alert"]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const alert = this.closest('[role="alert"]');
                    if (alert) {
                        alert.style.opacity = '0';
                        alert.style.transition = 'opacity 0.3s ease';
                        setTimeout(function() {
                            alert.remove();
                        }, 300);
                    }
                });
            });

            // ============================================
            // INIT LUCIDE ICONS
            // ============================================
            function initLucide() {
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
                } else {
                    setTimeout(initLucide, 500);
                }
            }

            // Run on page load
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initLucide);
            } else {
                initLucide();
            }

            // Re-run for Livewire or Turbo
            document.addEventListener('livewire:load', function() {
                setTimeout(initLucide, 100);
            });

            document.addEventListener('turbo:load', function() {
                setTimeout(initLucide, 100);
            });

        })();
    </script>

    @stack('scripts')
</body>

</html>