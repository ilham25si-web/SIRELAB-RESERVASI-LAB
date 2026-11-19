<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use Illuminate\Http\Request;

class LaboratoriumController extends Controller
{
    public function index(Request $request)
    {
        $labs = Laboratorium::query()
        ->where('status', 'aktif')
        ->when($request->filled('q'), fn ($query) => $query->where('nama_lab', 'like', '%' . $request->q . '%'))
        ->when($request->filled('kapasitas'), fn ($query) => $query->where('kapasitas', '>=', $request->kapasitas))
        ->orderBy('nama_lab')
        ->paginate(6)
        ->withQueryString();

    return view('laboratorium.index', compact('labs'));
}
    

    public function show(Laboratorium $laboratorium)
    {
        $laboratorium->load('fasilitas', 'jadwal');

        return view('laboratorium.show', compact('laboratorium'));
    }
}
