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
                <th>Aksi</th>
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
                    <td>
                        <a href="{{ route('admin.laboratorium.edit', $l->id_lab) }}">Edit</a>
                        <a href="{{ route('admin.laboratorium.fasilitas', $l->id_lab) }}">Fasilitas</a>
                        <a href="{{ route('admin.laboratorium.jadwal.index', $l->id_lab) }}">Jadwal</a>
                        <form method="POST" action="{{ route('admin.laboratorium.destroy', $l->id_lab) }}"
                              onsubmit="return confirm('Yakin hapus laboratorium ini?')" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada laboratorium.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $labs->links() }}
@endsection