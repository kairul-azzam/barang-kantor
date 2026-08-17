<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk — SIM Peralatan · PT Cakrawala Teknologi Nusantara</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: { 950: '#0A1730', 900: '#0F1F3D', 800: '#16294F', 700: '#203a68' },
                        sky: { 500: '#4F9DDE', 400: '#6FB3E8' },
                        accent: { DEFAULT: '#F5893D', dark: '#DB6F26' },
                    },
                    fontFamily: {
                        display: ['"Plus Jakarta Sans"', 'sans-serif'],
                        sans: ['Inter', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Plus Jakarta Sans', sans-serif; }
        .grid-pattern {
            background-image: radial-gradient(circle, rgba(255,255,255,0.08) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-[#F5F7FA] text-navy-950 antialiased">

<div class="min-h-screen flex">

    {{-- LEFT — Brand panel --}}
    <div class="hidden lg:flex w-1/2 relative bg-gradient-to-br from-navy-950 via-navy-900 to-navy-800 text-white flex-col justify-between p-12 overflow-hidden">
        <div class="absolute inset-0 grid-pattern"></div>

        <div class="relative flex items-center gap-3">
            <div class="h-10 w-10 rounded-lg bg-accent flex items-center justify-center font-display font-bold">CT</div>
            <div class="leading-tight">
                <p class="font-display font-bold text-sm tracking-wide">SIM Peralatan</p>
                <p class="text-xs text-sky-400/80">Cakrawala Teknologi Nusantara</p>
            </div>
        </div>

        <div class="relative max-w-md">
            <p class="text-sky-400 text-xs font-semibold tracking-widest uppercase mb-3">Sistem Internal</p>
            <h1 class="font-display font-extrabold text-4xl leading-tight">
                Kelola peminjaman peralatan kantor, tanpa spreadsheet.
            </h1>
            <p class="text-slate-300 mt-4 text-sm leading-relaxed">
                Satu tempat untuk mencatat peralatan, pegawai peminjam, dan riwayat transaksi —
                mudah ditelusuri kapan saja dibutuhkan.
            </p>
        </div>

        <div class="relative flex items-center gap-6 text-xs text-slate-400">
            <span>© {{ date('Y') }} PT Cakrawala Teknologi Nusantara</span>
        </div>
    </div>

    {{-- RIGHT — Login form --}}
    <div class="flex-1 flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-sm">

            <div class="lg:hidden flex items-center gap-3 mb-10">
                <div class="h-10 w-10 rounded-lg bg-accent flex items-center justify-center font-display font-bold text-white">CT</div>
                <div class="leading-tight">
                    <p class="font-display font-bold text-sm text-navy-950">SIM Peralatan</p>
                    <p class="text-xs text-slate-400">Cakrawala Teknologi Nusantara</p>
                </div>
            </div>

            <h2 class="font-display font-bold text-2xl text-navy-950">Masuk ke akun Anda</h2>
            <p class="text-sm text-slate-400 mt-1.5 mb-8">Khusus untuk Admin sistem internal.</p>

            {{-- Status pesan (mis. setelah reset password) --}}
            @if (session('status'))
                <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 px-4 py-3 text-sm font-medium">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm font-medium">
                    Email atau kata sandi yang Anda masukkan tidak sesuai.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-navy-950 mb-1.5">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                           placeholder="admin@cakrawala.test"
                           class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">
                    @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-sm font-semibold text-navy-950">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-sky-600 hover:text-sky-700">Lupa kata sandi?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           placeholder="••••••••"
                           class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">
                    @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-500">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-accent focus:ring-accent">
                    Ingat saya di perangkat ini
                </label>

                <button type="submit"
                        class="w-full bg-navy-900 hover:bg-navy-800 text-white text-sm font-semibold py-3 rounded-xl transition">
                    Masuk
                </button>
            </form>

            <p class="text-xs text-slate-400 mt-8 text-center">
                Akun demo: <span class="font-mono text-slate-500">admin@cakrawala.test</span> / <span class="font-mono text-slate-500">password</span>
            </p>
        </div>
    </div>
</div>
</body>
</html>
