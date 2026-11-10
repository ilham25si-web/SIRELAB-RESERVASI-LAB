<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
protected $table = 'laporan';
protected $primaryKey = 'id_laporan';
protected $fillable = ['id_user', 'periode_awal', 'periode_akhir', 'tanggal_cetak'];

public function user()
{
    return $this->belongsTo(User::class, 'id_user', 'id_user');
}
}
