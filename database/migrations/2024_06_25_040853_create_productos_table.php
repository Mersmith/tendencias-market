<?php

use App\Models\Producto;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('categoria_id');

            $table->string('nombre')->unique();
            $table->string('slug')->unique();
            $table->string('descripcion');
            $table->string('imagen_ruta')->nullable();
            $table->boolean('variacion_talla')->default(false);
            $table->boolean('variacion_color')->default(false);
            $table->boolean('activo')->default(false)->comment('1 ACTIVADO, 0 DESACTIVADO');

            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
