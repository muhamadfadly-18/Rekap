<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\rombel;
use App\Models\rayon;
use App\Models\lates;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */     
    public function index()
    {+
        $student = student::all();

        //html yang di munculkan di index.balde.php folder student, lalu kirim data yang di ambil malalui (isi compact dengan nama variabel)
        return view('student.admin.index', compact('student'));
    }

    public function data()
    {
    $rayonIds = rayon::where('user_id', Auth::user()->id)->pluck('id');
    $siswa = student::whereIn('rayon_id', $rayonIds)->get();

    return view('student.ps.data', compact('siswa'));

    }
    

    public function create()
    {
        $rayons = rayon::all();
        $rombels = rombel::all();

        return view('student.admin.create', compact('rayons', 'rombels'));
    }

    public function store(Request $request)
    {


        
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel_id' => 'required',
            'rayon_id' => 'required',
        ]);

        student::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'rombel_id' => $request->rombel_id,
            'rayon_id' => $request->rayon_id,
          
        ]);
        


        return redirect()->route('admin.student.index')->with('success', 'Berhasil mebambah data pengguna!');
    }

  
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        //
    }
}
