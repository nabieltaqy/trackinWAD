<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; // Pastikan untuk mengimpor model Employee

class EmployeeController extends Controller
{
    // Menampilkan daftar semua karyawan
    public function index()
    {
        $employees = Employee::all(); // Mengambil semua data karyawan
        return view('employee.index', compact('employees')); // Mengembalikan tampilan dengan data karyawan
    }

    // Menampilkan form untuk menambahkan karyawan baru
    public function create()
    {
        return view('employee.create'); // Mengembalikan tampilan untuk form pembuatan karyawan
    }

    // Menyimpan karyawan baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Membuat karyawan baru
        Employee::create($request->all());
        return redirect()->route('employee.index')->with('success', 'Employee created successfully.'); // Redirect dengan pesan sukses
    }

    // Menampilkan karyawan berdasarkan ID
    public function show($id)
    {
        $employee = Employee::findOrFail($id); // Mencari karyawan berdasarkan ID
        return view('employee.show', compact('employee')); // Mengembalikan tampilan dengan data karyawan
    }

    // Menampilkan form untuk mengedit karyawan
    public function edit($id)
    {
        $employee = Employee::findOrFail($id); // Mencari karyawan berdasarkan ID
        return view('employee.edit', compact('employee')); // Mengembalikan tampilan untuk form edit
    }

    // Memperbarui karyawan di database
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'no_telp' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
        ]);

        $employee = Employee::findOrFail($id); // Mencari karyawan berdasarkan ID
        $employee->update($request->all()); // Memperbarui data karyawan

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.'); // Redirect dengan pesan sukses
    }

    // Menghapus karyawan dari database
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id); // Mencari karyawan berdasarkan ID
        $employee->delete(); // Menghapus karyawan

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.'); // Redirect dengan pesan sukses
    }

    public function dashboard()
    {
        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', 'active')->count();
        $inactiveEmployees = Employee::where('status', 'inactive')->count();

        return view('dashboard.index', compact('totalEmployees', 'activeEmployees', 'inactiveEmployees'));
    }
}
