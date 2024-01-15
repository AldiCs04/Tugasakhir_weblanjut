<?php

use App\Http\Controllers\barangcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/about', function () {
//     return view('about', ['nama' => 'Aldi Choirus Subhan', 'nim' => '220403010065']);
// });
// Route::get('/blog', [blog::class, 'index']);
Route::get('/', function () {
    return view ('welcomegoogle');
});



Route::get('/auth/redirect', [LoginController::class, 'redirectGoogle'])->name('google.redirect');
Route::get('/google/redirect', [LoginController::class, 'callbackGoogle'])->name('google.callback');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $user = auth()->user(); // Dapatkan pengguna yang terotentikasi 
        return view('welcome', [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'avatar' => $user->avatar,
        ]);
    })->name('home');
    Route::get('/data-barang', [barangcontroller::class, 'data'])->name('data-barang');
    Route::get('/tambah-barang/{id_barang?}', [barangcontroller::class, 'form'])->name('tambahbarang');
    Route::get('/update-barang/{id_barang?}', [barangcontroller::class, 'form'])->name('editbarang');
    Route::post('/barang/tambah', [barangcontroller::class, 'tambah']);
    Route::post('/barang/edit/{id_barang}', [barangcontroller::class, 'edit']);
    Route::get('/barang/hapus/{id_barang}', [barangcontroller::class, 'delete']);
    
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


});