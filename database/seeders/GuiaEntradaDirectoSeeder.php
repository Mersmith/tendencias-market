<?php

namespace Database\Seeders;

use App\Models\GuiaEntradaDirecto;
use App\Models\GuiaEntradaDirectoDetalle;
use App\Models\Inventario;
use App\Models\Serie;
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
        GuiaEntradaDirecto::factory(150)->create()->each(function ($guiaEntradaDirecto) {
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

            if ($guiaEntradaDirecto->estado == 'Aprobado') {
                // Obtener la serie con id 3
                $serie = Serie::find(3);

                // Aumentar el correlativo
                $correlativoActualizado = $serie->correlativo + 1;
                $serie->update(['correlativo' => $correlativoActualizado]);

                // Asignar serie y correlativo a la guia_entrada_directo
                $guiaEntradaDirecto->update([
                    'serie' => $serie->nombre,
                    'correlativo' => $correlativoActualizado,
                    'completado' => true,
                ]);

            }
        });
    }
}
