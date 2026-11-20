@extends('layouts.app')

@section('judul', 'Dashboard Admin')

@section('isi')
    <h1>Dashboard Admin</h1>
    <p>Halo, {{ auth()->user()->nama }}</p>
    <p><a href="{{ route('admin.reservasi.index') }}">Kelola Reservasi</a></p>
    <p><a href="{{ route('admin.laboratorium.index') }}">Kelola Laboratorium</a></p>
@endsection