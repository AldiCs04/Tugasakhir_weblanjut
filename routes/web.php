<?php

use App\Http\Controllers\blog;
use App\Http\Controllers\barangcontroller;
use Illuminate\Support\Facades\Route;

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
    return view ('welcome');
});
Route::get('/data-barang', [barangcontroller::class, 'data']);
Route::get('/tambah-barang/{id_barang?}', [barangcontroller::class, 'form']);
Route::get('/update-barang/{id_barang?}', [barangcontroller::class, 'form']);
Route::post('/barang/tambah', [barangcontroller::class, 'tambah']);
Route::post('/barang/edit/{id_barang}', [barangcontroller::class, 'edit']);
Route::get('/barang/hapus/{id_barang}', [barangcontroller::class, 'delete']);