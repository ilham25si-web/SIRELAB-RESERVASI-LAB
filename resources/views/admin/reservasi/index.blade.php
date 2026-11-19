@extends('layouts.app')

@section('judul', 'Kelola Reservasi')

@section('isi')
    <h1>Kelola Reservasi</h1>

    <form method="GET" action="{{ route('admin.reservasi.index') }}">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari pemohon atau lab">
        <select name="status">
            <option value="">Semua status</option>
            @foreach (['menunggu', 'disetujui', 'ditolak', 'dibatalkan'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <button type="submit">Cari</button>
    </form>

    <table border="1" cellpadding="6">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pemohon</th>
                <th>Laboratorium</th>
                <th>Jam</th>
                <th>Peserta</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservasi as $r)
                <tr>
                    <td>{{ $r->tanggal->format('d/m/Y') }}</td>
                    <td>{{ $r->user->nama }}</td>
                    <td>{{ $r->laboratorium->nama_lab }}</td>
                    <td>{{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}</td>
                    <td>{{ $r->jumlah_peserta }}</td>
                    <td>{{ $r->status }}</td>
                </tr>
            @empty
                <tr><td colspan="6">Tidak ada reservasi.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $reservasi->links() }}
@endsection