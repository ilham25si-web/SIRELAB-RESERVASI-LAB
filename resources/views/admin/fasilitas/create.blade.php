@extends('layouts.app')

@section('judul', 'Tambah Fasilitas')

@section('isi')
    <h1>Tambah Fasilitas</h1>

    <form method="POST" action="{{ route('admin.fasilitas.store') }}">
        @csrf
        @include('admin.fasilitas._form')
    </form>
@endsection