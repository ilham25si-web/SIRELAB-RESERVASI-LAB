@extends('layouts.app')

@section('judul', 'Daftar')

@section('isi')
    <h1>Daftar Akun</h1>

        <form method="POST" action="{{ route('register.proses') }}">
        @csrf

        <x-input name="nama" label="Nama" />
        <x-input name="email" label="Email" type="email" />
        <x-input name="identitas" label="NIM" />
        <x-input name="no_hp" label="No. HP" />
        <x-input name="password" label="Kata sandi" type="password" />
        <x-input name="password_confirmation" label="Ulangi kata sandi" type="password" />

        <button type="submit">Daftar</button>
        <a href="{{ route('login') }}">Sudah punya akun? Masuk</a>
    </form>
@endsection
