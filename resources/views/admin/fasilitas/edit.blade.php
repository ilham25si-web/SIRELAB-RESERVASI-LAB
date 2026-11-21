@extends('layouts.app')

@section('judul', 'Edit Fasilitas')

@section('isi')
    <h1>Edit Fasilitas</h1>

    <form method="POST" action="{{ route('admin.fasilitas.update', $fasilitas->id_fasilitas) }}">
        @csrf
        @method('PUT')
        @include('admin.fasilitas._form')
    </form>
@endsection