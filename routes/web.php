<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaboratoriumController;
use App\Http\Controllers\ReservasiController;


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