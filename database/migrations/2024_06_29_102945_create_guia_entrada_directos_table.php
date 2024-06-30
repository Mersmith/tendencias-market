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
        Schema::create('guia_entrada_directos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sede_id')->constrained()->onDelete('cascade');
            $table->foreignId('almacen_id')->constrained()->onDelete('cascade');

            $table->enum('estado', ['Aprobado', 'Rechazado', 'Observado', 'Eliminado']);
            $table->text('observacion')->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fecha_entrada');
            $table->boolean('completado')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guia_entrada_directos');
    }
};
