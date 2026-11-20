<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use Illuminate\Http\Request;

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
}