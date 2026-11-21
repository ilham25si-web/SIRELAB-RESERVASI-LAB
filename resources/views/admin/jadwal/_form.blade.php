<div>
    <label for="hari">Hari</label>
    <select id="hari" name="hari">
        @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $h)
            <option value="{{ $h }}" {{ old('hari', $jadwal->hari ?? '') === $h ? 'selected' : '' }}>{{ $h }}</option>
        @endforeach
    </select>
    @error('hari') <small>{{ $message }}</small> @enderror
</div>

<div>
    <label for="jam_mulai">Jam mulai</label>
    <input type="time" id="jam_mulai" name="jam_mulai"
           value="{{ old('jam_mulai', isset($jadwal) ? substr($jadwal->jam_mulai, 0, 5) : '') }}">
    @error('jam_mulai') <small>{{ $message }}</small> @enderror
</div>

<div>
    <label for="jam_selesai">Jam selesai</label>
    <input type="time" id="jam_selesai" name="jam_selesai"
           value="{{ old('jam_selesai', isset($jadwal) ? substr($jadwal->jam_selesai, 0, 5) : '') }}">
    @error('jam_selesai') <small>{{ $message }}</small> @enderror
</div>

<div>
    <label for="keterangan">Keterangan</label>
    <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan', $jadwal->keterangan ?? '') }}">
    @error('keterangan') <small>{{ $message }}</small> @enderror
</div>

<button type="submit">Simpan</button>