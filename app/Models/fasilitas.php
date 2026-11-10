<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fasilitas extends Model
{
protected $table = 'fasilitas';
protected $primaryKey = 'id_fasilitas';
protected $fillable = ['nama_fasilitas', 'deskripsi'];

public function laboratorium()
{
    return $this->belongsToMany(Laboratorium::class, 'lab_fasilitas', 'id_fasilitas', 'id_lab')
        ->withPivot('jumlah', 'kondisi')
        ->withTimestamps();
}
}
