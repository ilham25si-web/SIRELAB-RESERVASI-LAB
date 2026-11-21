<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaboratoriumController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\AdminReservasiController;
use App\Http\Controllers\AdminLaboratoriumController;
use App\Http\Controllers\AdminFasilitasController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware(['auth', 'role:admin']);

Route::get('/pengguna', function () {
    return view('pengguna.dashboard');
})->name('pengguna.dashboard')->middleware(['auth', 'role:pengguna']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Laboratorium routes
Route::get('/laboratorium', [LaboratoriumController::class, 'index'])
    ->name('laboratorium.index')
    ->middleware(['auth', 'role:pengguna']);

Route::get('/laboratorium/{laboratorium}', [LaboratoriumController::class, 'show'])->name('laboratorium.show');

Route::get('/laboratorium/{laboratorium}/reservasi', [ReservasiController::class, 'create'])
    ->name('reservasi.create')
    ->middleware(['auth', 'role:pengguna']);

Route::post('/laboratorium/{laboratorium}/reservasi', [ReservasiController::class, 'store'])
    ->name('reservasi.store')
    ->middleware(['auth', 'role:pengguna']);

Route::get('/reservasi', [ReservasiController::class, 'index'])
    ->name('reservasi.index')
    ->middleware(['auth', 'role:pengguna']);
    
Route::patch('/reservasi/{reservasi}/batal', [ReservasiController::class, 'batal'])
    ->name('reservasi.batal')
    ->middleware(['auth', 'role:pengguna']);

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/reservasi', [AdminReservasiController::class, 'index'])->name('reservasi.index');
        Route::patch('/reservasi/{reservasi}/setujui', [AdminReservasiController::class, 'setujui'])->name('reservasi.setujui');
        Route::patch('/reservasi/{reservasi}/tolak', [AdminReservasiController::class, 'tolak'])->name('reservasi.tolak');
        Route::resource('laboratorium', AdminLaboratoriumController::class)->except('show');

        Route::resource('fasilitas', AdminFasilitasController::class)
            ->except('show')
            ->parameters(['fasilitas' => 'fasilitas']);
    });

Route::patch('/reservasi/{reservasi}/setujui', [AdminReservasiController::class, 'setujui'])->name('reservasi.setujui');
Route::patch('/reservasi/{reservasi}/tolak', [AdminReservasiController::class, 'tolak'])->name('reservasi.tolak');

Route::resource('fasilitas', AdminFasilitasController::class)
    ->except('show')
    ->parameters(['fasilitas' => 'fasilitas']);