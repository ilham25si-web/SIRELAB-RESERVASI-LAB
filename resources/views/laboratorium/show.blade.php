@extends('layouts.app')

@section('judul', $laboratorium->nama_lab)

@section('isi')
    <h1>{{ $laboratorium->nama_lab }}</h1>
    <p>{{ $laboratorium->lokasi }} - kapasitas {{ $laboratorium->kapasitas }} orang</p>
    <p>{{ $laboratorium->deskripsi }}</p>

    <h3>Fasilitas</h3>
    <ul>
        @forelse ($laboratorium->fasilitas as $f)
            <li>{{ $f->nama_fasilitas }}: {{ $f->pivot->jumlah }} unit ({{ $f->pivot->kondisi }})</li>
        @empty
            <li>Belum ada data fasilitas.</li>
        @endforelse
    </ul>

    <h3>Jadwal tetap</h3>
    <ul>
        @forelse ($laboratorium->jadwal as $j)
            <li>{{ $j->hari }}, {{ substr($j->jam_mulai, 0, 5) }}-{{ substr($j->jam_selesai, 0, 5) }}: {{ $j->keterangan }}</li>
        @empty
            <li>Tidak ada jadwal tetap.</li>
        @endforelse
    </ul>
    <a href="{{ route('reservasi.create', $laboratorium->id_lab) }}">Reservasi lab ini</a>
    <a href="{{ route('laboratorium.index') }}">Kembali</a>
@endsection