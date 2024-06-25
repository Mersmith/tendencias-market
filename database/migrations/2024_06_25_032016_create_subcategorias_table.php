<?php

use App\Models\Subcategoria;
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
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('categoria_id');

            $table->string('nombre')->unique();
            $table->string('slug')->unique();
            $table->string('descripcion');
            $table->string('icono')->nullable();
            $table->string('imagen_ruta')->nullable();
            $table->enum('activo', [Subcategoria::ACTIVADO, Subcategoria::DESACTIVADO])->default(Subcategoria::DESACTIVADO);

            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategorias');
    }
};
