<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TanahController;
use App\Http\Controllers\SertifikatController;

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
    return redirect()->route('tanahs.index');
});

// Route untuk jenis tanah, desa, nadzir.

Route::get('/tanahs/jenis_tanah', [TanahController::class, 'tampil_jenis_tanah'])->name('jenis.tampil_jenis_tanah');

Route::get('/tanahs/desa_tanah', [TanahController::class, 'tampil_desa_tanah'])->name('desa.tampil_desa_tanah');

Route::get('/tanahs/nadzir_tanah', [TanahController::class, 'tampil_nadzir_tanah'])->name('nadzir.tampil_nadzir_tanah');


// Route untuk tanah.

Route::get('/tanahs', [TanahController::class, 'index'])->name('tanahs.index');

Route::get('/tanahs/create', [TanahController::class, 'create'])->name('tanahs.create');

Route::post('/tanahs', [TanahController::class, 'store'])->name('tanahs.store');

Route::get('/tanahs/{tanah}', [TanahController::class, 'show'])->name('tanahs.show');

Route::get('/tanahs/{tanah}/edit', [TanahController::class, 'edit'])->name('tanahs.edit');

Route::put('/tanahs/{tanah}', [TanahController::class, 'update'])->name('tanahs.update');

Route::delete('/tanahs/{tanah}', [TanahController::class, 'destroy'])->name('tanahs.destroy');


// Route untuk sertifikat.

Route::resource('sertifikats', SertifikatController::class);



