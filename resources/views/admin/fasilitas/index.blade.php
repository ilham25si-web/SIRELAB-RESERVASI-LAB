@extends('layouts.app')

@section('judul', 'Kelola Fasilitas')

@section('isi')
    <h1>Kelola Fasilitas</h1>

    <p><a href="{{ route('admin.fasilitas.create') }}">+ Tambah Fasilitas</a></p>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fasilitas as $f)
                <tr>
                    <td>{{ $f->nama_fasilitas }}</td>
                    <td>{{ $f->deskripsi ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.fasilitas.edit', $f->id_fasilitas) }}">Edit</a>

                        <form method="POST" action="{{ route('admin.fasilitas.destroy', $f->id_fasilitas) }}"
                              onsubmit="return confirm('Yakin hapus fasilitas ini?')" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3">Belum ada fasilitas.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $fasilitas->links() }}
@endsection