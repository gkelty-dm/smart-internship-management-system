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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', [
            'admin',
            'guru',
            'siswa',
            'industri'
        ])->default('siswa')->after('email');

        $table->string('foto_profil')->nullable()->after('password');
        $table->boolean('is_active')->default(true)->after('foto_profil');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'role',
            'foto_profil',
            'is_active'
        ]);
    });
}
};
