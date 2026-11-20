@extends('layouts.app')

@section('judul', 'Kelola Laboratorium')

@section('isi')
    <h1>Kelola Laboratorium</h1>

    <p><a href="{{ route('admin.laboratorium.create') }}">+ Tambah Laboratorium</a></p>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Kapasitas</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($labs as $l)
                <tr>
                    <td>
                        @if ($l->foto)
                            <img src="{{ asset('storage/' . $l->foto) }}" width="80" alt="{{ $l->nama_lab }}">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $l->nama_lab }}</td>
                    <td>{{ $l->lokasi }}</td>
                    <td>{{ $l->kapasitas }}</td>
                    <td>{{ $l->status }}</td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada laboratorium.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $labs->links() }}
@endsection