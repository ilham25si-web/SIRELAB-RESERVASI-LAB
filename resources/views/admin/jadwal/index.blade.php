@extends('layouts.app')

@section('Judul', 'Jadwal Laboratorium')

@section('isi')
    <h1>Jadwal {{ $laboratorium->nama_lab }}</h1>

    <p>
        <a href="{{ route('admin.laboratorium.jadwal.create', $laboratorium->id_lab) }}">+ Tambah Jadwal</a> |
        <a href="{{ route('admin.laboratorium.index') }}">Kembali</a>
    </p>

    <table>
        <thead>
            <tr><th>Hari</th><th>Jam</th><th>Keterangan</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse ($jadwal as $j)
                <tr>
                    <td>{{ $j->hari }}</td>
                    <td>{{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }}</td>
                    <td>{{ $j->keterangan ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.jadwal.edit', $j->id_jadwal) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.jadwal.destroy', $j->id_jadwal) }}"
                              onsubmit="return confirm('Hapus jadwal ini?')" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada jadwal tetap.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection