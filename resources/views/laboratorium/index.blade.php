@extends('layouts.app')

@section('judul', 'Daftar Laboratorium')

@section('isi')
    <h1>Daftar Laboratorium</h1>

    <form method="GET" action="{{ route('laboratorium.index') }}">
        <input type="text" name="q" placeholder="Cari nama lab" value="{{ request('q') }}">
        <input type="number" name="kapasitas" placeholder="Kapasitas minimal" value="{{ request('kapasitas') }}">
        <button type="submit">Cari</button>
    </form>

    @forelse ($labs as $lab)
        <div>
            <h3>{{ $lab->nama_lab }}</h3>
            <p>{{ $lab->lokasi }} - kapasitas {{ $lab->kapasitas }} orang</p>
            <p>{{ $lab->deskripsi }}</p>
        </div>
    @empty
        <p>Tidak ada laboratorium yang cocok.</p>
    @endforelse

    {{ $labs->links() }}
@endsection