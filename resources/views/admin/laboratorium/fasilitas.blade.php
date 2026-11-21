@extends('layouts.app')

@section('judul', 'Fasilitas ' . $laboratorium->nama_lab)

@section('isi')
    <h1>Fasilitas {{ $laboratorium->nama_lab }}</h1>

    <form method="POST" action="{{ route('admin.laboratorium.fasilitas.simpan', $laboratorium->id_lab) }}">
        @csrf
        @method('PUT')

        <table border="1" cellpadding="6">
            <thead>
                <tr>
                    <th>Ada</th>
                    <th>Fasilitas</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($semua as $f)
                    @php $ada = $terpasang->get($f->id_fasilitas); @endphp
                    <tr>
                        <td>
                            <input type="checkbox" name="fasilitas[{{ $f->id_fasilitas }}][pilih]" value="1"
                                   {{ $ada ? 'checked' : '' }}>
                        </td>
                        <td>{{ $f->nama_fasilitas }}</td>
                        <td>
                            <input type="number" min="1" name="fasilitas[{{ $f->id_fasilitas }}][jumlah]"
                                   value="{{ $ada->pivot->jumlah ?? 1 }}" style="width:70px">
                        </td>
                        <td>
                            <select name="fasilitas[{{ $f->id_fasilitas }}][kondisi]">
                                <option value="baik" {{ ($ada->pivot->kondisi ?? 'baik') === 'baik' ? 'selected' : '' }}>Baik</option>
                                <option value="rusak" {{ ($ada->pivot->kondisi ?? '') === 'rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit">Simpan</button>
        <a href="{{ route('admin.laboratorium.index') }}">Batal</a>
    </form>
@endsection