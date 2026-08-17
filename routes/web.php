<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

// FR-01: hanya user yang login yang boleh mengakses halaman internal
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('equipments', EquipmentController::class)->except(['show']);
    Route::resource('employees', EmployeeController::class)->except(['show']);

    Route::get('/loans/history', [LoanController::class, 'history'])->name('loans.history');
    Route::patch('/loans/{loan}/mark-returned', [LoanController::class, 'markReturned'])->name('loans.mark-returned');
    Route::resource('loans', LoanController::class)->except(['destroy'])->parameters(['loans' => 'loan']);
    Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])->name('loans.destroy');

});


