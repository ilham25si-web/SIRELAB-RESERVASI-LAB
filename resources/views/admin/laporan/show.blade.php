@extends('layouts.app')

@section('judul', 'Detail Laporan')

@section('isi')
    <h1>Laporan Reservasi</h1>
    <p>
        Periode {{ $laporan->periode_awal->format('d/m/Y') }} - {{ $laporan->periode_akhir->format('d/m/Y') }}<br>
        Dicetak {{ $laporan->tanggal_cetak->format('d/m/Y H:i') }}
    </p>

    <p>
        Total: {{ $reservasi->count() }} |
        @foreach (['menunggu', 'disetujui', 'ditolak', 'dibatalkan'] as $s)
            {{ ucfirst($s) }}: {{ $rekap[$s] ?? 0 }}@if (! $loop->last) | @endif
        @endforeach
    </p>

    <table border="1" cellpadding="6">
        <thead>
            <tr><th>Tanggal</th><th>Jam</th><th>Lab</th><th>Pemesan</th><th>Keperluan</th><th>Status</th></tr>
        </thead>
        <tbody>
            @forelse ($reservasi as $r)
                <tr>
                    <td>{{ $r->tanggal->format('d/m/Y') }}</td>
                    <td>{{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}</td>
                    <td>{{ $r->laboratorium->nama_lab }}</td>
                    <td>{{ $r->user->nama }}</td>
                    <td>{{ $r->keperluan }}</td>
                    <td>{{ $r->status }}</td>
                </tr>
            @empty
                <tr><td colspan="6">Tidak ada reservasi pada periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>

    <p>
        <button onclick="window.print()">Cetak</button>
        <a href="{{ route('admin.laporan.index') }}">Kembali</a>
    </p>
@endsection