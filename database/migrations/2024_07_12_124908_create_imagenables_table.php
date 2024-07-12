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
        Schema::create('imagenables', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('imagen_id');
            $table->unsignedBigInteger('imagenable_id');
            $table->string('imagenable_type');

            $table->foreign('imagen_id')->references('id')->on('imagens')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenables');
    }
};
