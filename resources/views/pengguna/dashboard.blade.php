@extends('layouts.app')

@section('judul', 'Dashboard Pengguna')

@section('isi')
    <h1>Dashboard Pengguna</h1>
    <p>Halo, {{ auth()->user()->nama }}</p>

    <a href="{{ route('laboratorium.index') }}">Lihat Daftar Laboratorium</a>
@endsection