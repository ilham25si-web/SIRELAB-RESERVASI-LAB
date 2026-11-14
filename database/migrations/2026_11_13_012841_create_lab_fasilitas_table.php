<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lab_fasilitas', function (Blueprint $table) {
            $table->id('id_lab_fasilitas');
            $table->foreignId('id_lab')->constrained('laboratorium', 'id_lab');
            $table->foreignId('id_fasilitas')->constrained('fasilitas', 'id_fasilitas');
            $table->integer('jumlah');
            $table->enum('kondisi', ['baik', 'rusak']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_fasilitas');
    }
};
