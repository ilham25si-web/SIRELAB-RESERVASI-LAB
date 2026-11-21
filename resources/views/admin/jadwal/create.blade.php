@extends('layouts.app')

@section('Judul', 'Tambah Jadwal')

@section('isi')
    <h1>Tambah Jadwal {{ $laboratorium->nama_lab }}</h1>

    <form method="POST" action="{{ route('admin.laboratorium.jadwal.store', $laboratorium->id_lab) }}">
        @csrf
        @include('admin.jadwal._form')
        <a href="{{ route('admin.laboratorium.jadwal.index', $laboratorium->id_lab) }}">Batal</a>
    </form>
@endsection