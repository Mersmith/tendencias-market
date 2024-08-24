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
            $table->text('descripcion');
            $table->string('imagen_ruta')->nullable();
            $table->boolean('variacion_talla')->default(false);
            $table->boolean('variacion_color')->default(false);
            $table->boolean('activo')->default(false)->comment('1 ACTIVADO, 0 DESACTIVADO');

            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->softDeletes(); // Asegura que el campo `deleted_at` se agregue correctamente
            $table->timestamps();
        });

        // Agregar el trigger para prevenir eliminaciones
        DB::unprepared('
          CREATE TRIGGER prevenir_eliminar_producto 
          BEFORE DELETE ON productos
          FOR EACH ROW
          BEGIN
              SIGNAL SQLSTATE "45000" 
              SET MESSAGE_TEXT = "No se permite eliminar registros de la tabla productos.";
          END;
      ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar el trigger antes de eliminar la tabla
        DB::unprepared('DROP TRIGGER IF EXISTS prevenir_eliminar_producto');

        Schema::dropIfExists('productos');
    }
};
