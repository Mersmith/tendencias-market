<?php

namespace Database\Seeders;

use App\Models\GuiaEntradaDirecto;
use App\Models\GuiaEntradaDirectoDetalle;
use App\Models\Inventario;
use App\Models\Variacion;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuiaEntradaDirectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        GuiaEntradaDirecto::factory(10)->create()->each(function ($guiaEntradaDirecto) {
            // Obtener todas las variaciones y mezclarlas
            $variaciones = Variacion::inRandomOrder()->get();

            // Limitar el número de detalles a la cantidad de variaciones disponibles
            $detalleCount = min(5, $variaciones->count());

            // Crear detalles únicos para cada GuiaEntradaDirecto
            for ($i = 0; $i < $detalleCount; $i++) {
                $detalle = GuiaEntradaDirectoDetalle::factory()->create([
                    'guia_entrada_directo_id' => $guiaEntradaDirecto->id,
                    'variacion_id' => $variaciones[$i]->id,
                ]);

                // Si la guía de entrada directo está aprobada, actualizar inventario
                if ($guiaEntradaDirecto->estado == 'Aprobado') {
                    $inventario = Inventario::updateOrCreate(
                        [
                            'almacen_id' => $guiaEntradaDirecto->almacen_id,
                            'variacion_id' => $detalle->variacion_id,
                        ],
                        [
                            'stock' => DB::raw('stock + ' . $detalle->stock),
                            'stock_minimo' => DB::raw('stock_minimo + ' . $detalle->stock_minimo),
                        ]
                    );
                }
            }

            // Actualizar el estado de completado en la guía de entrada directo
            if ($guiaEntradaDirecto->estado == 'Aprobado') {
                $guiaEntradaDirecto->completado = true;
                $guiaEntradaDirecto->save();
            }
        });
    }
}
