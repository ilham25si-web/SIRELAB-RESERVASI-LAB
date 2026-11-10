<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class laboratorium extends Model
{

protected $table = 'laboratorium';
protected $primaryKey = 'id_lab';
protected $fillable = ['nama_lab', 'lokasi', 'kapasitas', 'deskripsi', 'foto', 'status'];

public function reservasi()
{
    return $this->hasMany(Reservasi::class, 'id_lab', 'id_lab');
}

public function jadwal()
{
    return $this->hasMany(JadwalLab::class, 'id_lab', 'id_lab');
}

public function fasilitas()
{
    return $this->belongsToMany(Fasilitas::class, 'lab_fasilitas', 'id_lab', 'id_fasilitas')
        ->withPivot('jumlah', 'kondisi')
        ->withTimestamps();
}
}
