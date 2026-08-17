@extends('layouts.app')
@section('title', 'Riwayat Peminjaman')
@section('subtitle', 'Seluruh transaksi yang telah selesai dikembalikan')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
    <div class="px-6 py-4 border-b border-slate-100">
        <form method="GET" class="max-w-sm">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pegawai..."
                   class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-xs text-slate-400 border-b border-slate-100">
                    <th class="px-6 py-3 font-semibold">Pegawai</th>
                    <th class="px-6 py-3 font-semibold">Peralatan</th>
                    <th class="px-6 py-3 font-semibold">Tgl Pinjam</th>
                    <th class="px-6 py-3 font-semibold">Tgl Kembali</th>
                    <th class="px-6 py-3 font-semibold text-right">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($loans as $loan)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-semibold text-navy-950">{{ $loan->employee->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $loan->loanItems->pluck('equipment.name')->join(', ') }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $loan->loan_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $loan->return_date?->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('loans.show', $loan) }}" class="text-navy-700 font-semibold hover:underline">Lihat →</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-10 text-center text-slate-400">Belum ada riwayat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4">{{ $loans->links() }}</div>
</div>
@endsection
