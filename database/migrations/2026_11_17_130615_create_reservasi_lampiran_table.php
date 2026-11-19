<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasi_lampiran', function (Blueprint $table) {
            $table->id('id_lampiran');
            $table->foreignId('id_reservasi')->constrained('reservasi', 'id_reservasi')->cascadeOnDelete();
            $table->string('nama_asli');
            $table->string('path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasi_lampiran');
    }
};