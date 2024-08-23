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
        Schema::create('comprador_direccions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('comprador_id'); // Clave foránea a la tabla compradors
            $table->string('recibe_nombres');
            $table->string('recibe_celular');

            // Claves foráneas a departamentos, provincias, y distritos
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('provincia_id');
            $table->unsignedBigInteger('distrito_id');

            $table->string('direccion');
            $table->string('direccion_numero');
            $table->string('opcional')->nullable();
            $table->string('codigo_postal');
            $table->string('instrucciones')->nullable();
            $table->boolean('es_principal')->default(false); // Para marcar si es la dirección principal del comprador

            $table->foreign('comprador_id')->references('id')->on('compradors')->onDelete('cascade');

            // Claves foráneas con las otras tablas
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade');
            $table->foreign('provincia_id')->references('id')->on('provincias')->onDelete('cascade');
            $table->foreign('distrito_id')->references('id')->on('distritos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprador_direccions');
    }
};
