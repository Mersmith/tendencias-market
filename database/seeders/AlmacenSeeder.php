<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Almacen;
use App\Models\Sede;
use Faker\Factory as Faker;

class AlmacenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Sede::all()->each(function ($sede) use ($faker) {
            $numAlmacenes = $faker->numberBetween(1, 2);
            foreach (range(1, $numAlmacenes) as $index) {
                Almacen::create([
                    'sede_id' => $sede->id,
                    'nombre' => 'Almacen ' . $index . ' de ' . $sede->nombre,
                    'ubicacion' => $faker->address,
                ]);
            }
        });
    }
}
