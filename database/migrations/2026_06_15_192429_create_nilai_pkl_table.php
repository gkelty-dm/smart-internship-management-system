<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_pkl', function (Blueprint $table) {

            $table->id();

            $table->foreignId('penempatan_pkl_id')
                ->constrained('penempatan_pkl')
                ->cascadeOnDelete();

            $table->decimal('nilai_industri',5,2);

            $table->decimal('nilai_guru',5,2);

            $table->decimal('nilai_akhir',5,2);

            $table->string('predikat')
                ->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_pkl');
    }
};