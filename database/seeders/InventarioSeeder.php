<?php

namespace Database\Seeders;

use App\Models\Almacen;
use App\Models\Inventario;
use App\Models\Variacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Almacen::all()->each(function ($almacen) use ($faker) {
            Variacion::all()->each(function ($variacion) use ($almacen, $faker) {
                Inventario::create([
                    'almacen_id' => $almacen->id,
                    'variacion_id' => $variacion->id,
                    'stock' => $faker->numberBetween(0, 100),
                    'stock_minimo' => $faker->numberBetween(0, 10),
                ]);
            });
        });
    }
}
