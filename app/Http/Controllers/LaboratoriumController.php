<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use Illuminate\Http\Request;

class LaboratoriumController extends Controller
{
    public function index(Request $request)
    {
        // ... isi index punyamu, jangan diubah
    }

    public function show(Laboratorium $laboratorium)
    {
        $laboratorium->load('fasilitas', 'jadwal');

        return view('laboratorium.show', compact('laboratorium'));
    }
}