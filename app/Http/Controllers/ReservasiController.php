<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use App\Models\Reservasi;
use App\Models\JadwalLab;
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
        'lampiran'       => 'nullable|array|max:5',
        'lampiran.*'     => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    // A. bentrok dengan reservasi yang sudah disetujui
    $bentrokReservasi = Reservasi::where('id_lab', $laboratorium->id_lab)
        ->where('tanggal', $request->tanggal)
        ->where('status', 'disetujui')
        ->where('jam_mulai', '<', $request->jam_selesai)
        ->where('jam_selesai', '>', $request->jam_mulai)   
        ->exists();

    // B. bentrok dengan jadwal tetap lab
    $namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $hari = $namaHari[\Carbon\Carbon::parse($request->tanggal)->dayOfWeek];

    $bentrokJadwal = JadwalLab::where('id_lab', $laboratorium->id_lab) 
        ->where('hari', $hari)
        ->where('jam_mulai', '<', $request->jam_selesai)
        ->where('jam_selesai', '>', $request->jam_mulai)
        ->exists();

    // C. tolak kalau salah satunya true
    if ($bentrokReservasi || $bentrokJadwal) {
        return back()
            ->withErrors(['jam_mulai' => 'Jam tersebut bentrok dengan reservasi atau jadwal lab lain.'])
            ->withInput();
    }

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

    if ($request->hasFile('lampiran')) {
        foreach ($request->file('lampiran') as $file) {
        $path = $file->store('lampiran', 'public');

            $reservasi->lampiran()->create([
                'id_reservasi' => $reservasi->id_reservasi,
                'nama_asli' => $file->getClientOriginalName(),
                'path' => $path,
                ]);
        }
    }

    // 4. Kembali dengan pesan
    return redirect()
        ->route('laboratorium.show', $laboratorium->id_lab)
        ->with('sukses', 'Reservasi berhasil diajukan, menunggu verifikasi admin.');
}
}
