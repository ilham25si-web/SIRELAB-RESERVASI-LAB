<?php

namespace App\Http\Controllers;

use App\Models\JadwalLab;
use App\Models\Laboratorium;
use Illuminate\Http\Request;

class AdminJadwalController extends Controller
{
    private function aturan(): array
    {
        return [
            'hari'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keterangan'  => 'nullable|string|max:100',
        ];
    }

    public function index(Laboratorium $laboratorium)
    {
        $jadwal = $laboratorium->jadwal()
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->orderBy('jam_mulai')
            ->get();

        return view('admin.jadwal.index', compact('laboratorium', 'jadwal'));
    }

    public function create(Laboratorium $laboratorium)
    {
        return view('admin.jadwal.create', compact('laboratorium'));
    }

    public function store(Request $request, Laboratorium $laboratorium)
    {
        $data = $request->validate($this->aturan());

        $laboratorium->jadwal()->create($data);

        return redirect()
            ->route('admin.laboratorium.jadwal.index', $laboratorium->id_lab)
            ->with('sukses', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(JadwalLab $jadwal)
    {
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, JadwalLab $jadwal)
    {
        $data = $request->validate($this->aturan());

        $jadwal->update($data);

        return redirect()
            ->route('admin.laboratorium.jadwal.index', $jadwal->id_lab)
            ->with('sukses', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(JadwalLab $jadwal)
    {
        $idLab = $jadwal->id_lab;
        $jadwal->delete();

        return redirect()
            ->route('admin.laboratorium.jadwal.index', $idLab)
            ->with('sukses', 'Jadwal berhasil dihapus.');
    }
}

