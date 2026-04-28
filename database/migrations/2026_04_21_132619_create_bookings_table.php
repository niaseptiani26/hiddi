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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();

        // user_id dibuat nullable agar pelanggan tidak wajib login/punya akun
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->foreignId('package_id')->constrained()->cascadeOnDelete();

        // Data Diri Pelanggan (Penting karena tidak login)
        $table->string('customer_name');
        $table->string('customer_phone'); // Untuk WhatsApp
        $table->string('customer_email');

        $table->date('booking_date');
        // Start & End time bisa diisi manual atau otomatis dari durasi paket nanti
        $table->time('start_time')->nullable(); 
        $table->time('end_time')->nullable();

        $table->enum('payment_type', ['dp','full']);

        $table->decimal('total_price', 15, 2); // 15 digit agar lebih aman untuk angka jutaan
        $table->decimal('amount_paid', 15, 2)->default(0);
        $table->decimal('remaining', 15, 2)->default(0);

        $table->enum('status', [
            'pending',    // Menunggu bukti bayar
            'dp_paid',    // Sudah bayar DP
            'paid',       // Sudah Lunas
            'completed',  // Acara Selesai
            'cancelled'   // Dibatalkan
        ])->default('pending');

        $table->timestamp('expired_at')->nullable(); // Batas waktu transfer
        $table->text('notes')->nullable();

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
