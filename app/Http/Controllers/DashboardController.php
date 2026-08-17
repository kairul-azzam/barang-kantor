<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Employee;
use App\Models\Equipment;
use App\Models\Loan;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_equipments' => Equipment::count(),
            'total_categories' => Category::count(),
            'total_employees' => Employee::count(),
            'active_loans' => Loan::where('status', 'dipinjam')->count(),
            'overdue_loans' => Loan::where('status', 'dipinjam')->whereDate('due_date', '<', now())->count(),
            'returned_this_month' => Loan::where('status', 'dikembalikan')
                ->whereMonth('return_date', now()->month)
                ->whereYear('return_date', now()->year)
                ->count(),
        ];

        $recentLoans = Loan::with(['employee', 'loanItems.equipment'])
            ->latest()
            ->take(6)
            ->get();

        return view('dashboard', compact('stats', 'recentLoans'));
    }
}
