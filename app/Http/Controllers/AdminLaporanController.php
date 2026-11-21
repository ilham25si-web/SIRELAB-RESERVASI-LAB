<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $riwayat = Laporan::with('user')->latest('tanggal_cetak')->paginate(10);

        return view('admin.laporan.index', compact('riwayat'));
    }

    public function buat(Request $request)
    {
        $data = $request->validate([
            'periode_awal'  => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_awal',
        ]);

        $laporan = Laporan::create([
            'id_user'       => Auth::id(),
            'periode_awal'  => $data['periode_awal'],
            'periode_akhir' => $data['periode_akhir'],
            'tanggal_cetak' => now(),
        ]);

        return redirect()->route('admin.laporan.show', $laporan->id_laporan);
    }

    public function show(Laporan $laporan)
    {
        $reservasi = Reservasi::with(['user', 'laboratorium'])
            ->whereBetween('tanggal', [$laporan->periode_awal, $laporan->periode_akhir])
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        $rekap = $reservasi->groupBy('status')->map->count();

        return view('admin.laporan.show', compact('laporan', 'reservasi', 'rekap'));
    }
}

