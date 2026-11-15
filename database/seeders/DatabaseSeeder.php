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
        $admin = User::create([
            'nama' => 'Admin Laboratorium',
            'identitas' => 'ADM001',
            'email' => 'admin@pcr.ac.id',
            'password' =>'password',
            'role' => 'admin',
            'no_hp' => '081234567890',
        ]);

        $mahasiswa = User::create([
            'nama' => 'Ilham',
            'identitas' => '2557301079',
            'email' => 'ilham25si@mahasiswa.pcr.ac.id',
            'password' => 'password',
            'role' => 'pengguna',
            'no_hp' => '081234567891',
        ]);

        $labSO = Laboratorium::create([
            'nama_lab' => 'Laboratorium Sistem Operasi',
            'lokasi' => 'Gedung A, Lantai 1',
            'kapasitas' => 30,
            'deskripsi' => 'Laboratorium untuk praktikum komputer.',
            'status' => 'aktif',
        ]);

        $labPFW = Laboratorium::create([
            'nama_lab' => 'Laboratorium Praktikum Pemprograman Framework',
            'lokasi' => 'Gedung B, Lantai 2',
            'kapasitas' => 20,
            'deskripsi' => 'Laboratorium untuk praktikum elektronika.',
            'status' => 'aktif',
        ]);

        $labJK = Laboratorium::create([
            'nama_lab' => 'Laboratorium Jaringan Komputer',
            'lokasi' => 'Gedung C, Lantai 3',
            'kapasitas' => 25,
            'deskripsi' => 'Laboratorium untuk praktikum jaringan komputer.',
            'status' => 'aktif',
        ]);

        $labBD = Laboratorium::create([
            'nama_lab' => 'Laboratorium Basis Data',
            'lokasi' => 'Gedung D, Lantai 4',
            'kapasitas' => 15,
            'deskripsi' => 'Laboratorium untuk praktikum basis data.',
            'status' => 'aktif',
        ]);

        $komputer = Fasilitas::create([
            'nama_fasilitas' => 'Komputer',
            'deskripsi' => 'Komputer untuk praktikum.',
        ]);

        $proyektor = Fasilitas::create([
            'nama_fasilitas' => 'Proyektor',
            'deskripsi' => 'Proyektor untuk presentasi.',
        ]);

        $smartboard = Fasilitas::create([
            'nama_fasilitas' => 'Smartboard',
            'deskripsi' => 'Whiteboard untuk menulis.',
        ]);

        $kabelLAN = Fasilitas::create([
            'nama_fasilitas' => 'Kabel LAN',
            'deskripsi' => 'Kabel LAN untuk koneksi jaringan.',
        ]);

        $router = Fasilitas::create([
            'nama_fasilitas' => 'Router',
            'deskripsi' => 'Router untuk koneksi jaringan.',
        ]);

        $switch = Fasilitas::create([
            'nama_fasilitas' => 'Switch',
            'deskripsi' => 'Switch untuk koneksi jaringan.',
        ]);

        $modem = Fasilitas::create([
            'nama_fasilitas' => 'Modem',
            'deskripsi' => 'Modem untuk koneksi internet.',
        ]);

        $labSO->fasilitas()->attach($komputer->id_fasilitas, ['jumlah' => 30, 'kondisi' => 'baik']);
        $labPFW->fasilitas()->attach($komputer->id_fasilitas, ['jumlah' => 20, 'kondisi' => 'baik']);
        $labJK->fasilitas()->attach($komputer->id_fasilitas, ['jumlah' => 25, 'kondisi' => 'baik']);
        $labBD->fasilitas()->attach($komputer->id_fasilitas, ['jumlah' => 15, 'kondisi' => 'baik']);



        $labJK->fasilitas()->attach($router->id_fasilitas, ['jumlah' => 2, 'kondisi' => 'baik']);
        $labJK->fasilitas()->attach($switch->id_fasilitas, ['jumlah' => 4, 'kondisi' => 'baik']);
        $labJK->fasilitas()->attach($kabelLAN->id_fasilitas, ['jumlah' => 30, 'kondisi' => 'baik']);
        $labJK->fasilitas()->attach($modem->id_fasilitas, ['jumlah' => 1, 'kondisi' => 'rusak']);
        $labJK->fasilitas()->attach($komputer->id_fasilitas, ['jumlah' => 25, 'kondisi' => 'baik']);


        $labSO->fasilitas()->attach($smartboard->id_fasilitas, ['jumlah' => 1, 'kondisi' => 'baik']);
        $labSO->fasilitas()->attach($komputer->id_fasilitas, ['jumlah' => 30, 'kondisi' => 'baik']);

        $labPFW->fasilitas()->attach($komputer->id_fasilitas, ['jumlah' => 20, 'kondisi' => 'baik']);
        $labPFW->fasilitas()->attach($smartboard->id_fasilitas, ['jumlah' => 1, 'kondisi' => 'baik']);

        $labBD->fasilitas()->attach($komputer->id_fasilitas, ['jumlah' => 15, 'kondisi' => 'baik']);
        $labBD->fasilitas()->attach($smartboard->id_fasilitas, ['jumlah' => 1, 'kondisi' => 'baik']);
    
    
    
        JadwalLab::create([
            'id_lab' => $labSO->id_lab,
            'hari' => 'Rabu',
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '17:00:00',
            'keterangan' => 'Praktikum Sistem Operasi',
        ]);

        JadwalLab::create([
            'id_lab' => $labPFW->id_lab,
            'hari' => 'Senin',
            'jam_mulai' => '07:00:00',
            'jam_selesai' => '12:00:00',
            'keterangan' => 'Praktikum Pemrograman Framework',
        ]);

        JadwalLab::create([
            'id_lab' => $labJK->id_lab,
            'hari' => 'Selasa',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '12:00:00',
            'keterangan' => 'Praktikum Jaringan Komputer',
        ]);

        JadwalLab::create([
            'id_lab' => $labBD->id_lab,
            'hari' => 'Jumat',
            'jam_mulai' => '07:00:00',
            'jam_selesai' => '11:00:00',
            'keterangan' => 'Praktikum Basis Data',
        ]);
    
        Reservasi::create([
            'id_user' => $mahasiswa->id_user,
            'id_lab' => $labSO->id_lab,
            'tanggal' => '2024-06-15',
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '17:00:00',
            'keperluan' => 'Praktikum Sistem Operasi',
            'jumlah_peserta' => 30,
            'status' => 'menunggu',
        ]);

        Reservasi::create([
            'id_user' => $mahasiswa->id_user,
            'id_lab' => $labPFW->id_lab,
            'tanggal' => '2024-06-17',
            'jam_mulai' => '07:00:00',
            'jam_selesai' => '12:00:00',
            'keperluan' => 'Praktikum Pemrograman Framework',
            'jumlah_peserta' => 30,
            'status' => 'disetujui',
            'diverifikasi_oleh' => $admin->id_user,
        ]);
    
        Reservasi::create([
            'id_user' => $mahasiswa->id_user,
            'id_lab' => $labJK->id_lab,
            'tanggal' => '2024-06-18',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '12:00:00',
            'keperluan' => 'Praktikum Jaringan Komputer',
            'jumlah_peserta' => 30,
            'status' => 'menunggu',
        ]);

        Reservasi::create([
            'id_user' => $mahasiswa->id_user,
            'id_lab' => $labBD->id_lab,
            'tanggal' => '2024-06-19',
            'jam_mulai' => '07:00:00',
            'jam_selesai' => '11:00:00',
            'keperluan' => 'Praktikum Basis Data',
            'jumlah_peserta' => 30,
            'status' => 'menunggu',
        ]);

        }
}
