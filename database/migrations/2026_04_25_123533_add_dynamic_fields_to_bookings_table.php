<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $blueprint) {
            // Kolom untuk Prewedding
            $blueprint->date('prewedding_date')->nullable()->after('booking_date');
            $blueprint->string('prewedding_location')->nullable()->after('prewedding_date');
            $blueprint->enum('prewedding_category', ['indoor', 'outdoor'])->nullable()->after('prewedding_location');
            $blueprint->time('prewedding_time')->nullable()->after('prewedding_category');

            // Kolom Tambahan untuk Wedding/Engagement
            $blueprint->string('wedding_location')->nullable()->after('prewedding_time');
            $blueprint->time('wedding_time')->nullable()->after('wedding_location');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $blueprint) {
            $blueprint->dropColumn([
                'prewedding_date', 
                'prewedding_location', 
                'prewedding_category', 
                'prewedding_time',
                'wedding_location',
                'wedding_time'
            ]);
        });
    }
};