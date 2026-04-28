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
        Schema::table('packages', function (Blueprint $blueprint) {
            // Menambahkan kolom intimate_duration setelah wedding_duration
            // Kita gunakan integer (satuan jam) dan nullable agar tidak merusak data lama
            $blueprint->integer('intimate_duration')->nullable()->after('wedding_duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $blueprint) {
            $blueprint->dropColumn('intimate_duration');
        });
    }
};