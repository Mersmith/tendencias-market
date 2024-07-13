<?php

use App\Models\Categoria;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();
            $table->string('slug')->unique();
            $table->string('descripcion');
            $table->string('icono')->nullable();
            $table->string('imagen_ruta')->nullable();
            $table->boolean('activo')->default(true)->comment('1 ACTIVADO, 0 DESACTIVADO');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
