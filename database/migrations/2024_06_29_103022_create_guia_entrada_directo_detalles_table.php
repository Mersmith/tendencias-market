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
        Schema::create('guia_entrada_directo_detalles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('guia_entrada_directo_id')->constrained()->onDelete('cascade');
            $table->foreignId('variacion_id')->constrained()->onDelete('cascade');
            
            $table->integer('stock');
            $table->integer('stock_minimo')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guia_entrada_directo_detalles');
    }
};
