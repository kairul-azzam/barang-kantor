<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>('title', 'Dashboard') — SIMPeralatan · PT Cakrawala Teknologi Nusantara</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            950: '#0A1730',
                            900: '#0F1F3D',
                            800: '#16294F',
                            700: '#203a68',
                        },
                        sky: {
                            500: '#4F9DDE',
                            400: '#6FB3E8',
                        },
                        accent: {
                            DEFAULT: '#F5893D',
                            dark: '#DB6F26',
                        },
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
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#F5F7FA] text-navy-950 antialiased">
<div class="min-h-screen flex" x-data="{ sidebarOpen: false }">

    {{-- SIDEBAR --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-navy-950 to-navy-800 text-white transition-transform duration-200 lg:static lg:translate-x-0 flex flex-col">
        <div class="h-20 flex items-center gap-3 px-6 border-b border-white/10">
            <div class="h-9 w-9 rounded-lg bg-accent flex items-center justify-center font-display font-bold text-white">CT</div>
            <div class="leading-tight">
                <p class="font-display font-bold text-sm tracking-wide">SIM Peralatan</p>
                <p class="text-[11px] text-sky-400/80">Cakrawala Teknologi</p>
            </div>
        </div>

        <nav class="flex-1 px-3 py-6 space-y-1 text-sm">
    @php
        $nav = [
            [
                'label' => 'Dashboard',
                'match' => ['dashboard'],
                'href' => route('dashboard'),
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />',
            ],
            [
                'label' => 'Kategori',
                'match' => ['categories.*'],
                'href' => route('categories.index'),
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />',
            ],
            [
                'label' => 'Peralatan',
                'match' => ['equipments.*'],
                'href' => route('equipments.index'),
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0" />',
            ],
            [
                'label' => 'Pegawai',
                'match' => ['employees.*'],
                'href' => route('employees.index'),
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />',
            ],
            [
                'label' => 'Peminjaman',
                'match' => ['loans.index', 'loans.create', 'loans.edit', 'loans.show'],
                'href' => route('loans.index'),
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M8.25 8.25H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />',
            ],
            [
                'label' => 'Riwayat',
                'match' => ['loans.history'],
                'href' => route('loans.history'),
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />',
            ],
        ];
    @endphp

    @foreach ($nav as $item)
        @php $active = request()->routeIs($item['match']); @endphp
        <a href="{{ $item['href'] }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg border-l-2 transition
                  {{ $active ? 'bg-white/10 border-accent text-white' : 'border-transparent text-slate-300 hover:bg-white/5 hover:text-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5 shrink-0">
                {!! $item['icon'] !!}
            </svg>
            <span class="font-medium">{{ $item['label'] }}</span>
        </a>
    @endforeach
</nav>

        <div class="px-3 py-4 border-t border-white/10">
            <div class="flex items-center gap-3 px-3 py-2">
                <div class="h-8 w-8 rounded-full bg-sky-500 flex items-center justify-center text-xs font-bold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="text-xs leading-tight">
                    <p class="font-semibold text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-slate-400">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button class="w-full text-left px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-white/5 hover:text-white transition">
                    ⏻ Keluar
                </button>
            </form>
        </div>
    </aside>

    <div @click="sidebarOpen = false" x-show="sidebarOpen" x-cloak class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col min-w-0">
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-8 sticky top-0 z-20">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="lg:hidden text-navy-900">☰</button>
                <div>
                    <h1 class="font-display font-bold text-lg text-navy-950">@yield('title', 'Dashboard')</h1>
                    <p class="text-xs text-slate-400">@yield('subtitle', 'PT Cakrawala Teknologi Nusantara')</p>
                </div>
            </div>
            <div class="hidden sm:flex items-center gap-2 text-xs text-slate-400">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Sistem Internal Aktif
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-8">
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm font-medium">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@stack('scripts')
</body>
</html>
