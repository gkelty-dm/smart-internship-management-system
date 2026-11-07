<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logbook_fotos', function (Blueprint $table) {

            $table->id();

            $table->foreignId('logbook_id')
                ->constrained('logbooks')
                ->cascadeOnDelete();

            $table->string('foto');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logbook_fotos');
    }
};