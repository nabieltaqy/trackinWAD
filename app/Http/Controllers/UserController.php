<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan daftar semua pengguna
    public function index()
    {
        $users = User::all(); // Mengambil semua pengguna dari database
        return response()->json($users); // Mengembalikan data dalam format JSON
    }

    // Menyimpan pengguna baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'no_telp' => 'required|integer',
            'address' => 'required|string|max:255',
        ]);

        // Membuat pengguna baru
        $user = User::create($request->all());
        return response()->json($user, 201); // Mengembalikan pengguna yang baru dibuat dengan status 201 Created
    }

    // Menampilkan pengguna berdasarkan ID
    public function show($id)
    {
        $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
        return response()->json($user); // Mengembalikan data pengguna dalam format JSON
    }

    // Memperbarui pengguna di database
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'role' => 'sometimes|required|string|max:255',
            'no_telp' => 'sometimes|required|integer',
            'address' => 'sometimes|required|string|max:255',
        ]);

        $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
        $user->update($request->all()); // Memperbarui data pengguna
        return response()->json($user); // Mengembalikan data pengguna yang telah diperbarui
    }

    // Menghapus pengguna dari database
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
        $user->delete(); // Menghapus pengguna
        return response()->json(null, 204); // Mengembalikan respons kosong dengan status 204 No Content
    }
}
