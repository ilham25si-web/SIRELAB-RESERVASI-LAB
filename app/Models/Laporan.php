<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
public $table = 'laporan';
public $primaryKey = 'id_laporan';
public $timestamps = false;
protected $fillable = ['id_user', 'periode_awal', 'periode_akhir', 'tanggal_cetak'];

public function user()
{
    return $this->belongsTo(User::class, 'id_user', 'id_user');
}
}
