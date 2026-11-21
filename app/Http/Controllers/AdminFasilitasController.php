<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;
use Illuminate\validation\Rule;

class AdminFasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::orderBy('nama_fasilitas')->paginate(10);

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_fasilitas' => 'required|string|max:100|unique:fasilitas,nama_fasilitas',
            'deskripsi'      => 'nullable|string',
        ]);

        Fasilitas::create($data);

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('sukses', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Fasilitas $fasilitas)
    {
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $data = $request->validate([
            'nama_fasilitas' => [
                'required',
                'string',
                'max:100',
                Rule::unique('fasilitas', 'nama_fasilitas')->ignore($fasilitas->id_fasilitas, 'id_fasilitas'),
            ],
            'deskripsi' => 'nullable|string',
        ]);

        $fasilitas->update($data);

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('sukses', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->laboratorium()->detach(); // Hapus relasi dengan laboratorium
        $fasilitas->delete();

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('sukses', 'Fasilitas berhasil dihapus.');
    }
}
