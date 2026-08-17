<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-navy-950 mb-1.5">NIP</label>
        <input type="text" name="nip" value="{{ old('nip', $employee->nip ?? '') }}"
               class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
        @error('nip') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-navy-950 mb-1.5">Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name', $employee->name ?? '') }}"
               class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
        @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>
</div>
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-navy-950 mb-1.5">Departemen</label>
        <input type="text" name="department" value="{{ old('department', $employee->department ?? '') }}"
               class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">
    </div>
    <div>
        <label class="block text-sm font-semibold text-navy-950 mb-1.5">No. Telepon</label>
        <input type="text" name="phone" value="{{ old('phone', $employee->phone ?? '') }}"
               class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">
    </div>
</div>
