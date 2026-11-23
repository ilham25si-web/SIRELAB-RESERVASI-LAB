@extends('layouts.app')

@section('judul', 'Daftar')

@section('isi')
    <h1>Daftar Akun</h1>

    <form method="POST" action="{{ route('register.proses') }}">
        @csrf
        <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}">
            @error('nama') <small>{{ $message }}</small> @enderror
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}">
            <label for="identitas">NIM</label>
            <input type="text" id="identitas" name="identitas" value="{{ old('identitas') }}">
            @error('email') <small>{{ $message }}</small> @enderror
        </div>
        <div>
            <label for="no_hp">No. HP</label>
            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                @error('no_hp') <small>{{ $message }}</small> @enderror
        </div>
        <div>
            <label for="password">Kata sandi</label>
            <input type="password" id="password" name="password">
            @error('password') <small>{{ $message }}</small> @enderror
        </div>
        <div>
            <label for="password_confirmation">Ulangi kata sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
        <button type="submit">Daftar</button>
        <a href="{{ route('login') }}">Sudah punya akun? Masuk</a>
    </form>
@endsection
