<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('absensis', function (Blueprint $table) {

            $table->boolean(
                'face_verified'
            )->default(false);

            $table->decimal(
                'face_confidence',
                5,
                2
            )->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {

            $table->dropColumn([
                'face_verified',
                'face_confidence'
            ]);

        });
    }
};