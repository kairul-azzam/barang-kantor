@extends('layouts.app')
@section('title', 'Tambah Peralatan')

@section('content')
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm max-w-xl p-6">
    <form action="{{ route('equipments.store') }}" method="POST" class="space-y-5">
        @csrf
        @include('equipments.form')
        <div class="flex gap-3 pt-2">
            <button class="bg-accent hover:bg-accent-dark text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">Simpan</button>
            <a href="{{ route('equipments.index') }}" class="text-sm font-semibold text-slate-500 px-5 py-2.5 rounded-xl hover:bg-slate-50">Batal</a>
        </div>
    </form>
</div>
@endsection
