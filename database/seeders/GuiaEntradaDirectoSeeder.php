<?php

namespace Database\Seeders;

use App\Models\GuiaEntradaDirecto;
use App\Models\GuiaEntradaDirectoDetalle;
use App\Models\Variacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuiaEntradaDirectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GuiaEntradaDirecto::factory(10)->create()->each(function ($guiaEntradaDirecto) {
            // Obtener todas las variaciones y mezclarlas
            $variaciones = Variacion::inRandomOrder()->get();

            // Limitar el número de detalles a la cantidad de variaciones disponibles
            $detalleCount = min(5, $variaciones->count());

            // Crear detalles únicos para cada GuiaEntradaDirecto
            for ($i = 0; $i < $detalleCount; $i++) {
                GuiaEntradaDirectoDetalle::factory()->create([
                    'guia_entrada_directo_id' => $guiaEntradaDirecto->id,
                    'variacion_id' => $variaciones[$i]->id,
                ]);
            }
        });
    }
}
