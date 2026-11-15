<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');

Route::get('/pengguna', function () {
    return view('pengguna.dashboard');
})->name('pengguna.dashboard')->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');