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
    Schema::table('mahasiswa', function (Blueprint $table) {
        // Kita tambahkan kolom is_active (boolean) 
        // Default 1 artinya aktif saat baru didaftarkan
        $table->boolean('is_active')->default(1)->after('divisi_id');
    });
}

public function down(): void
{
    Schema::table('mahasiswa', function (Blueprint $table) {
        $table->dropColumn('is_active');
    });
}

    
};
