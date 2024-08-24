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
        Schema::create('favorito_detalles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('carrito_id');
            $table->unsignedBigInteger('variacion_id');

            $table->foreign('carrito_id')->references('id')->on('carritos')->onDelete('cascade');
            $table->foreign('variacion_id')->references('id')->on('variacions')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorito_detalles');
    }
};
