@extends('layouts.app')
@section('title', 'Kelola Peralatan')
@section('subtitle', 'Data peralatan kantor & ketersediaan')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
    <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <form method="GET" class="flex flex-1 gap-2 max-w-lg">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / kode..."
                   class="flex-1 text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">
            <select name="category_id" onchange="this.form.submit()" class="text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('equipments.create') }}"
           class="inline-flex items-center justify-center gap-1 bg-accent hover:bg-accent-dark text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
            + Tambah Peralatan
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-xs text-slate-400 border-b border-slate-100">
                    <th class="px-6 py-3 font-semibold">Kode</th>
                    <th class="px-6 py-3 font-semibold">Nama Peralatan</th>
                    <th class="px-6 py-3 font-semibold">Kategori</th>
                    <th class="px-6 py-3 font-semibold">Stok Tersedia</th>
                    <th class="px-6 py-3 font-semibold">Kondisi</th>
                    <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($equipments as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-mono text-xs text-slate-500">{{ $item->code }}</td>
                        <td class="px-6 py-4 font-semibold text-navy-950">{{ $item->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $item->category->name }}</td>
                        <td class="px-6 py-4">
                            <span class="font-semibold {{ $item->availableStock() > 0 ? 'text-emerald-600' : 'text-accent-dark' }}">
                                {{ $item->availableStock() }}
                            </span>
                            <span class="text-slate-400">/ {{ $item->stock }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 capitalize">{{ str_replace('_', ' ', $item->condition) }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('equipments.edit', $item) }}" class="text-sky-600 font-semibold hover:underline">Ubah</a>
                            <form action="{{ route('equipments.destroy', $item) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Hapus peralatan ini?');">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-semibold hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-10 text-center text-slate-400">Belum ada data peralatan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4">{{ $equipments->links() }}</div>
</div>
@endsection
