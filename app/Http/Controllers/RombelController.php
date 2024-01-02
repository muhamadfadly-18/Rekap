<?php

namespace App\Http\Controllers;

use App\Models\rombel;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //panggil data yang mau di tampilkan 
        $rombel = rombel::all();

        //html yang di munculkan di index.balde.php folder rombel, lalu kirim data yang di ambil malalui (isi compact dengan nama variabel)
        return view('rombel.index', compact('rombel'));
    }

    public function create()
    {
        return view('rombel.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'rombel' => 'required|min:3',
        ]);



        rombel::create([
            'rombel' => $request->rombel,
          
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rombel = rombel::find($id); // Menggunakan Eloquent untuk mencari pengguna berdasarkan ID

        return view('rombel.edit', compact('rombel'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'rombel' => 'required|min:3',

        ]);


        rombel::where('id', $id)->update([
            'rombel' => $request->rombel,

        ]);

        return redirect()->route('rombel.index')->with('success', 'Berhasil mengubah data pengguna!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        rombel::where('id',$id)->delete();
        return redirect()->back()->with('deleted', 'Berasil menghapus data!');
        
    }

    
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $rombel = rombel::where('rombel', 'like', '%' . $searchTerm . '%')->paginate(5);

        return view('rombel.index', compact('rombel'));
    }

 
    
    
}
