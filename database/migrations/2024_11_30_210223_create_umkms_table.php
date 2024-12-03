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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail')->nullable();
            $table->string('umkm_name');
            $table->string('owner');
            $table->string('slug')->unique();
            $table->foreignId('umkm_category_id')->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('maps')->nullable();
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
        Schema::dropIfExists('umkms');
    }
};
