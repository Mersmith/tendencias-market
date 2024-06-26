<?php

namespace Database\Seeders;

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
        $variaciones = Variacion::all();

        foreach ($variaciones as $variacion) {
            Inventario::create([
                'variacion_id' => $variacion->id,
                'stock' => $faker->numberBetween(0, 100),
                'stock_minimo' => $faker->numberBetween(5, 10),
            ]);
        }
    }
}
