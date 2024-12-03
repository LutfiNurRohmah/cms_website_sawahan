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
        Schema::create('profile_padukuhans', function (Blueprint $table) {
            $table->id();
            $table->text('sejarah')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('struktur_pemerintahan')->nullable();
            $table->string('thumbnail_sejarah')->nullable();
            $table->string('thumbnail_deskripsi')->nullable();
            $table->string('peta_lokasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_padukuhans');
    }
};
