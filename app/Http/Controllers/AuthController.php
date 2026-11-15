<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        
        // 1. validasi isian
        $kredensial = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. cek email + password ke tabel users
        if (Auth::attempt($kredensial)) {

        // 3. jika berhasil, redirect ke dashboard
            request()->session()->regenerate();
        
            if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('pengguna.dashboard');

        }

        // 4. Gagal : kembali ke form dengan pesan
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }
}