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
    Schema::table('bookings', function (Blueprint $table) {
        // 1. Mengubah user_id menjadi nullable agar bisa booking tanpa login
        $table->foreignId('user_id')->nullable()->change();

        // 2. Menambahkan kolom detail pengantin & domisili
        // Kita letakkan setelah package_id agar struktur tabel tetap rapi
        $table->string('customer_name')->after('package_id')->comment('Nama Lengkap Pengantin');
        $table->string('customer_phone')->after('customer_name')->comment('Nomor WhatsApp');
        $table->string('customer_email')->after('customer_phone')->comment('Email Invoice/Kontrak');
        $table->text('customer_address')->after('customer_email')->comment('Alamat/Domisili');
    });
}

public function down(): void
{
    Schema::table('bookings', function (Blueprint $table) {
        // Kembalikan ke asal jika migration di-rollback
        $table->foreignId('user_id')->nullable(false)->change();
        $table->dropColumn(['customer_name', 'customer_phone', 'customer_email', 'customer_address']);
    });
}
};
