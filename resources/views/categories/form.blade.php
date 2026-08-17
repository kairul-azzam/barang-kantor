<div>
    <label class="block text-sm font-semibold text-navy-950 mb-1.5">Nama Kategori</label>
    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
           class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500" required>
    @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
</div>
<div>
    <label class="block text-sm font-semibold text-navy-950 mb-1.5">Deskripsi (opsional)</label>
    <textarea name="description" rows="3"
              class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">{{ old('description', $category->description ?? '') }}</textarea>
    @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
</div>
