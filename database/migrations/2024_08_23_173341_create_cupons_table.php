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
        Schema::create('cupons', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->unique(); // Código único del cupón
            $table->decimal('descuento', 8, 2)->nullable(); // Monto fijo de descuento
            $table->integer('porcentaje_descuento')->nullable(); // Descuento en porcentaje (0-100)
            $table->decimal('monto_minimo', 10, 2)->nullable(); // Monto mínimo de compra para aplicar el cupón
            $table->integer('usos_totales')->default(1); // Número total de usos permitidos
            $table->integer('usos_restantes')->default(1); // Número de usos restantes
            $table->date('fecha_inicio')->nullable(); // Fecha desde la cual el cupón es válido
            $table->date('fecha_expiracion')->nullable(); // Fecha de expiración del cupón
            $table->string('tipo_descuento')->default('general'); // Tipo de descuento (general, primer compra, etc.)
            $table->boolean('activo')->default(true); // Estado del cupón (activo/inactivo)

            // Nuevos campos para asignar a productos o categorías
            $table->unsignedBigInteger('producto_id')->nullable(); // ID del producto específico
            $table->unsignedBigInteger('categoria_id')->nullable(); // ID de la categoría
            $table->enum('aplicacion', ['general', 'producto', 'categoria'])->default('general'); // Tipo de aplicación del cupón

            $table->timestamps(); // Timestamps para created_at y updated_at

            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('set null');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupons');
    }
};
