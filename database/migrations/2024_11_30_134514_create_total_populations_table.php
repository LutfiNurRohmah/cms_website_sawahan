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
        Schema::create('total_populations', function (Blueprint $table) {
            $table->id();
            $table->string('rt_name');
            $table->integer('total_population')->default(0);
            $table->integer('total_kk')->default(0);
            $table->integer('total_male')->default(0);
            $table->integer('total_female')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_populations');
    }
};
