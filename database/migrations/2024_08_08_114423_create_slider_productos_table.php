<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('slider_productos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();
            $table->string('titulo');
            $table->unsignedBigInteger('almacen_ecommerce_id');
            $table->unsignedBigInteger('lista_precio_etiqueta_id');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->boolean('descuento')->default(false)->comment('1 SI, 0 NO');
            $table->boolean('activo')->default(false)->comment('1 ACTIVADO, 0 DESACTIVADO');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider_productos');
    }
};
