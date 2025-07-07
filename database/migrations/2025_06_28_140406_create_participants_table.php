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
        Schema::create('participants', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama Lengkap Peserta
        $table->string('employee_id')->unique(); // NIP/ID Karyawan, unik
        $table->string('department'); // Departemen/Divisi
        $table->string('email')->unique(); // Email untuk notifikasi
        $table->string('phone_number'); // Nomor Telepon
        $table->text('qr_code_path')->nullable(); // Path untuk menyimpan gambar QR Code
        $table->timestamp('checked_in_at')->nullable(); // Waktu check-in, null jika belum
        $table->boolean('is_winner')->default(false); // Status pemenang undian
        $table->timestamps(); // created_at dan updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
