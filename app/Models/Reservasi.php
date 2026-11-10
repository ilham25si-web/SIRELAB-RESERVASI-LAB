<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
protected $table = 'reservasi';
protected $primaryKey = 'id_reservasi';
protected $fillable = [
    'id_user', 'id_lab', 'tanggal', 'jam_mulai', 'jam_selesai',
    'keperluan', 'jumlah_peserta', 'status', 'diverifikasi_oleh', 'catatan_admin',
];

protected $casts = ['tanggal' => 'date'];

public function user()
{
    return $this->belongsTo(User::class, 'id_user', 'id_user');
}

public function laboratorium()
{
    return $this->belongsTo(Laboratorium::class, 'id_lab', 'id_lab');
}

public function verifikator()
{
    return $this->belongsTo(User::class, 'diverifikasi_oleh', 'id_user');
}
}
