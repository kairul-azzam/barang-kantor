@extends('layouts.app')
@section('title', 'Kelola Peminjaman')
@section('subtitle', 'Transaksi peminjaman peralatan yang sedang berjalan')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
    <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <form method="GET" class="flex flex-1 gap-2 max-w-lg">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pegawai..."
                   class="flex-1 text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">
            <select name="status" onchange="this.form.submit()" class="text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">
                <option value="">Semua Status</option>
                <option value="dipinjam" @selected(request('status') == 'dipinjam')>Dipinjam</option>
                <option value="dikembalikan" @selected(request('status') == 'dikembalikan')>Dikembalikan</option>
                <option value="terlambat" @selected(request('status') == 'terlambat')>Terlambat</option>
            </select>
        </form>
        <a href="{{ route('loans.create') }}"
           class="inline-flex items-center justify-center gap-1 bg-accent hover:bg-accent-dark text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
            + Catat Peminjaman
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-xs text-slate-400 border-b border-slate-100">
                    <th class="px-6 py-3 font-semibold">Pegawai</th>
                    <th class="px-6 py-3 font-semibold">Peralatan</th>
                    <th class="px-6 py-3 font-semibold">Tgl Pinjam</th>
                    <th class="px-6 py-3 font-semibold">Jatuh Tempo</th>
                    <th class="px-6 py-3 font-semibold">Status</th>
                    <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($loans as $loan)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-semibold text-navy-950">{{ $loan->employee->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $loan->loanItems->pluck('equipment.name')->join(', ') }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $loan->loan_date->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $loan->due_date->format('d M Y') }}</td>
                        <td class="px-6 py-4">@include('partials.status-badge', ['status' => $loan->status])</td>
                        <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                            <a href="{{ route('loans.show', $loan) }}" class="text-navy-700 font-semibold hover:underline">Detail</a>
                            @if ($loan->status === 'dipinjam')
                                <form action="{{ route('loans.mark-returned', $loan) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button class="text-emerald-600 font-semibold hover:underline">Kembalikan</button>
                                </form>
                            @endif
                            <a href="{{ route('loans.edit', $loan) }}" class="text-sky-600 font-semibold hover:underline">Ubah</a>
                            <form action="{{ route('loans.destroy', $loan) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Hapus transaksi ini?');">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-semibold hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-10 text-center text-slate-400">Belum ada transaksi peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4">{{ $loans->links() }}</div>
</div>
@endsection
