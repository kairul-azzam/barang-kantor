@php
    $map = [
        'dipinjam' => 'bg-sky-500/10 text-sky-600 ring-sky-500/30',
        'dikembalikan' => 'bg-emerald-500/10 text-emerald-600 ring-emerald-500/30',
        'terlambat' => 'bg-accent/10 text-accent-dark ring-accent/30',
    ];
    $labels = ['dipinjam' => 'Dipinjam', 'dikembalikan' => 'Dikembalikan', 'terlambat' => 'Terlambat'];
    $classes = $map[$status] ?? 'bg-slate-100 text-slate-600 ring-slate-300';
@endphp
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold ring-1 {{ $classes }}">
    {{ $labels[$status] ?? ucfirst($status) }}
</span>
