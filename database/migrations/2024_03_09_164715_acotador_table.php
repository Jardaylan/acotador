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
        Schema::create('acotador', function (Blueprint $table) {
            $table->id();
            $table->string('url_link')->comment('url inicial');
            $table->string('token')->unique()->comment('Indicador unico del link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acotador');
    }
};
