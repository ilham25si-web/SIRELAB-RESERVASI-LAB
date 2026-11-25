@props(['lab', 'deskripsi' => false])

<div>
    <h3>{{ $lab->nama_lab }}</h3>
    <p>{{ $lab->lokasi }} - kapasitas {{ $lab->kapasitas }} orang</p>
    @if ($deskripsi)
        <p>{{ $lab->deskripsi }}</p>
    @endif
    <a href="{{ route('laboratorium.show', $lab->id_lab) }}">Lihat detail</a>
</div>