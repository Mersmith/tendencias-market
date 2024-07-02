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
        Schema::create('series', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sede_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipo_documento_id')->constrained()->onDelete('cascade');
            
            $table->string('nombre');
            $table->integer('correlativo')->default(0);
            $table->text('descripcion')->nullable();
            $table->boolean('activo')->default(true)->comment('1 ACTIVADO, 0 DESACTIVADO');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
