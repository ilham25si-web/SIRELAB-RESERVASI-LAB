@extends('layouts.app')

@section('judul', 'Reservasi Saya')

@section('isi')
    <h1>Reservasi Saya</h1>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Laboratorium</th>
                <th>Jam</th>
                <th>Status</th>
                <th>Lampiran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservasi as $r)
                <tr>
                    <td>{{ $r->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $r->laboratorium->nama_lab }}</td>
                    <td>{{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}</td>
                    <td>{{ $r->status }}</td>
                    <td>
                        @forelse ($r->lampiran as $l)
                            <a href="{{ asset('storage/' . $l->path) }}" target="_blank">{{ $l->nama_asli }}</a><br>
                        @empty
                            -
                        @endforelse
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada reservasi.</td></tr>
            @endforelse

            <td>
            @if ($r->status === 'menunggu')
            <form method="POST" action="{{ route('reservasi.batal', $r->id_reservasi) }}"
            onsubmit="return confirm('Yakin batalkan reservasi ini?')">
            @csrf
            @method('PATCH')
                <button type="submit">Batalkan</button>
                </form>
            @endif
            </td>
        </tbody>
    </table>

    {{ $reservasi->links() }}
@endsection