<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Reservasi;
use App\Models\JadwalLab;
use App\Models\Laboratorium;
use App\Models\Fasilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Admin Laboratorium',
            'identitas' => 'ADM001',
            'email' => 'admin@pcr.ac.id',
            'password' =>'password',
            'role' => 'admin',
            'no_hp' => '081234567890',
        ]);

        User::create([
            'nama' => 'Ilham',
            'identitas' => '2557301079',
            'email' => 'ilham25si@mahasiswa.pcr.ac.id',
            'password' => 'password',
            'role' => 'pengguna',
            'no_hp' => '081234567891',
        ]);

        Laboratorium::create([
            'nama_lab' => 'Laboratorium Sistem Operasi',
            'lokasi' => 'Gedung A, Lantai 1',
            'kapasitas' => 30,
            'deskripsi' => 'Laboratorium untuk praktikum komputer.',
            'status' => 'aktif',
        ]);

        Laboratorium::create([
            'nama_lab' => 'Laboratorium Praktikum Pemprograman Framework',
            'lokasi' => 'Gedung B, Lantai 2',
            'kapasitas' => 20,
            'deskripsi' => 'Laboratorium untuk praktikum elektronika.',
            'status' => 'aktif',
        ]);

        Laboratorium::create([
            'nama_lab' => 'Laboratorium Jaringan Komputer',
            'lokasi' => 'Gedung C, Lantai 3',
            'kapasitas' => 25,
            'deskripsi' => 'Laboratorium untuk praktikum jaringan komputer.',
            'status' => 'aktif',
        ]);

        Laboratorium::create([
            'nama_lab' => 'Laboratorium Basis Data',
            'lokasi' => 'Gedung D, Lantai 4',
            'kapasitas' => 15,
            'deskripsi' => 'Laboratorium untuk praktikum basis data.',
            'status' => 'aktif',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Komputer',
            'deskripsi' => 'Komputer untuk praktikum.',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Proyektor',
            'deskripsi' => 'Proyektor untuk presentasi.',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Smartboard',
            'deskripsi' => 'Whiteboard untuk menulis.',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Kabel LAN',
            'deskripsi' => 'Kabel LAN untuk koneksi jaringan.',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Router',
            'deskripsi' => 'Router untuk koneksi jaringan.',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => 'Switch',
            'deskripsi' => 'Switch untuk koneksi jaringan.',
        ]);
        
        Fasilitas::create([
            'nama_fasilitas' => 'Modem',
            'deskripsi' => 'Modem untuk koneksi internet.',
        ]);

    }
}
