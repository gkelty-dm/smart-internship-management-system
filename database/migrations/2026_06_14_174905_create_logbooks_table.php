<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logbooks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->cascadeOnDelete();

            $table->date('tanggal');

            $table->text('kegiatan');

            $table->text('kendala')
                ->nullable();

            $table->text('solusi')
                ->nullable();

            $table->enum('status_validasi', [
                'pending',
                'disetujui',
                'ditolak'
            ])->default('pending');

            $table->text('catatan_guru')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};