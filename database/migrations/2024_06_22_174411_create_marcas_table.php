<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Marca;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marcas', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();
            $table->string('slug')->unique();
            $table->string('descripcion');
            $table->boolean('activo')->default(false)->comment('1 ACTIVADO, 0 DESACTIVADO');

            $table->softDeletes(); // Asegura que el campo `deleted_at` se agregue correctamente
            $table->timestamps();
        });

        // Agregar el trigger para prevenir eliminaciones
        DB::unprepared('
            CREATE TRIGGER prevenir_eliminar_marca 
            BEFORE DELETE ON marcas
            FOR EACH ROW
            BEGIN
                SIGNAL SQLSTATE "45000" 
                SET MESSAGE_TEXT = "No se permite eliminar registros de la tabla marcas.";
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar el trigger antes de eliminar la tabla
        DB::unprepared('DROP TRIGGER IF EXISTS prevenir_eliminar_marca');

        Schema::dropIfExists('marcas');
    }
};
