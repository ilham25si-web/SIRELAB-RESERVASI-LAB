@extends('layouts.app')

@section('judul', 'Beranda')

@section('isi')
    <h1>Reservasi Laboratorium Politeknik Caltex Riau</h1>
    <p>
        SIRELAB memudahkan mahasiswa dan dosen memesan laboratorium:
        lihat fasilitas dan jadwal, ajukan reservasi, lalu pantau persetujuannya secara online.
    </p>

    <p>
        <a href="{{ route('laboratorium.index') }}">Lihat Laboratorium</a>
        @guest
            | <a href="{{ route('login') }}">Masuk</a>
            | <a href="{{ route('register') }}">Daftar</a>
        @endguest
        @auth
            @if (auth()->user()->role === 'admin')
                | <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
            @else
                | <a href="{{ route('reservasi.index') }}">Reservasi Saya</a>
            @endif
        @endauth
    </p>

    <h2>Laboratorium Tersedia</h2>
    @forelse ($labs as $lab)
    <x-lab-card :lab="$lab" />
@empty
    <p>Belum ada laboratorium.</p>
@endforelse

    <h2>Cara Memesan</h2>
    <ol>
        <li>Daftar atau masuk ke akun.</li>
        <li>Pilih laboratorium dan cek jadwalnya.</li>
        <li>Isi form reservasi dan unggah lampiran bila perlu.</li>
        <li>Tunggu persetujuan dari admin.</li>
    </ol>
@endsection
