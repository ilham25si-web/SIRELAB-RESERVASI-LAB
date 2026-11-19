<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;

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
}
