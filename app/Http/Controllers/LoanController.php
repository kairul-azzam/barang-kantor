<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Equipment;
use App\Models\Loan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LoanController extends Controller
{
    // FR-06: daftar transaksi (aktif) + FR-08: riwayat digabung lewat filter status
    public function index(Request $request): View
    {
        $loans = Loan::with(['employee', 'loanItems.equipment'])
            ->when($request->search, fn ($q) => $q->whereHas('employee', fn ($e) => $e->where('name', 'like', "%{$request->search}%")))
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest('loan_date')
            ->paginate(10)
            ->withQueryString();

        return view('loans.index', compact('loans'));
    }

    // FR-08: Riwayat — semua transaksi yang sudah selesai
    public function history(Request $request): View
    {
        $loans = Loan::with(['employee', 'loanItems.equipment'])
            ->where('status', 'dikembalikan')
            ->when($request->search, fn ($q) => $q->whereHas('employee', fn ($e) => $e->where('name', 'like', "%{$request->search}%")))
            ->latest('return_date')
            ->paginate(10)
            ->withQueryString();

        return view('loans.history', compact('loans'));
    }

    public function create(): View
    {
        $employees = Employee::orderBy('name')->get();
        $equipments = Equipment::with('category')->orderBy('name')->get();

        return view('loans.create', compact('employees', 'equipments'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
            'notes' => 'nullable|string|max:1000',
            'equipment_id' => 'required|array|min:1',
            'equipment_id.*' => 'exists:equipments,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
        ]);

        DB::transaction(function () use ($validated) {
            $loan = Loan::create([
                'employee_id' => $validated['employee_id'],
                'loan_date' => $validated['loan_date'],
                'due_date' => $validated['due_date'],
                'notes' => $validated['notes'] ?? null,
                'status' => 'dipinjam',
            ]);

            foreach ($validated['equipment_id'] as $index => $equipmentId) {
                $loan->loanItems()->create([
                    'equipment_id' => $equipmentId,
                    'quantity' => $validated['quantity'][$index] ?? 1,
                ]);
            }
        });

        return redirect()->route('loans.index')->with('success', 'Transaksi peminjaman berhasil dicatat.');
    }

    // FR-07: Detail Peminjaman
    public function show(Loan $loan): View
    {
        $loan->load(['employee', 'loanItems.equipment.category']);

        return view('loans.show', compact('loan'));
    }

    public function edit(Loan $loan): View
    {
        $employees = Employee::orderBy('name')->get();

        return view('loans.edit', compact('loan', 'employees'));
    }

    public function update(Request $request, Loan $loan): RedirectResponse
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
            'status' => 'required|in:dipinjam,dikembalikan,terlambat',
            'notes' => 'nullable|string|max:1000',
        ]);

        if ($validated['status'] === 'dikembalikan' && ! $loan->return_date) {
            $validated['return_date'] = now();
        }

        $loan->update($validated);

        return redirect()->route('loans.index')->with('success', 'Transaksi peminjaman berhasil diperbarui.');
    }

    // Aksi cepat: tandai dikembalikan langsung dari daftar
    public function markReturned(Loan $loan): RedirectResponse
    {
        $loan->update([
            'status' => 'dikembalikan',
            'return_date' => now(),
        ]);

        return back()->with('success', 'Peralatan ditandai sudah dikembalikan.');
    }

    public function destroy(Loan $loan): RedirectResponse
    {
        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Transaksi peminjaman berhasil dihapus.');
    }
}
