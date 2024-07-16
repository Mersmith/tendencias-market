<?php

namespace Database\Seeders;

use App\Models\Descuento;
use App\Models\Variacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListaPrecio;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DescuentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Obtener 50 variaciones aleatorias
        $variaciones = Variacion::inRandomOrder()->take(50)->get();

        // Obtener 50 listas de precios aleatorias
        $listaPrecios = ListaPrecio::inRandomOrder()->take(50)->get();

        foreach ($variaciones as $variacion) {
            foreach ($listaPrecios as $listaPrecio) {
                Descuento::create([
                    'variacion_id' => $variacion->id,
                    'lista_precio_id' => $listaPrecio->id,
                    'porcentaje_descuento' => $faker->numberBetween(5, 50),
                    'fecha_fin' => Carbon::now()->addDays($faker->numberBetween(1, 30))
                ]);
            }
        }
    }
}
