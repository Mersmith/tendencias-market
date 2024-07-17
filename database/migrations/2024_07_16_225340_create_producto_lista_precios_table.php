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
        Schema::create('producto_lista_precios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('lista_precio_id');

            $table->decimal('precio', 8, 2);
            $table->decimal('precio_antiguo', 8, 2)->nullable();
            $table->string('simbolo')->default('S/');

            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('lista_precio_id')->references('id')->on('lista_precios')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_lista_precios');
    }
};
