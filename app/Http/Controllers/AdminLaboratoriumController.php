<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use Illuminate\Http\Request;
use App\Models\Fasilitas;
use App\Models\simpanFasilitas;
use Illuminate\support\facedes\Storage;

class AdminLaboratoriumController extends Controller
{
    public function index()
    {
        $labs = Laboratorium::orderBy('nama_lab')->paginate(10);

        return view('admin.laboratorium.index', compact('labs'));
    }

    public function create()
    {
        return view('admin.laboratorium.create');
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'nama_lab'  => 'required|string|max:100',
        'lokasi'    => 'required|string|max:100',
        'kapasitas' => 'required|integer|min:1',
        'deskripsi' => 'nullable|string',
        'status'    => 'required|in:aktif,nonaktif',
        'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('laboratorium', 'public');
    }

    Laboratorium::create($data);

    return redirect()
        ->route('admin.laboratorium.index')
        ->with('sukses', 'Laboratorium berhasil ditambahkan.');
}

public function fasilitas(Laboratorium $laboratorium)
{
    $semua = Fasilitas::orderBy('nama_fasilitas')->get();
    $terpasang = $laboratorium->fasilitas->keyBy('id_fasilitas');

    return view('admin.laboratorium.fasilitas', compact('laboratorium', 'semua', 'terpasang'));
}

public function simpanFasilitas(Request $request, Laboratorium $laboratorium)
{
    $request->validate([
        'fasilitas.*.jumlah'  => 'nullable|integer|min:1',
        'fasilitas.*.kondisi' => 'nullable|in:baik,rusak',
    ]);

    $sync = [];

    foreach ($request->input('fasilitas', []) as $id => $baris) {
        if (!empty($baris['pilih'])) {
            $sync[$id] = [
                'jumlah'  => $baris['jumlah'] ?? 1,
                'kondisi' => $baris['kondisi'] ?? 'baik',
            ];
        }
    }

    $laboratorium->fasilitas()->sync($sync);

    return redirect()
        ->route('admin.laboratorium.index')
        ->with('sukses', 'Fasilitas lab berhasil disimpan.');
}

public function edit(Laboratorium $laboratorium)
{
    return view('admin.laboratorium.edit', compact('laboratorium'));
}

public function update(Request $request, Laboratorium $laboratorium)
{
    $data = $request->validate([
        'nama_lab'  => 'required|string|max:100',
        'lokasi'    => 'required|string|max:100',
        'kapasitas' => 'required|integer|min:1',
        'deskripsi' => 'nullable|string',
        'status'    => 'required|in:aktif,nonaktif',
        'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        if ($laboratorium->foto) {
            Storage::disk('public')->delete($laboratorium->foto);
        }
        $data['foto'] = $request->file('foto')->store('laboratorium', 'public');
    }

    $laboratorium->update($data);

    return redirect()
        ->route('admin.laboratorium.index')
        ->with('sukses', 'Laboratorium berhasil diperbarui.');
}

public function destroy(Laboratorium $laboratorium)
{
    if ($laboratorium->reservasi()->exists()) {
        return back()->with('error', 'Lab tidak bisa dihapus karena sudah memiliki reservasi. Ubah statusnya menjadi nonaktif.');
    }

    if ($laboratorium->foto) {
        Storage::disk('public')->delete($laboratorium->foto);
    }

    $laboratorium->fasilitas()->detach();
    $laboratorium->jadwal()->delete();
    $laboratorium->delete();

    return redirect()
        ->route('admin.laboratorium.index')
        ->with('sukses', 'Laboratorium berhasil dihapus.');
}
}