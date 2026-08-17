@extends('layouts.app')
@section('title', 'Detail Peminjaman')

@section('content')
<div class="max-w-3xl space-y-5">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs text-slate-400">Peminjam</p>
                <h2 class="font-display font-bold text-xl text-navy-950 mt-0.5">{{ $loan->employee->name }}</h2>
                <p class="text-sm text-slate-500">{{ $loan->employee->nip }} · {{ $loan->employee->department ?? '—' }}</p>
            </div>
            @include('partials.status-badge', ['status' => $loan->status])
        </div>

        <div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-slate-100">
            <div>
                <p class="text-xs text-slate-400">Tanggal Pinjam</p>
                <p class="font-semibold text-navy-950 mt-1">{{ $loan->loan_date->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400">Rencana Kembali</p>
                <p class="font-semibold text-navy-950 mt-1">{{ $loan->due_date->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400">Tanggal Kembali</p>
                <p class="font-semibold text-navy-950 mt-1">{{ $loan->return_date?->format('d M Y') ?? '—' }}</p>
            </div>
        </div>

        @if ($loan->notes)
            <div class="mt-4 pt-4 border-t border-slate-100">
                <p class="text-xs text-slate-400 mb-1">Catatan</p>
                <p class="text-sm text-slate-600">{{ $loan->notes }}</p>
            </div>
        @endif
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="font-display font-bold text-navy-950">Peralatan Dipinjam</h3>
        </div>
        <div class="divide-y divide-slate-100">
            @foreach ($loan->loanItems as $item)
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <p class="font-semibold text-navy-950">{{ $item->equipment->name }}</p>
                        <p class="text-xs text-slate-400">{{ $item->equipment->code }} · {{ $item->equipment->category->name }}</p>
                    </div>
                    <span class="text-sm font-semibold text-navy-950">{{ $item->quantity }} unit</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('loans.index') }}" class="text-sm font-semibold text-slate-500 px-5 py-2.5 rounded-xl hover:bg-slate-50">← Kembali ke daftar</a>
        <a href="{{ route('loans.edit', $loan) }}" class="text-sm font-semibold text-sky-600 px-5 py-2.5 rounded-xl hover:bg-sky-50">Ubah Transaksi</a>
    </div>
</div>
@endsection
