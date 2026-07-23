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
        Schema::create('jemaahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('masjid_id')->constrained('masjids')->onDelete('cascade');
            $table->foreignId('hewan_kurban_id')->constrained('hewan_kurbans')->onDelete('cascade');
            $table->string('nama_jemaah');
            $table->integer('total_saldo')->default(0);
            $table->enum('status', ['Belum Mulai', 'Sedang Menabung', 'Lunas', 'Rollover', 'Batal'])->default('Belum Mulai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jemaahs');
    }
};
