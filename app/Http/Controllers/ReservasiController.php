<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function create($id_lab)
    {
        $laboratorium = Laboratorium::findOrFail($id_lab);
        return view('reservasi.create', compact('laboratorium'));
    }

    public function store(Request $request, $id_lab)
{
    // 1. Ambil lab dulu (dipakai validasi)
    $laboratorium = Laboratorium::findOrFail($id_lab);

    // 2. Validasi
    $request->validate([
        'tanggal'        => 'required|date|after_or_equal:today',
        'jam_mulai'      => 'required',
        'jam_selesai'    => 'required|after:jam_mulai',
        'keperluan'      => 'required|string|max:255',
        'jumlah_peserta' => 'required|integer|min:1|max:' . $laboratorium->kapasitas,
    ]);

    // 3. Simpan
    $reservasi = new Reservasi();
    $reservasi->tanggal        = $request->tanggal;
    $reservasi->jam_mulai      = $request->jam_mulai;
    $reservasi->jam_selesai    = $request->jam_selesai;
    $reservasi->keperluan      = $request->keperluan;
    $reservasi->jumlah_peserta = $request->jumlah_peserta;
    $reservasi->id_lab         = $laboratorium->id_lab;
    $reservasi->id_user        = Auth::user()->id_user;
    $reservasi->save();

    // 4. Kembali dengan pesan
    return redirect()
        ->route('laboratorium.show', $laboratorium->id_lab)
        ->with('sukses', 'Reservasi berhasil diajukan, menunggu verifikasi admin.');
}
}
