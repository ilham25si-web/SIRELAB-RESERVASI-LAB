<div>
    <label for="nama_fasilitas">Nama fasilitas</label>
    <input type="text" id="nama_fasilitas" name="nama_fasilitas"
           value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas ?? '') }}">
    @error('nama_fasilitas') <small>{{ $message }}</small> @enderror
</div>

<div>
    <label for="deskripsi">Deskripsi</label>
    <textarea id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $fasilitas->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <small>{{ $message }}</small> @enderror
</div>

<button type="submit">Simpan</button>
<a href="{{ route('admin.fasilitas.index') }}">Batal</a>