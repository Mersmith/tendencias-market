<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class CuponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            // Decide whether to use a fixed discount or a percentage discount
            $useFixedDiscount = $faker->boolean(50); // 50% chance to use fixed discount

            DB::table('cupons')->insert([
                'codigo' => $faker->unique()->word . '-' . $faker->unique()->numberBetween(1000, 9999),
                'descuento' => $useFixedDiscount ? $faker->randomFloat(2, 5, 50) : null, // Monto fijo de descuento, opcional
                'porcentaje_descuento' => $useFixedDiscount ? null : $faker->numberBetween(5, 50), // Descuento en porcentaje, opcional
                'monto_minimo' => $faker->optional()->randomFloat(2, 50, 200), // Monto mínimo de compra, opcional
                'usos_totales' => $faker->numberBetween(1, 10),
                'usos_restantes' => $faker->numberBetween(0, 10),
                'fecha_inicio' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'fecha_expiracion' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
                'tipo_descuento' => $faker->randomElement(['general', 'primer compra']),
                'activo' => $faker->boolean(80), // 80% de probabilidad de ser activo
            ]);
        }
    }
}
