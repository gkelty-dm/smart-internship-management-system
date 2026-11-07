<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian_industri', function (Blueprint $table) {

            $table->id();

            $table->foreignId('penempatan_pkl_id')
                ->constrained('penempatan_pkl')
                ->cascadeOnDelete();

            $table->foreignId('industri_id')
                ->constrained('industris')
                ->cascadeOnDelete();

            $table->integer('disiplin');
            $table->integer('kerjasama');
            $table->integer('inisiatif');
            $table->integer('tanggung_jawab');
            $table->integer('keterampilan');

            $table->decimal('nilai_akhir', 5, 2)
                ->nullable();

            $table->text('catatan')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian_industri');
    }
};