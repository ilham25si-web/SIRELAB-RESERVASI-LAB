@extends('layouts.app')

@section('judul', 'Laporan Reservasi')

@section('isi')
    <h1>Laporan Reservasi</h1>

    <form method="POST" action="{{ route('admin.laporan.buat') }}">
        @csrf
        <label for="periode_awal">Dari</label>
        <input type="date" id="periode_awal" name="periode_awal" value="{{ old('periode_awal') }}">
        @error('periode_awal') <small>{{ $message }}</small> @enderror

        <label for="periode_akhir">Sampai</label>
        <input type="date" id="periode_akhir" name="periode_akhir" value="{{ old('periode_akhir') }}">
        @error('periode_akhir') <small>{{ $message }}</small> @enderror

        <button type="submit">Buat laporan</button>
    </form>

    <h2>Riwayat laporan</h2>
    <table border="1" cellpadding="6">
        <thead>
            <tr><th>Periode</th><th>Dibuat oleh</th><th>Tanggal cetak</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse ($riwayat as $r)
                <tr>
                    <td>{{ $r->periode_awal->format('d/m/Y') }} - {{ $r->periode_akhir->format('d/m/Y') }}</td>
                    <td>{{ $r->user->nama ?? '-' }}</td>
                    <td>{{ $r->tanggal_cetak->format('d/m/Y H:i') }}</td>
                    <td><a href="{{ route('admin.laporan.show', $r->id_laporan) }}">Lihat</a></td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada laporan.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $riwayat->links() }}
@endsection