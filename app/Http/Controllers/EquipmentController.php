<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EquipmentController extends Controller
{
    public function index(Request $request): View
    {
        $equipments = Equipment::with('category')
            ->when($request->search, fn ($q) => $q->where('name', 'like', "%{$request->search}%")
                ->orWhere('code', 'like', "%{$request->search}%"))
            ->when($request->category_id, fn ($q) => $q->where('category_id', $request->category_id))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('equipments.index', compact('equipments', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('equipments.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:50|unique:equipments,code',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:1',
            'condition' => 'required|in:baik,perlu_perbaikan,rusak',
            'description' => 'nullable|string|max:1000',
        ]);

        Equipment::create($validated);

        return redirect()->route('equipments.index')->with('success', 'Peralatan berhasil ditambahkan.');
    }

    public function edit(Equipment $equipment): View
    {
        $categories = Category::orderBy('name')->get();

        return view('equipments.edit', compact('equipment', 'categories'));
    }

    public function update(Request $request, Equipment $equipment): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:50|unique:equipments,code,' . $equipment->id,
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:1',
            'condition' => 'required|in:baik,perlu_perbaikan,rusak',
            'description' => 'nullable|string|max:1000',
        ]);

        $equipment->update($validated);

        return redirect()->route('equipments.index')->with('success', 'Peralatan berhasil diperbarui.');
    }

    public function destroy(Equipment $equipment): RedirectResponse
    {
        if ($equipment->loanItems()->exists()) {
            return back()->with('error', 'Peralatan tidak dapat dihapus karena memiliki riwayat peminjaman.');
        }

        $equipment->delete();

        return redirect()->route('equipments.index')->with('success', 'Peralatan berhasil dihapus.');
    }
}
