<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            // Menambah kolom durasi spesifik
            $table->integer('prewedding_duration')->nullable()->after('price');
            $table->integer('wedding_duration')->nullable()->after('prewedding_duration');
        });
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['prewedding_duration', 'wedding_duration']);
        });
    }
};