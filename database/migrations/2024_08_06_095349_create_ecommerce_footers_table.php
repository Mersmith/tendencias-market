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
        Schema::create('ecommerce_footers', function (Blueprint $table) {
            $table->id();

            $table->json('enlaces_rapidos');
            $table->json('redes_sociales');
            $table->json('terminos');
            $table->string('derechos');
            $table->string('direccion');
            $table->boolean('activo')->default(false)->comment('1 ACTIVADO, 0 DESACTIVADO');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecommerce_footers');
    }
};
