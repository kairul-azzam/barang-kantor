@extends('layouts.app')
@section('title', 'Kelola Kategori')
@section('subtitle', 'Kategori peralatan kantor')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm">
    <div class="px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <form method="GET" class="flex-1 max-w-sm">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                   class="w-full text-sm rounded-xl border-slate-200 focus:border-sky-500 focus:ring-sky-500">
        </form>
        <a href="{{ route('categories.create') }}"
           class="inline-flex items-center justify-center gap-1 bg-accent hover:bg-accent-dark text-white text-sm font-semibold px-4 py-2 rounded-xl transition">
            + Tambah Kategori
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-xs text-slate-400 border-b border-slate-100">
                    <th class="px-6 py-3 font-semibold">Nama Kategori</th>
                    <th class="px-6 py-3 font-semibold">Deskripsi</th>
                    <th class="px-6 py-3 font-semibold">Jumlah Peralatan</th>
                    <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($categories as $category)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-semibold text-navy-950">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $category->description ?: '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-sky-500/10 text-sky-600">
                                {{ $category->equipments_count }} unit
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('categories.edit', $category) }}" class="text-sky-600 font-semibold hover:underline">Ubah</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Hapus kategori ini?');">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-semibold hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-6 py-10 text-center text-slate-400">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4">{{ $categories->links() }}</div>
</div>
@endsection
