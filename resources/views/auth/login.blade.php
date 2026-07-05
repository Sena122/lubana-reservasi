<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Reservation Lubana Sengkol</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="h-full min-h-screen text-slate-100 antialiased flex items-center justify-center">

    <div class="w-full max-w-7xl mx-auto min-h-[80vh] grid grid-cols-1 lg:grid-cols-12 overflow-hidden shadow-2xl rounded-3xl bg-slate-950/40 backdrop-blur-xl border border-slate-800/60 m-4">

        <div class="lg:col-span-5 flex flex-col justify-between p-8 sm:p-12 md:p-16 bg-slate-900/80">
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-emerald-500/10 border border-emerald-500/20 rounded-xl">
                    <i data-lucide="anchor" class="w-6 h-6 text-emerald-400"></i>
                </div>
                <div>
                    <span class="text-sm font-semibold tracking-wider text-emerald-400 uppercase">Lubana Sengkol</span>
                    <h1 class="text-xs text-slate-400 -mt-0.5">E-Reservation System</h1>
                </div>
            </div>

            <div class="w-full max-w-sm mx-auto my-auto py-12">
                <div class="mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">Selamat Datang</h2>
                    <p class="text-sm text-slate-400 mt-2">Silakan masukkan kredensial akun Anda untuk mengakses dashboard manajemen.</p>
                </div>

                @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-sm text-red-400 flex items-start gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 shrink-0 mt-0.5"></i>
                    <div>
                        <span class="font-semibold">Gagal masuk:</span>
                        <ul class="list-disc list-inside mt-1 space-y-1 text-xs text-red-300">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label for="email" class="text-xs font-medium tracking-wide text-slate-300 uppercase">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-emerald-400 transition-colors">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@lubana.com"
                                class="w-full pl-11 pr-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none focus:border-emerald-500/60 focus:ring-2 focus:ring-emerald-500/10 transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label for="password" class="text-xs font-medium tracking-wide text-slate-300 uppercase">Kata Sandi</label>
                            <a href="#" class="text-xs text-slate-400 hover:text-emerald-400 transition-colors">Lupa Password?</a>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-emerald-400 transition-colors">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </div>
                            <input id="password" type="password" name="password" required placeholder="••••••••"
                                class="w-full pl-11 pr-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-600 focus:outline-none focus:border-emerald-500/60 focus:ring-2 focus:ring-emerald-500/10 transition-all">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="h-4 w-4 rounded border-slate-800 bg-slate-950 text-emerald-500 focus:ring-offset-slate-900 focus:ring-emerald-500/30">
                        <label for="remember_me" class="ml-2 block text-sm text-slate-400 select-none cursor-pointer hover:text-slate-300">
                            Ingat sesi perangkat ini
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-3 px-4 bg-emerald-500 hover:bg-emerald-400 active:bg-emerald-600 text-slate-950 font-semibold text-sm rounded-xl transition-all shadow-lg shadow-emerald-500/20 hover:shadow-emerald-500/30 flex items-center justify-center gap-2 cursor-pointer group">
                        Masuk ke Dashboard
                        <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>
                    </button>
                </form>
            </div>

            <p class="text-xs text-slate-500 text-center lg:text-left">&copy; {{ date('Y') }} PT Lubana Sengkol. All rights reserved.</p>
        </div>

        <div class="lg:col-span-7 hidden lg:relative lg:flex flex-col justify-end p-16 overflow-hidden bg-slate-950">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_20%,rgba(16,185,129,0.15),transparent_50%)]"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent z-10"></div>

            <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-30"></div>

            <div class="relative z-20 max-w-lg space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-xs font-medium text-emerald-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Sistem Terintegrasi v3.0
                </div>
                <h3 class="text-3xl font-extrabold text-white tracking-tight leading-tight">
                    Kelola Reservasi Saung & Kuliner dalam Satu Dasbor Pintar.
                </h3>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Pantau grafik okupansi area resto umum, validasi pembayaran *down payment* pelanggan, hingga sinkronisasi menu pemancingan secara efisien tanpa kendala operasional harian.
                </p>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();
        });
    </script>
</body>

</html>