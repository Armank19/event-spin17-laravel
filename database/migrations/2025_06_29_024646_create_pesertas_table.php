<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('peserta', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('id_karyawan')->unique();
        $table->string('email')->nullable();
        $table->string('no_wa')->nullable();
        $table->boolean('status_checkin')->default(false);
        $table->integer('nomor_undian')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }

    
};
