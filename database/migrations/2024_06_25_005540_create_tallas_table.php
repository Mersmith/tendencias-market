<?php

use App\Models\Talla;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tallas', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->unique();
            $table->enum('activo', [Talla::ACTIVADO, Talla::DESACTIVADO])->default(Talla::DESACTIVADO);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tallas');
    }
};
