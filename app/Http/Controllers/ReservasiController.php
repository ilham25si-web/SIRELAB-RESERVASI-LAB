<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;

class ReservasiController extends Controller
{
    public function create($id_lab)
    {
        $laboratorium = Laboratorium::findOrFail($id_lab);
        return view('reservasi.create', compact('laboratorium'));
    }
}
