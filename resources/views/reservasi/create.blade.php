@extends('layouts.app')

@section('judul', 'Reservasi ' . $laboratorium->nama_lab)

@section('isi')
    <h1>Reservasi {{ $laboratorium->nama_lab }}</h1>
    <p>{{ $laboratorium->lokasi }} - kapasitas maksimal {{ $laboratorium->kapasitas }} orang</p>

    <form method="POST" action="{{ route('reservasi.store', $laboratorium->id_lab) }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
            @error('tanggal') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="jam_mulai">Jam mulai</label>
            <input type="time" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}">
            @error('jam_mulai') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="jam_selesai">Jam selesai</label>
            <input type="time" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}">
            @error('jam_selesai') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="keperluan">Keperluan</label>
            <textarea id="keperluan" name="keperluan" rows="3">{{ old('keperluan') }}</textarea>
            @error('keperluan') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="jumlah_peserta">Jumlah peserta</label>
            <input type="number" id="jumlah_peserta" name="jumlah_peserta" min="1" value="{{ old('jumlah_peserta') }}">
            @error('jumlah_peserta') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="lampiran">Lampiran (boleh lebih dari satu)</label>
            <input type="file" id="lampiran" name="lampiran[]" multiple>
            @error('lampiran.*') <small>{{ $message }}</small> @enderror
        </div>

        <button type="submit">Ajukan reservasi</button>
        <a href="{{ route('laboratorium.show', $laboratorium->id_lab) }}">Batal</a>
    </form>
@endsection