<?php

namespace App\Http\Controllers;

use App\Models\rayon;
use App\Models\user;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Panggil data yang ingin ditampilkan
        $rayon = rayon::all();
        // Tampilkan HTML di file index.blade.php di folder rayon dan kirim data yang diambil melalui compact dengan nama variabel
        return view('rayon.index', compact('rayon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = user::all(); // Ganti dengan model User yang sesuai
        return view('rayon.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required|min:3',
            'user_id' => 'required|exists:users,id',
        ]);

        rayon::create([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('rayon.index')->with('success', 'Berhasil mengubah data pengguna!');
    }
    public function edit($id)
    {
        $rayon = rayon::find($id);
        $users = user::all(); // Menggunakan Eloquent untuk mencari pengguna berdasarkan ID

        return view('rayon.edit', compact('rayon','users'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'rayon' => 'required|min:3',
            'user_id' => 'required|exists:users,id',

        ]);


        rayon::where('id', $id)->update([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,

        ]);

        return redirect()->route('rayon.index')->with('success', 'Berhasil mengubah data pengguna!');
    }

}
