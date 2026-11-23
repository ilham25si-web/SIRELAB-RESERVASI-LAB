<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'     => 'required|string|max:100',
            'identitas' => 'required|string|max:30|unique:users,identitas',
            'email'    => 'required|email|unique:users,email',
            'no_hp' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nama'     => $data['nama'],
            'identitas' => $data['identitas'],
            'email'    => $data['email'],
            'no_hp' => $data['no_hp'],
            'password' => ($data['password']),
            'role'     => 'pengguna',
        ]);

        Auth::login($user);

        return redirect()->route('laboratorium.index')
            ->with('sukses', 'Akun berhasil dibuat. Selamat datang!');
    }
}
