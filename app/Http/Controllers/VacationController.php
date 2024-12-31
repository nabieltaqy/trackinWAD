<?php

namespace App\Http\Controllers;

use App\Models\Vacation;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class VacationController extends Controller
{
    // Menampilkan daftar semua cuti
    public function index()
    {
        $vacations = Vacation::with(['employee', 'editor'])->get(); // Mengambil semua cuti beserta data karyawan dan editor
        return view('vacation.index', compact('vacations')); // Mengembalikan view dengan data cuti
    }
    public function create(){
        $employees = Employee::all();
        return view('vacation.create', compact('employees'));
    }

    // Menyimpan cuti baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'id_employee' => 'required|exists:employees,id'
        ]);

        $user = Auth::user();

        Vacation::create([
            'id_employee' => $request->id_employee,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => $request->status,
            'edit_by' => $user->id
        ]);

        return redirect()->route('vacation.index')->with('success', 'Vacation created successfully.');
    }

    // Menampilkan cuti berdasarkan ID
    public function show($id)
    {
        $vacation = Vacation::with(['employee', 'editor'])->findOrFail($id); // Mencari cuti berdasarkan ID
        return view('vacation.show', compact('vacation')); // Menampilkan data cuti dalam view
    }

    // Menampilkan form untuk mengedit karyawan
    public function edit($id)
    {
        $vacation = Vacation::with('employee')->findOrFail($id); // Mencari karyawan berdasarkan ID
        return view('vacation.update', compact('vacation')); // Mengembalikan tampilan untuk form edit
    }

    // Memperbarui cuti di database
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'start_date' => 'sometimes|required|date',
            'end_date' => 'sometimes|required|date|after_or_equal:start_date',
            'reason' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|string|max:255',
            'id_employee' => 'sometimes|required|exists:employees,id',
            'edit_by' => 'sometimes|required|exists:users,id',
        ]);

        $vacation = Vacation::findOrFail($id); // Mencari cuti berdasarkan ID
        $vacation->update($request->all()); // Memperbarui data cuti
        return redirect()->route('vacation.index')->with('success', 'Vacation updated successfully.'); // Mengembalikan data cuti yang telah diperbarui
    }

    // Menghapus cuti dari database
    public function destroy($id)
    {
        $vacation = Vacation::findOrFail($id); // Mencari cuti berdasarkan ID
        $vacation->delete(); // Menghapus cuti
        return redirect()->route('vacation.index')->with('success', 'Vacation deleted successfully.'); // Mengembalikan respons kosong dengan status 204 No Content
    }

    public function exportToPDF()
{
    $vacations = Vacation::with('employee')->get();

    $pdf = Pdf::loadView('vacations.pdf', compact('vacations'));
    return $pdf->download('vacations.pdf');
}
}
