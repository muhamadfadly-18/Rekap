    <?php

    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\UserController;
    use App\Http\Controllers\LatesController;
    use App\Http\Controllers\RombelController;
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\RayonController;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

    Route::get('/', function (){
        return view('login');
    })->name('login');
    // ->middleware('guest')
    
    Route::post('/login-auth', [UserController::class , 'loginAuth'])->name('login.auth');
    
    Route::middleware('IsLogin')->group(function (){
        

    Route::get('/index', [UserController::class , 'home'])->name('index');
     
    // Route::get('/index', function () {
    //     return view('index');
    // });
  

    Route::get('/logout', [UserController::class , 'logout'])->name('logout');
    Route::middleware("IsAdmin")->group(function(){

    Route::prefix('user/')->name('user.')->group(function(){
        Route::get('/index', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('{id}/edit', [UserController::class,'edit'])->name('edit');
        Route::patch('update/{id}', [UserController::class,'update'])->name('update');
        // Route::get('home' , [UserController::class , 'home'])->name('home');
        
    });

    Route::prefix('/lates')->name('admin.lates.')->group(function () {
        Route::get('/', [LatesController::class, 'index'])->name('index');
        Route::get('search', [LatesController::class, 'search'])->name('search');
        Route::get('create', [LatesController::class, 'create'])->name('create');
        Route::post('store', [LatesController::class, 'store'])->name('store');
        Route::get('{id}/edit', [LatesController::class, 'edit'])->name('edit');
        Route::patch('update/{id}', [LatesController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [LatesController::class, 'destroy'])->name('delete');
        Route::get('/home', [LatesController::class, 'home'])->name('home');
        Route::get('export-excel', [LatesController::class, 'exportExcel'])->name('export-excel');
        Route::get('download/{id}', [LatesController::class, 'downloadPDF'])->name('download');

    });
    Route::prefix('rombel/')->name('rombel.')->group(function(){
        Route::get('/', [RombelController::class, 'index'])->name('index');
        Route::get('/search', [RombelController::class, 'search'])->name('search');
        Route::get('create', [RombelController::class, 'create'])->name('create');
        Route::post('store', [RombelController::class, 'store'])->name('store');
        Route::get('{id}/edit', [RombelController::class,'edit'])->name('edit');
        Route::patch('update/{id}', [RombelController::class,'update'])->name('update');
        Route::delete('delete/{id}',[RombelController::class,'destroy'])->name('delete');
        

    });
    
    Route::prefix('/student')->name('admin.student.')->group(function(){
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('create', [StudentController::class, 'create'])->name('create');
        Route::post('store', [StudentController::class, 'store'])->name('store');
    
    });
    Route::prefix('rayon/')->name('rayon.')->group(function(){
        Route::get('/', [RayonController::class, 'index'])->name('index');
        Route::get('create', [RayonController::class, 'create'])->name('create');
        Route::post('store', [RayonController::class, 'store'])->name('store');
        Route::get('{id}/edit', [RayonController::class,'edit'])->name('edit');
        Route::patch('update/{id}', [RayonController::class,'update'])->name('update');
    });
    });
   
    Route::middleware(['IsGuru'])->group(function () {
        Route::prefix('/student')->name('ps.student.')->group(function(){
            Route::get('/data/{id}', [StudentController::class, 'data'])->name('data');
        });
        Route::prefix('lates/')->name('ps.lates.')->group(function () {
            Route::get('/rekap', [LatesController::class, 'rekap'])->name('rekap');
            Route::get('search1', [LatesController::class, 'search1'])->name('search1');
            Route::get('create1', [LatesController::class, 'create1'])->name('create1');
            Route::post('store1', [LatesController::class, 'store1'])->name('store1');
            Route::get('/home1', [LatesController::class, 'home1'])->name('home1');
            Route::get('export-excel1', [LatesController::class, 'exportExcel1'])->name('export-excel1');
            Route::get('download1/{id}', [LatesController::class, 'downloadPDF1'])->name('download1');
        });
    });   
    

    });