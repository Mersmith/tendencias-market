<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\ProductoDescuento;
use App\Models\Variacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListaPrecio;
use Faker\Factory as Faker;
use Carbon\Carbon;
class ProductoDescuentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Obtener 50 variaciones aleatorias
        $productos = Producto::inRandomOrder()->take(50)->get();

        // Obtener 50 listas de precios aleatorias
        $listaPrecios = ListaPrecio::inRandomOrder()->take(50)->get();

        foreach ($productos as $producto) {
            foreach ($listaPrecios as $listaPrecio) {
                ProductoDescuento::create([
                    'producto_id' => $producto->id,
                    'lista_precio_id' => $listaPrecio->id,
                    'porcentaje_descuento' => $faker->numberBetween(5, 50),
                    'fecha_fin' => Carbon::now()->addDays($faker->numberBetween(1, 30))
                ]);
            }
        }
    }
}
