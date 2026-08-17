@extends('layouts.app')
@section('title', 'Catat Peminjaman Baru')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm max-w-3xl p-6"
     x-data="loanForm()">
    <form action="{{ route('loans.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-navy-950 mb-1.5">Pegawai Peminjam</label>
                <select name="employee_id" class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
                    <option value="">Pilih pegawai</option>
                    @foreach ($employees as $emp)
                        <option value="{{ $emp->id }}" @selected(old('employee_id') == $emp->id)>{{ $emp->name }} ({{ $emp->nip }})</option>
                    @endforeach
                </select>
                @error('employee_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div></div>
            <div>
                <label class="block text-sm font-semibold text-navy-950 mb-1.5">Tanggal Pinjam</label>
                <input type="date" name="loan_date" value="{{ old('loan_date', now()->format('Y-m-d')) }}"
                       class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
                @error('loan_date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-navy-950 mb-1.5">Rencana Kembali</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}"
                       class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
                @error('due_date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-2">
                <label class="block text-sm font-semibold text-navy-950">Peralatan yang Dipinjam</label>
                <button type="button" @click="addRow()" class="text-xs font-semibold text-sky-600 hover:text-sky-700">+ Tambah Baris</button>
            </div>
            @error('equipment_id') <p class="text-xs text-red-500 mb-2">{{ $message }}</p> @enderror

            <div class="space-y-2">
                <template x-for="(row, index) in rows" :key="index">
                    <div class="flex gap-2 items-start">
                        <select :name="'equipment_id[]'" x-model="row.equipment_id" required
                                class="flex-1 text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">
                            <option value="">Pilih peralatan</option>
                            @foreach ($equipments as $eq)
                                <option value="{{ $eq->id }}">{{ $eq->name }} — {{ $eq->code }} ({{ $eq->availableStock() }} tersedia)</option>
                            @endforeach
                        </select>
                        <input type="number" min="1" :name="'quantity[]'" x-model="row.quantity" value="1"
                               class="w-24 text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
                        <button type="button" @click="removeRow(index)" x-show="rows.length > 1"
                                class="px-3 py-2 text-red-500 hover:bg-red-50 rounded-xl text-sm">✕</button>
                    </div>
                </template>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-navy-950 mb-1.5">Catatan (opsional)</label>
            <textarea name="notes" rows="2" class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">{{ old('notes') }}</textarea>
        </div>

        <div class="flex gap-3 pt-2">
            <button class="bg-accent hover:bg-accent-dark text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">Simpan Transaksi</button>
            <a href="{{ route('loans.index') }}" class="text-sm font-semibold text-slate-500 px-5 py-2.5 rounded-xl hover:bg-slate-50">Batal</a>
        </div>
    </form>
</div>

<script>
    function loanForm() {
        return {
            rows: [{ equipment_id: '', quantity: 1 }],
            addRow() { this.rows.push({ equipment_id: '', quantity: 1 }); },
            removeRow(i) { this.rows.splice(i, 1); },
        }
    }
</script>
@endsection
