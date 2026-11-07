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
    Schema::create('absensis', function (Blueprint $table) {
        $table->id();

        $table->foreignId('siswa_id')
            ->constrained('siswas')
            ->cascadeOnDelete();

        $table->date('tanggal');

        $table->time('jam_masuk')->nullable();
        $table->time('jam_pulang')->nullable();

        $table->string('foto_masuk')->nullable();
        $table->string('foto_pulang')->nullable();

        $table->decimal('latitude_masuk',10,7)->nullable();
        $table->decimal('longitude_masuk',10,7)->nullable();

        $table->decimal('latitude_pulang',10,7)->nullable();
        $table->decimal('longitude_pulang',10,7)->nullable();

        $table->enum('metode_verifikasi',[
            'gps',
            'face',
            'gps_face',
            'manual'
        ])->default('manual');

        $table->string('device_info')->nullable();
        $table->string('ip_address')->nullable();

        $table->enum('status',[
            'hadir',
            'izin',
            'sakit',
            'alpha'
        ])->default('hadir');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
