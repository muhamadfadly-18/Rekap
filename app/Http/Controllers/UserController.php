<?php

// UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Http\str;
use Illuminate\Support\Facades\Auth;
use App\Models\rombel;
use App\Models\rayon;
use App\Models\student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function logout(){
        //menghapus sesion atau login (auth)
        Auth::logout();
        //setelah di hapus di arahkan ke login
        return redirect()->route('login');
    }
    public function loginAuth(Request $request)
    {
        //validasi
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            ]);
            //ambil value dari input dan simpan sebuah variable
            $user = $request->only(['email','password']);
    
    
            //
            if (Auth::attempt($user)) {
                return redirect('index');
            }else{
                return redirect()->back()->with('failed', 'Email dan Password tidak sesuai. silahkan coba lagi');
            }
    }

    public function index()
    {
        //panggil data yang mau di tampilkan 
        $user = user::all();

        //html yang di munculkan di index.balde.php folder user, lalu kirim data yang di ambil malalui (isi compact dengan nama variabel)
        return view('user.index', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }


    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'role' => 'required',
    ]);
        $defaultPassword = substr($request->email, 0, 3) . substr($request->name, 0, 3);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($defaultPassword),
        ]);
    
        return redirect()->route('user.index')->with('success', 'Berhasil mengubah data pengguna!');
    }
    public function edit($id)
    {
        $user = User::find($id); 

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id, 
            'role' => 'required',
        ]);
    
        $defaultPassword = substr($request->email, 0, 3) . substr($request->name, 0, 3);
    
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($defaultPassword),
        ]);
    
        return redirect()->route('user.index')->with('success', 'Berhasil mengubah data pengguna!');
    }
    
    
    public function home()
{
    $rombels = rombel::count();
    $rayons = rayon::count();
    $student = student::count();
    $ps = user::where('role', 'guru')->count();
    $admin = user::where('role', 'admin')->count();
    
    // Count late entries for today
    $todayLateCount = DB::table('lates')
        ->whereDate('date_time', Carbon::today())
        ->count();

    // Assuming the currently logged-in user has a 'rayon_id' attribute
    $rayonIds = rayon::where('user_id', Auth::user()->id)->pluck('id');
    $lates1 = student::whereIn('rayon_id', $rayonIds)->count();
    
    return view('index', compact('rombels', 'rayons', 'student', 'ps', 'admin', 'todayLateCount', 'lates1'));
}


}
