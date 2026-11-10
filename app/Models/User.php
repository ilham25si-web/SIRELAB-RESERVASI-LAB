<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

protected $primaryKey = 'id_user';

protected $fillable = ['nama', 'identitas', 'email', 'password', 'role', 'no_hp'];

public function reservasi()
{
    return $this->hasMany(Reservasi::class, 'id_user', 'id_user');
}

public function reservasiDiverifikasi()
{
    return $this->hasMany(Reservasi::class, 'diverifikasi_oleh', 'id_user');
}

public function laporan()
{
    return $this->hasMany(Laporan::class, 'id_user', 'id_user');
}

}
