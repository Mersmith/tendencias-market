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
        Schema::create('transferencia_almacens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sede_origen_id')->constrained('sedes')->onDelete('cascade');
            $table->foreignId('almacen_origen_id')->constrained('almacens')->onDelete('cascade');
            $table->foreignId('sede_destino_id')->constrained('sedes')->onDelete('cascade');
            $table->foreignId('almacen_destino_id')->constrained('almacens')->onDelete('cascade');

            $table->enum('estado', ['Pendiente', 'Aprobado', 'Rechazado', 'Observado', 'Eliminado'])->default('Pendiente');
            $table->text('observacion')->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fecha_transferencia');
            $table->boolean('completado')->default(false);
            $table->string('serie_origen')->nullable();
            $table->integer('correlativo_origen')->nullable();
            $table->string('serie_destino')->nullable();
            $table->integer('correlativo_destino')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transferencia_almacens');
    }
};
