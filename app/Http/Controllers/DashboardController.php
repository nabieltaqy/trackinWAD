<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Vacation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total karyawan
        $totalEmployees = Employee::count();

        // Menghitung jumlah cuti berdasarkan status
        $approvedVacations = Vacation::where('status', 'approved')->count();
        $rejectedVacations = Vacation::where('status', 'rejected')->count();
        $pendingVacations = Vacation::where('status', 'pending')->count();

        return view('dashboard.index', compact('totalEmployees', 'approvedVacations', 'rejectedVacations', 'pendingVacations'));
    }
}