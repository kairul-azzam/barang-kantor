@extends('layouts.app')
@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan kondisi sistem peminjaman peralatan')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    @php
        $cards = [
            [
                'label' => 'Total Peralatan',
                'value' => $stats['total_equipments'],
                'accent' => 'text-navy-900 bg-navy-900/5',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0" />',
            ],
            [
                'label' => 'Kategori',
                'value' => $stats['total_categories'],
                'accent' => 'text-sky-600 bg-sky-500/10',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />',
            ],
            [
                'label' => 'Pegawai Terdaftar',
                'value' => $stats['total_employees'],
                'accent' => 'text-emerald-600 bg-emerald-500/10',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />',
            ],
            [
                'label' => 'Sedang Dipinjam',
                'value' => $stats['active_loans'],
                'accent' => 'text-accent-dark bg-accent/10',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M8.25 8.25H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />',
            ],
        ];
    @endphp

    @foreach ($cards as $card)
        <div class="bg-white rounded-2xl border border-slate-200 border-t-4 border-t-accent p-5 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-400">{{ $card['label'] }}</p>
                    <p class="font-display text-3xl font-bold text-navy-950 mt-1">{{ $card['value'] }}</p>
                </div>
                <span class="h-10 w-10 rounded-xl flex items-center justify-center {{ $card['accent'] }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5">
                        {!! $card['icon'] !!}
                    </svg>
                </span>
            </div>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mt-6">
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-display font-bold text-navy-950">Transaksi Terbaru</h2>
            <a href="{{ route('loans.index') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-sky-600 hover:text-sky-700">
                Lihat semua
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-3.5 w-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse ($recentLoans as $loan)
                <a href="{{ route('loans.show', $loan) }}" class="flex items-center justify-between px-6 py-4 hover:bg-slate-50 transition">
                    <div>
                        <p class="font-semibold text-sm text-navy-950">{{ $loan->employee->name }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ $loan->loanItems->pluck('equipment.name')->join(', ') }}
                        </p>
                    </div>
                    <div class="text-right">
                        @include('partials.status-badge', ['status' => $loan->status])
                        <p class="text-[11px] text-slate-400 mt-1">{{ $loan->loan_date->format('d M Y') }}</p>
                    </div>
                </a>
            @empty
                <div class="px-6 py-10 text-center">
                    <p class="text-sm text-slate-400">Belum ada transaksi peminjaman.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <h2 class="font-display font-bold text-navy-950 mb-4">Perhatian</h2>
        <div class="space-y-3">
            <div class="flex items-center gap-3 p-3 rounded-xl bg-accent/5">
                <span class="h-9 w-9 shrink-0 rounded-lg bg-accent/15 text-accent-dark flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </span>
                <div>
                    <p class="font-bold text-navy-950 leading-none">{{ $stats['overdue_loans'] }}</p>
                    <p class="text-xs text-slate-500 mt-1">Peminjaman terlambat dikembalikan</p>
                </div>
            </div>

            <div class="flex items-center gap-3 p-3 rounded-xl bg-emerald-500/5">
                <span class="h-9 w-9 shrink-0 rounded-lg bg-emerald-500/15 text-emerald-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <div>
                    <p class="font-bold text-navy-950 leading-none">{{ $stats['returned_this_month'] }}</p>
                    <p class="text-xs text-slate-500 mt-1">Dikembalikan bulan ini</p>
                </div>
            </div>

            <a href="{{ route('loans.create') }}"
               class="flex items-center justify-center gap-2 mt-2 bg-navy-900 hover:bg-navy-800 text-white text-sm font-semibold py-2.5 rounded-xl transition">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Catat Peminjaman Baru
            </a>
        </div>
    </div>
</div>
@endsection