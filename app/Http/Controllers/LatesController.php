<?php

namespace App\Http\Controllers;

use App\Models\lates;
use Illuminate\Http\Request;
use App\Models\student;
use App\Models\rayon;
use Illuminate\Support\Facades\Auth;
use Excel;
use PDF;
use App\Exports\LatesExport;
use App\Exports\LatesExport1;

class LatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $lates = lates::with('student')->get();
    $groupedLates = $lates->groupBy('student.nis'); // Kelompokkan data berdasarkan NIS siswa

    return view('lates.admin.index', compact('lates','groupedLates'));
    }
    
    

    public function home()
    {
    $lates = lates::with('student')->get();
    $groupedLates = $lates->groupBy('student.nis'); 

    return view('lates.admin.home', compact('lates','groupedLates'));
    }
    public function create()
    {
       $student = student::all();
       return view ('lates.admin.create',compact('student'));
    }

    public function store(Request $request)
{
    $request->validate([
        'student_id'=>'required',
        'date_time' => 'required',
        'information' => 'required',
        'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imageName = time().'.'.$request->bukti->extension();  
    $request->bukti->move(public_path('uploads'), $imageName);

    lates::create([
        'student_id' => $request->student_id,
        'date_time' => $request->date_time,
        'information' => $request->information,
        'bukti' => $imageName,
    ]);

    return redirect()->back()->with('success', 'Berhasil menambahkan data!');
}

public function edit($id)
{
    $lates = lates::find($id); 
    $student = student::all();

    return view('lates.admin.edit', compact('lates','student'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'student_id' => 'required',
        'date_time' => 'required',
        'information' => 'required',
        'bukti' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $lates = lates::find($id);

    $lates->date_time = $request->date_time;
    $lates->information = $request->information;

    // Periksa apakah ada file yang diunggah
    if ($request->hasFile('bukti')) {
        // Hapus gambar lama
        if ($lates->bukti) {
            $oldImagePath = public_path('uploads/' . $lates->bukti);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Simpan gambar baru
        $imageName = time() . '.' . $request->bukti->extension();
        $request->bukti->move(public_path('uploads'), $imageName);
        $lates->bukti = $imageName;
    }

    $lates->save();

    return redirect()->route('lates.admin.index')->with('success', 'Berhasil menambah data pengguna!');
}


public function destroy($id)
{
    lates::where('id',$id)->delete();
    return redirect()->back()->with('deleted', 'Berasil menghapus data!');
    
}

public function search(Request $request)
{
    $searchTerm = $request->input('search');
    $lates = lates::where('date_time', 'like', '%' . $searchTerm . '%')->paginate(5);

    return view('lates.admin.index', compact('lates'));
}

public function exportExcel()
{
    //pas download nama file nya mau apa
    //bisa mengunakan csv
    $file_name = 'data'.'.xlsx';
    //panggil pakege excel lakukan preoses download , logic export nya ada fi OrdersExport
    return Excel::download(new LatesExport, $file_name);
    
}
public function downloadPDF($id)
{
    $lates = Lates::with('student.lates')->find($id);

    // Assuming there is a relationship between Lates and Student
    $student = $lates->student;

    // Calculate the number of occurrences of lateness for the specific student
    $jumlahKeterlambatan = $student->lates->count();

    $pdf = PDF::loadView('lates.admin.download-pdf', compact('lates', 'student', 'jumlahKeterlambatan'));

    return $pdf->download('receipt.pdf');
}

public function rekap()
    {
        $rayonIds = rayon::where('user_id', Auth::user()->id)->pluck('id');
        $siswa = student::whereIn('rayon_id', $rayonIds)->get();
        $lates = Lates::whereIn('student_id', $siswa->pluck('id'))->with('student')->get();
        
        // Kelompokkan data keterlambatan berdasarkan NIS siswa
        $groupedLates = $lates->groupBy('student.nis');
    
        return view('lates.ps.rekap', compact('lates', 'groupedLates', 'siswa'));
    }
    public function home1()
    {
        $rayonIds = rayon::where('user_id', Auth::user()->id)->pluck('id');
        $siswa = student::whereIn('rayon_id', $rayonIds)->get();
        $lates = Lates::whereIn('student_id', $siswa->pluck('id'))->with('student')->get();
        
        // Kelompokkan data keterlambatan berdasarkan NIS siswa
        $groupedLates = $lates->groupBy('student.nis');
    
        return view('lates.ps.home', compact('lates', 'groupedLates', 'siswa'));
    }
    public function create1()
    {
       $student = student::all();
       return view ('lates.ps.create',compact('student'));
    }

    public function store1(Request $request)
{
    $request->validate([
        'student_id'=>'required',
        'date_time' => 'required',
        'information' => 'required',
        'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imageName = time().'.'.$request->bukti->extension();  
    $request->bukti->move(public_path('uploads'), $imageName);

    lates::create([
        'student_id' => $request->student_id,
        'date_time' => $request->date_time,
        'information' => $request->information,
        'bukti' => $imageName,
    ]);

    return redirect()->back()->with('success', 'Berhasil menambahkan data!');
}
public function search1(Request $request)
{
    $searchTerm = $request->input('search');
    $rayonIds = rayon::where('user_id', Auth::user()->id)->pluck('id');

    // Fetch only students in the specified rayon
    $siswa = student::whereIn('rayon_id', $rayonIds)->get();

    // Fetch late entries related to those students based on the search term
    $lates = Lates::whereIn('student_id', $siswa->pluck('id'))
                  ->where('date_time', 'like', '%' . $searchTerm . '%')
                  ->paginate(5);

    // Group the late entries by student NIS
    $groupedLates = $lates->groupBy('student.nis');

    return view('lates.ps.rekap', compact('lates', 'groupedLates'));
}

public function exportExcel1()
{
    $rayonId = Auth::user()->rayon_id;
    $file_name = 'data'.'.xlsx';

    return Excel::download(new LatesExport1($rayonId), $file_name);
}
public function downloadPDF1($id)
{
    $lates = Lates::with('student.lates')->find($id);

    // Assuming there is a relationship between Lates and Student
    $student = $lates->student;

    // Calculate the number of occurrences of lateness for the specific student
    $jumlahKeterlambatan = $student->lates->count();

    $pdf = PDF::loadView('lates.ps.download-pdf', compact('lates', 'student', 'jumlahKeterlambatan'));

    return $pdf->download('receipt.pdf');
}


}
