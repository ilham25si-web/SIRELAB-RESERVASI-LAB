<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalLab extends Model
{
public $table = 'jadwal_lab';
public $primaryKey = 'id_jadwal';
public $timestamps = false;
protected $fillable = ['id_lab', 'hari', 'jam_mulai', 'jam_selesai', 'keterangan'];

public function laboratorium()
{
    return $this->belongsTo(Laboratorium::class, 'id_lab', 'id_lab');
}
}
