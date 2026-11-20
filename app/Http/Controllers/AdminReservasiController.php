<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\JadwalLab;
use Illuminate\Support\Facades\Auth;

class AdminReservasiController extends Controller
{
    public function index(Request $request)
    {
        $reservasi = Reservasi::with(['user', 'laboratorium'])
    ->when($request->filled('q'), function ($query) use ($request) {
        $query->where(function ($sub) use ($request) {
            $sub->whereHas('user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->q . '%');
            })->orWhereHas('laboratorium', function ($q) use ($request) {
                $q->where('nama_lab', 'like', '%' . $request->q . '%');
            });
        });
    })
    ->when($request->filled('status'), function ($query) use ($request) {
        $query->where('status', $request->status);
    })
    ->orderBy('tanggal', 'desc')
    ->paginate(10)
    ->withQueryString();

return view('admin.reservasi.index', compact('reservasi'));
    }

    public function setujui(Request $request, Reservasi $reservasi)
    {
        // 1. hanya yang masih menunggu
        if ($reservasi->status !== 'menunggu') {
            return back()->with('error', 'Reservasi ini sudah diproses.');
        }

        // 2. cek bentrok dengan reservasi lain yg sudah disetujui
        $bentrokReservasi = Reservasi::where('id_lab', $reservasi->id_lab)
            ->where('tanggal', $reservasi->tanggal)
            ->where('status', 'disetujui')
            ->where('id_reservasi', '!=', $reservasi->id_reservasi)
            ->where('jam_mulai', '<', $reservasi->jam_selesai)
            ->where('jam_selesai', '>', $reservasi->jam_mulai)
            ->exists(); 

        // 3. cek bentrok dengan jadwal tetap lab
        $namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $hari = $namaHari[$reservasi->tanggal->dayOfWeek];

        $bentrokJadwal = JadwalLab::where('id_lab', $reservasi->id_lab)
            ->where('hari', $hari)
            ->where('jam_mulai', '<', $reservasi->jam_selesai)
            ->where('jam_selesai', '>', $reservasi->jam_mulai)
            ->exists();

        if ($bentrokReservasi || $bentrokJadwal) {
            return back()->with('error', 'Tidak bisa disetujui: bentrok dengan  reservasi atau jadwal lab lain.');
    }
    
        // 4. setujui
        $reservasi->status = 'disetujui';
        $reservasi->diverifikasi_oleh = auth()->user()->id_user;
        $reservasi->catatan_admin = $request->catatan_admin;
        $reservasi->save();

        return back()->with('success', 'Reservasi berhasil disetujui.');
    }
    

    public function tolak(Request $request, Reservasi $reservasi)
    {
        if ($reservasi->status !== 'menunggu') {
            return back()->with('error', 'Reservasi ini sudah diproses.');
        }

        $reservasi->status = 'ditolak';
        $reservasi->diverifikasi_oleh = auth()->user()->id_user;
        $reservasi->catatan_admin = $request->catatan_admin;
        $reservasi->save();

        return back()->with('success', 'Reservasi berhasil ditolak.');
    }
}
