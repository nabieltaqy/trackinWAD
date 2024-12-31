<?php

namespace App\Http\Controllers;

use App\View\Components\AppLayout;
use Illuminate\Http\Request;
use App\Models\Division; // Pastikan untuk mengimpor model Employee


class DivisionController extends Controller
{
    // Menampilkan daftar semua divisi
    public function index()
    {
        $divisions = Division::all(); // Mengambil semua data divisi
        return view('division.index', compact('divisions')); // Mengembalikan tampilan dengan data divisi
    }

    // Menampilkan form untuk menambahkan divisi baru
    public function create()
    {
        return view('division.create'); // Mengembalikan tampilan untuk form pembuatan divisi
    }

    // Menyimpan divisi baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        // Membuat divisi baru
        Division::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('division.index')->with('success', 'Division created successfully.'); // Redirect dengan pesan sukses
    }

    // Menampilkan divisi berdasarkan ID
    public function show($id)
    {
        $division = Division::findOrFail($id); // Mencari divisi berdasarkan ID
        return view('division.show', compact('division')); // Mengembalikan tampilan dengan data divisi
    }

    // Menampilkan form untuk mengedit divisi
    public function edit($id)
    {
        $division = Division::findOrFail($id); // Mencari divisi berdasarkan ID
        return view('division.edit', compact('division')); // Mengembalikan tampilan untuk form edit
        return view('division.update', compact('division')); // Mengembalikan tampilan untuk form edit
    }

    // Memperbarui divisi di database
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $division = Division::findOrFail($id); // Mencari divisi berdasarkan ID
        $division->update($request->all()); // Memperbarui data divisi
        $division->update([
            'name' => $request->name,
            'description' => $request->description,
        ]); // Memperbarui data shift

        return redirect()->route('division.index')->with('success', 'Division updated successfully.'); // Redirect dengan pesan sukses
    }

    // Menghapus divisi dari database
    public function destroy($id)
    {
        $division = Division::findOrFail($id); // Mencari divisi berdasarkan ID
        $division->delete(); // Menghapus divisi

        return redirect()->route('division.index')->with('success', 'Division deleted successfully.'); // Redirect dengan pesan sukses
    }
}

