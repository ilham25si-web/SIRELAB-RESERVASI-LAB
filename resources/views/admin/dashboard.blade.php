@extends('layouts.app')

@section('judul', 'Dashboard Admin')

@section('isi')
    <h1>Dashboard Admin</h1>
    <p>Halo, {{ auth()->user()->nama }}</p>
@endsection