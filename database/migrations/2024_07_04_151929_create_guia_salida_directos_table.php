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
        Schema::create('guia_salida_directos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sede_id')->constrained()->onDelete('cascade');
            $table->foreignId('almacen_id')->constrained()->onDelete('cascade');

            $table->enum('estado', ['Pendiente', 'Aprobado', 'Rechazado', 'Observado', 'Eliminado'])->default('Pendiente');
            $table->text('observacion')->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fecha_salida');
            $table->boolean('completado')->default(false);
            $table->string('serie')->nullable();
            $table->integer('correlativo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guia_salida_directos');
    }
};
