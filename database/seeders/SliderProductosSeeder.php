<?php

namespace Database\Seeders;

use App\Models\SliderProductos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slider_productos = [
            [
                'nombre' => 'Slider1',
                'titulo' => 'Productos novedosos',
                'almacen_ecommerce_id' => 1,
                'lista_precio_etiqueta_id' => 3,
                'categoria_id' => 1,
                'descuento' => false,
                'activo' => true
            ],
            [
                'nombre' => 'Slider2',
                'titulo' => 'Productos en descuentos',
                'almacen_ecommerce_id' => 1,
                'lista_precio_etiqueta_id' => 3,
                'categoria_id' => null,
                'descuento' => true,
                'activo' => true
            ]
        ];

        foreach ($slider_productos as $item) {
            SliderProductos::create($item);
        }
    }
}
