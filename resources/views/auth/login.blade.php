@extends('layouts.app')

@section('judul', 'Login')

@section('isi')
    <h1>Login</h1>

    <form method="POST" action="{{ route('login.proses') }}">
        @csrf

        <x-input name="email" label="Email" type="email" />
        <x-input name="password" label="Password" type="password" />

        <button type="submit">Masuk</button>
        <a href="{{ route('register') }}">Belum punya akun? Daftar</a>
    </form>
@endsection