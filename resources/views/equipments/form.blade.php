<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-navy-950 mb-1.5">Kode Inventaris</label>
        <input type="text" name="code" value="{{ old('code', $equipment->code ?? '') }}"
               class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
        @error('code') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-navy-950 mb-1.5">Kategori</label>
        <select name="category_id" class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
            <option value="">Pilih kategori</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $equipment->category_id ?? '') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
        @error('category_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>
</div>
<div>
    <label class="block text-sm font-semibold text-navy-950 mb-1.5">Nama Peralatan</label>
    <input type="text" name="name" value="{{ old('name', $equipment->name ?? '') }}"
           class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
    @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
</div>
<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-navy-950 mb-1.5">Total Stok</label>
        <input type="number" min="1" name="stock" value="{{ old('stock', $equipment->stock ?? 1) }}"
               class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
        @error('stock') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-navy-950 mb-1.5">Kondisi</label>
        <select name="condition" class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
            @foreach (['baik' => 'Baik', 'perlu_perbaikan' => 'Perlu Perbaikan', 'rusak' => 'Rusak'] as $val => $label)
                <option value="{{ $val }}" @selected(old('condition', $equipment->condition ?? 'baik') == $val)>{{ $label }}</option>
            @endforeach
        </select>
        @error('condition') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>
</div>
<div>
    <label class="block text-sm font-semibold text-navy-950 mb-1.5">Deskripsi (opsional)</label>
    <textarea name="description" rows="3"
              class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">{{ old('description', $equipment->description ?? '') }}</textarea>
</div>
