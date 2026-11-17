<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservasiLampiran extends Model
{
    protected $table = 'reservasi_lampiran';
    protected $primaryKey = 'id_lampiran';

    protected $fillable = ['id_reservasi', 'nama_asli', 'path'];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }
}