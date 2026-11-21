@extends('layouts.app')

@section('judul', 'Edit Laboratorium')

@section('isi')
    <h1>Edit Laboratorium</h1>

    <form method="POST" action="{{ route('admin.laboratorium.update', $laboratorium->id_lab) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_lab">Nama lab</label>
            @if ($laboratorium->foto)
                <img src="{{ asset('storage/' . $laboratorium->foto) }}" width="120" alt="">
            @endif
            <input type="text" id="nama_lab" name="nama_lab" value="{{ old('nama_lab', $laboratorium->nama_lab) }}">
            @error('nama_lab') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="lokasi">Lokasi</label>
            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $laboratorium->lokasi) }}">
            @error('lokasi') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="kapasitas">Kapasitas</label>
            <input type="number" id="kapasitas" name="kapasitas" min="1" value="{{ old('kapasitas', $laboratorium->kapasitas) }}">
            @error('kapasitas') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $laboratorium->deskripsi) }}</textarea>
            @error('deskripsi') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="aktif" {{ old('status', $laboratorium->status) === 'aktif' ? 'selected' : '' }}>aktif</option>
                <option value="nonaktif" {{ old('status', $laboratorium->status) === 'nonaktif' ? 'selected' : '' }}>nonaktif</option>
            </select>
            @error('status') <small>{{ $message }}</small> @enderror
        </div>

        <div>
            <label for="foto">Foto (opsional, maks 2 MB)</label>
            <input type="file" id="foto" name="foto" accept="image/*">
            @error('foto') <small>{{ $message }}</small> @enderror
        </div>

        <button type="submit">Simpan</button>
        <a href="{{ route('admin.laboratorium.index') }}">Batal</a>
    </form>
@endsection