@extends('layouts.app')

@section('judul', 'Edit Jadwal')

@section('isi')
    <h1>Edit Jadwal</h1>

    <form method="POST" action="{{ route('admin.jadwal.update', $jadwal->id_jadwal) }}">
        @csrf
        @method('PUT')
        @include('admin.jadwal._form')
        <a href="{{ route('admin.laboratorium.jadwal.index', $jadwal->id_lab) }}">Batal</a>
    </form>
@endsection