<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Masukkan route yang perlu login di bawah sini
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/vacation', [VacationController::class, 'index'])->name('vacation.index');
Route::get('/vacation/create', [VacationController::class, 'create'])->name('vacation.create');
Route::post('/vacation/store', [VacationController::class, 'store'])->name('vacation.store');
Route::get('/vacation/{id}/edit', [VacationController::class, 'edit'])->name('vacation.edit');
Route::put('/vacation/{id}/update', [VacationController::class, 'update'])->name('vacation.update');
Route::delete('/vacation/{id}/destroy', [VacationController::class, 'destroy'])->name('vacation.destroy');
Route::get('/vacation/{id}', [VacationController::class, 'show'])->name('vacation.show');

Route::get('/absence', [AbsenceController::class, 'index'])->name('absence.index');
Route::get('/absence/create', [AbsenceController::class, 'create'])->name('absence.create');
Route::post('/absence/store', [AbsenceController::class, 'store'])->name('absence.store');
Route::get('/absence/{id}/edit', [AbsenceController::class, 'edit'])->name('absence.edit');
Route::put('/absence/{id}', [AbsenceController::class, 'update'])->name('absence.update');
Route::delete('/absence/{id}', [AbsenceController::class, 'destroy'])->name('absence.destroy');

Route::get('/division', [DivisionController::class, 'index'])->name('division.index');
Route::get('/division/create', [DivisionController::class, 'create'])->name('division.create');
Route::post('/division/store', [DivisionController::class, 'store'])->name('division.store');
Route::get('/division/{id}', [DivisionController::class, 'show'])->name('division.show');
Route::get('/division/{id}/edit', [DivisionController::class, 'edit'])->name('division.edit');
Route::put('/division/{id}/update', [DivisionController::class, 'update'])->name('division.update');
Route::delete('/division/{id}/destroy', [DivisionController::class, 'destroy'])->name('division.destroy');

Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/{id}/edit)', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/employee/{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee/{id}/destroy', [EmployeeController::class, 'destroy'])->name('employee.destroy');
Route::get('/employee/{id}', [EmployeeController::class, 'show'])->name('employee.show');


Route::get('/shift', [ShiftController::class, 'index'])->name('shift.index');
Route::get('/shift/create', [ShiftController::class, 'create'])->name('shift.create');
Route::post('/shift/store', [ShiftController::class, 'store'])->name('shift.store');
Route::get('/shift/{id}/edit', [ShiftController::class, 'edit'])->name('shift.edit');
Route::put('/shift/{id}/update', [ShiftController::class, 'update'])->name('shift.update');
Route::delete('/shift/{id}/destroy', [ShiftController::class, 'destroy'])->name('shift.destroy');
Route::get('/shift/{id}', [ShiftController::class, 'show'])->name('shift.show');
});

require __DIR__.'/auth.php';
