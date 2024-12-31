<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    // Menampilkan daftar semua shift
    public function index()
    {
        $shifts = Shift::all(); // Mengambil semua shift dari database
        return view('shift.index', compact('shifts')); // Mengirim data ke view
    }

    // Menampilkan form untuk membuat shift baru
    public function create()
    {
        return view('shift.create'); // Mengembalikan view untuk membuat shift
    }

    // Menyimpan shift baru ke database
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'shift_start' => 'required|date_format:H:i',
            'shift_end' => 'required|date_format:H:i|after:shift_start',
        ]);

        // Membuat shift baru
        Shift::create([
            'name' => $request->name,
            'shift_start' => $request->shift_start,
            'shift_end' => $request->shift_end,
        ]);

        return redirect()->route('shift.index')->with('success', 'Shift created successfully.'); // Redirect ke index dengan pesan sukses
    }

    // Menampilkan detail shift berdasarkan ID
    public function show($id)
    {
        $shift = Shift::findOrFail($id); // Mencari shift berdasarkan ID
        return view('shift.show', compact('shift')); // Mengirim data ke view
    }

    // Menampilkan form untuk mengedit shift
    public function edit($id)
    {
        $shift = Shift::findOrFail($id); // Mencari shift berdasarkan ID
        return view('shift.update', compact('shift')); // Mengirim data ke view
    }

    // Memperbarui shift di database
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'shift_start' => 'required|date_format:H:i',
            'shift_end' => 'required|date_format:H:i|after:shift_start',
        ]);

        $shift = Shift::findOrFail($id); // Mencari shift berdasarkan ID
        $shift->update([
            'name' => $request->name,
            'shift_start' => $request->shift_start,
            'shift_end' => $request->shift_end,
        ]); // Memperbarui data shift

        return redirect()->route('shift.index')->with('success', 'Shift updated successfully.'); // Redirect ke index dengan pesan sukses
    }

    // Menghapus shift dari database
    public function destroy($id)
    {
        $shift = Shift::findOrFail($id); // Mencari shift berdasarkan ID
        $shift->delete(); // Menghapus shift
        return redirect()->route('shift.index')->with('success', 'Shift deleted successfully.'); // Redirect ke index dengan pesan sukses
    }
}
