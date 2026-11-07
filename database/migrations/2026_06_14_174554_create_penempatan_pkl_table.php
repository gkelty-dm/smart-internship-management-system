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
        Schema::create('penempatan_pkl', function (Blueprint $table) {
            $table->id();

            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete();

            $table->foreignId('guru_id')
                ->constrained('gurus')
                ->cascadeOnDelete();

            $table->foreignId('industri_id')
                ->nullable()
                ->constrained('industris')
                ->cascadeOnDelete();

            $table->foreignId('perusahaan_id')
                ->constrained('perusahaans')
                ->cascadeOnDelete();

            $table->date('tanggal_mulai')
                ->nullable();

            $table->date('tanggal_selesai')
                ->nullable();

            $table->enum('status_pkl', [
                'pending',
                'aktif',
                'selesai',
                'dibatalkan'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penempatan_pkl');
    }
};