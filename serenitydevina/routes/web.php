<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/halo', function () {
    return "Hallo semua";
});

/*Route::get('/mahasiswa/{nama}', function ($nama) {
   echo "<h2>Hallo semua</h2>";
   echo "Nama Saya $nama";
});*/
Route::get('/fakultas/index', function () {
   $data = ['fakultas' =>['fakultas Ilmu Komputer dan Rekayasa','fakultas ekonomi dan bisnis']];
    return view('fakultas.index',$data);
 });

 //Route::resource('dosen',DosenController::class);

 //raw query mahasiswa
 Route::get('/mahasiswa/insert',[MahasiswaController::class,'insert']);
 Route::get('/mahasiswa/update',[MahasiswaController::class,'update2']);
 Route::get('/mahasiswa/delete',[MahasiswaController::class,'delete']);
 Route::get('/mahasiswa/select',[MahasiswaController::class,'select']);

 Route::get('/mahasiswa/index',[MahasiswaController::class,'index']);

 //QueryBuilder
Route::get('/mahasiswa/insertQB',[MahasiswaController::class,'insertQB']);
 Route::get('/mahasiswa/updateQB',[MahasiswaController::class,'updateQB']);
 Route::get('/mahasiswa/deleteQB',[MahasiswaController::class,'deleteQB']);
 Route::get('/mahasiswa/selectQB',[MahasiswaController::class,'selectQB']);

 //Eloquent ORM
 Route::get('/mahasiswa/insertElq',[MahasiswaController::class,'insertElq']);
 Route::get('/mahasiswa/updateElq',[MahasiswaController::class,'updateElq']);
 Route::get('/mahasiswa/deleteElq',[MahasiswaController::class,'deleteElq']);
 Route::get('/mahasiswa/selectElq',[MahasiswaController::class,'selectElq']);

 Route::get('/prodi/all-join-facade',[ProdiController::class,'allJoinFacade']);
 Route::get('/prodi/all-join-elq',[ProdiController::class,'allJoinElq']);
Route::get('/mahasiswa/all-join-elq',[MahasiswaController::class,'allJoinElq']);

 Route::get('/mahasiswa/massInsert',[MahasiswaController::class,'store']);

 Route::get('/prodi/create',[ProdiController::class,'create']) ->name('prodi.create');
 Route::post('/prodi/store',[ProdiController::class,'store']) ->name('prodi.store');

 Route::get('/prodi/index',[ProdiController::class,'index'])->name('prodi.index');
 Route::get('/prodi/{id}',[ProdiController::class,'show'])->name('prodi.show');

 Route::get('/prodi/{prodi}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
 Route::patch('/prodi/{prodi}', [ProdiController::class,'update'])->name('prodi.update');
 Route::delete('/prodi/{prodi}', [ProdiController::class, 'destroy'])->name('prodi.destroy');

 Route::get('login',[AuthController::class,'index'])->name('login');
 Route::post('proses_login',[AuthController::class,'proses_login'])->name('proses_login');
 Route::get('logout',[AuthController::class,'logout'])->name('logout');
 Route::get('register',[AuthController::class,'register']);
 Route::post('proses_register',[AuthController::class,'proses_register'])->name('proses_register');


 Route::group(['middleware'=> 'auth'], function () {
    Route::group(['middleware'=> 'cek_login:admin'], function () {
        Route::resource('admin',AdminController::class);
});
Route::group(['middleware'=> 'cek_login:user'], function () {
    Route::resource('user',UserController::class);
});
});
