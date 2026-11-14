<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
public $table = 'fasilitas';
public $primaryKey = 'id_fasilitas';
public $timestamps = false;
protected $fillable = ['nama_fasilitas', 'deskripsi'];

public function laboratorium()
{
    return $this->belongsToMany(Laboratorium::class, 'lab_fasilitas', 'id_fasilitas', 'id_lab')
        ->withPivot('jumlah', 'kondisi');
}
}
