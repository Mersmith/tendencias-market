<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Producto;
use App\Models\Talla;
use App\Models\Variacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los productos, tallas y colores
        $productos = Producto::all();
        //$tallas = Talla::all();
        //$colores = Color::all();

        $tallas = Talla::take(2)->get();
        $colores = Color::take(2)->get();

        foreach ($productos as $producto) {
            // Caso 1: Producto con variaciones en talla y color
            if ($producto->variacion_talla == 1 && $producto->variacion_color == 1) {
                foreach ($tallas as $talla) {
                    foreach ($colores as $color) {
                        Variacion::create([
                            'producto_id' => $producto->id,
                            'talla_id' => $talla->id,
                            'color_id' => $color->id,
                            'activo' => true,
                        ]);
                    }
                }
            }
            // Caso 2: Producto con variaciones solo en talla
            elseif ($producto->variacion_talla == 1 && !$producto->variacion_color == 1) {
                foreach ($tallas as $talla) {
                    Variacion::create([
                        'producto_id' => $producto->id,
                        'talla_id' => $talla->id,
                        'color_id' => null,
                        'activo' => true,
                    ]);
                }
            }
            // Caso 3: Producto con variaciones solo en color
            elseif (!$producto->variacion_talla == 1 && $producto->variacion_color == 1) {
                foreach ($colores as $color) {
                    Variacion::create([
                        'producto_id' => $producto->id,
                        'talla_id' => null,
                        'color_id' => $color->id,
                        'activo' => true,
                    ]);
                }
            }
            // Caso 4: Producto sin variaciones
            else {
                Variacion::create([
                    'producto_id' => $producto->id,
                    'talla_id' => null,
                    'color_id' => null,
                    'activo' => true,
                ]);
            }
        }
    }
}
