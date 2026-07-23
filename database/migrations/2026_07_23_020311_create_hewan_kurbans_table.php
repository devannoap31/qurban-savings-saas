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
        Schema::create('hewan_kurbans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masjid_id')->constrained('masjids')->onDelete('cascade');
            $table->enum('jenis_hewan', ['Sapi', 'Kambing']);
            $table->string('deskripsi')->nullable();
            $table->integer('harga_total');
            $table->integer('kapasitas_slot');
            $table->integer('target_per_slot');
            $table->integer('slot_terisi')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hewan_kurbans');
    }
};
