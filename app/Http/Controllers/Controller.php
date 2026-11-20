<?php

namespace App\Http\Controllers;
use App\Models\Laboratorium;
use App\Models\JadwalLab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


abstract class Controller
{
    public function index(Request $request)
{
    $labs = Laboratorium::query()
        ->where('status', 'aktif')
        ->when($request->filled('q'), function ($query) use ($request) {
            $query->where('nama_lab', 'like', '%' . $request->q . '%');
        })
        ->when($request->filled('kapasitas'), function ($query) use ($request) {
            $query->where('kapasitas', '>=', $request->kapasitas);
        })
        ->orderBy('nama_lab')
        ->paginate(6)
        ->withQueryString();

    return view('laboratorium.index', compact('labs'));
}
}
