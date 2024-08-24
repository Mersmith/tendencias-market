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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->enum('estado', ['pendiente', 'observado', 'cancelado', 'despacho', 'enviado', 'entregado', 'conforme'])->default('pendiente');
            $table->enum('tipo_entrega', ['tienda', 'delivery'])->default('delivery');
            $table->decimal('total', 10, 2);
            $table->decimal('costo_envio', 10, 2)->default(0);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->enum('tipo_pago', ['online', 'contraentrega'])->default('online');
            $table->enum('metodo_pago', ['tarjeta_credito', 'tarjeta_debito', 'transferencia_bancaria', 'efectivo', 'paypal', 'otros'])->nullable();
            $table->timestamp('fecha_venta');
            $table->timestamp('fecha_entrega')->nullable();
            $table->unsignedBigInteger('cupon_id')->nullable();
            $table->unsignedBigInteger('comprador_direccion_id')->nullable();
            $table->text('comentarios')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('comprador_direccion_id')->references('id')->on('comprador_direccions')->onDelete('set null');
            $table->foreign('cupon_id')->references('id')->on('cupons')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
