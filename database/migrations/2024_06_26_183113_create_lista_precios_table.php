<?php

use App\Models\ListaPrecio;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lista_precios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();
            $table->enum('activo', [ListaPrecio::ACTIVADO, ListaPrecio::DESACTIVADO])->default(ListaPrecio::DESACTIVADO);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_precios');
    }
};
