@extends('layouts.app')
@section('title', 'Ubah Peminjaman')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm max-w-xl p-6">
    <form action="{{ route('loans.update', $loan) }}" method="POST" class="space-y-5">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-semibold text-navy-950 mb-1.5">Pegawai Peminjam</label>
            <select name="employee_id" class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
                @foreach ($employees as $emp)
                    <option value="{{ $emp->id }}" @selected($loan->employee_id == $emp->id)>{{ $emp->name }} ({{ $emp->nip }})</option>
                @endforeach
            </select>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-navy-950 mb-1.5">Tanggal Pinjam</label>
                <input type="date" name="loan_date" value="{{ old('loan_date', $loan->loan_date->format('Y-m-d')) }}"
                       class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-navy-950 mb-1.5">Rencana Kembali</label>
                <input type="date" name="due_date" value="{{ old('due_date', $loan->due_date->format('Y-m-d')) }}"
                       class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-navy-950 mb-1.5">Status</label>
            <select name="status" class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
                @foreach (['dipinjam' => 'Dipinjam', 'dikembalikan' => 'Dikembalikan', 'terlambat' => 'Terlambat'] as $val => $label)
                    <option value="{{ $val }}" @selected($loan->status == $val)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-navy-950 mb-1.5">Catatan</label>
            <textarea name="notes" rows="2" class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">{{ old('notes', $loan->notes) }}</textarea>
        </div>
        <div class="flex gap-3 pt-2">
            <button class="bg-accent hover:bg-accent-dark text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">Perbarui</button>
            <a href="{{ route('loans.index') }}" class="text-sm font-semibold text-slate-500 px-5 py-2.5 rounded-xl hover:bg-slate-50">Batal</a>
        </div>
    </form>
</div>
@endsection
