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
        Schema::create('potensi_padukuhans', function (Blueprint $table) {
            $table->id();
            $table->string('category')->unique();
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->text('description');
            $table->json('tags')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('potensi_padukuhans');
    }
};
