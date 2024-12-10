<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfografisController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PotensiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UmkmController;
use App\Models\ContactInformation;
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
//     return redirect('/editor');
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('/profil-padukuhan', [ProfilController::class, 'index']);

Route::get('/potensi-padukuhan', [PotensiController::class, 'index']);

Route::get('/potensi-padukuhan/{slug}', [PotensiController::class, 'detail']);

Route::get('/infografis', [InfografisController::class, 'index']);

Route::get('/kegiatan', [KegiatanController::class, 'index']);

Route::get('/kegiatan/{slug}', [KegiatanController::class, 'detail']);

Route::get('/berita', [BeritaController::class, 'index']);

Route::get('/berita/{slug}', [BeritaController::class, 'detail']);

Route::get('/umkm', [UmkmController::class, 'index']);

Route::get('/umkm/{slug}', [UmkmController::class, 'detail']);


