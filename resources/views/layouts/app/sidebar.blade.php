<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-navy-800 bg-navy-950 text-slate-300">
            <flux:sidebar.header>
                <div class="flex items-center gap-3 px-2">
                    <div class="h-9 w-9 rounded-lg bg-accent flex items-center justify-center font-display font-bold text-white text-sm">CT</div>
                    <div class="leading-tight">
                        <p class="font-display font-bold text-sm text-white tracking-wide">SIM Peralatan</p>
                        <p class="text-[11px] text-sky-400/80">Cakrawala Teknologi</p>
                    </div>
                </div>
                <flux:sidebar.collapse class="lg:hidden text-slate-300" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group heading="Menu Utama" class="grid">
                    <flux:sidebar.item icon="layout-dashboard" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        Dashboard
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="tag" :href="route('categories.index')" :current="request()->routeIs('categories.*')" wire:navigate>
                        Kategori
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="briefcase" :href="route('equipments.index')" :current="request()->routeIs('equipments.*')" wire:navigate>
                        Peralatan
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="users" :href="route('employees.index')" :current="request()->routeIs('employees.*')" wire:navigate>
                        Pegawai
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="clipboard-list" :href="route('loans.index')" :current="request()->routeIs('loans.index') || request()->routeIs('loans.create') || request()->routeIs('loans.edit') || request()->routeIs('loans.show')" wire:navigate>
                        Peminjaman
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="history" :href="route('loans.history')" :current="request()->routeIs('loans.history')" wire:navigate>
                        Riwayat
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <div class="flex items-center gap-2 px-3 py-2 text-[11px] text-slate-500">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                    Sistem Internal Aktif
                </div>
            </flux:sidebar.nav>

            <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden border-b border-slate-200">
            <flux:sidebar.toggle class="lg:hidden" icon="menu" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            Pengaturan
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="log-out"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            Keluar
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>