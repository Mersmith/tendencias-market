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
        Schema::create('variacion_lista_precios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('variacion_id');
            $table->unsignedBigInteger('lista_precio_id');

            $table->decimal('precio', 8, 2);

            $table->foreign('variacion_id')->references('id')->on('variacions')->onDelete('cascade');
            $table->foreign('lista_precio_id')->references('id')->on('lista_precios')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variacion_lista_precios');
    }
};
