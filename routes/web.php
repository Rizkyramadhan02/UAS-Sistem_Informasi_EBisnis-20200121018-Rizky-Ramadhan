<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\matakuliahController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KontrakMataKuliahController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('index');
// })->middleware(['admin'])->name('dashboard');

// Route::resource('/mahasiswa', MahasiswaController::class)->middleware(['admin']);

// Route::get('/test', function(){
//     return view('tester');
// })->middleware('mahasiswa');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('admin')
                ->name('logout');

require __DIR__.'/auth.php';



    Route::group(['middleware' => 'auth' ], function() {
        Route::get('/dashboard', function () {
            return view('index');
        });
    });

    Route::group(['middleware' => 'role:admin' ], function() {
        Route::resource('/mahasiswa', MahasiswaController::class);
        Route::resource('/dosen', DosenController::class);
        Route::resource('/matakuliah', matakuliahController::class); 
        Route::resource('/semester', semesterController::class); 
        Route::resource('/jadwal', JadwalController::class); 
        Route::resource('/kontrakmatakuliah', KontrakMataKuliahController::class); 
    });

    // Route::group(['middleware' => 'role:admin,dosen' ], function() {
    Route::group(['middleware' => 'role:dosen' ], function() {
        Route::resource('/absen', AbsenController::class);
        // Route::post('/absenmatakuliah/{id}/tambahmhs',  [matakuliahController::class, 'tambahmhs']);

    });

