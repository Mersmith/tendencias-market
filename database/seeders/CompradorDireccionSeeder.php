<?php

namespace Database\Seeders;

use App\Models\Comprador;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CompradorDireccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Obtener ids de compradores, departamentos, provincias y distritos
        $compradorIds = Comprador::pluck('id')->toArray();
        $departamentos = Departamento::with('provincias.distritos')->get();

        // Generar direcciones ficticias
        foreach ($compradorIds as $compradorId) {
            foreach (range(1, 2) as $index) {
                // Seleccionar un departamento aleatorio
                $departamento = $faker->randomElement($departamentos);

                // Seleccionar una provincia aleatoria dentro del departamento seleccionado
                $provincia = $faker->randomElement($departamento->provincias);

                // Seleccionar un distrito aleatorio dentro de la provincia seleccionada
                $distrito = $faker->randomElement($provincia->distritos);

                DB::table('comprador_direccions')->insert([
                    'comprador_id' => $compradorId,
                    'recibe_nombres' => $faker->name,
                    'recibe_celular' => $faker->phoneNumber,
                    'departamento_id' => $departamento->id,
                    'provincia_id' => $provincia->id,
                    'distrito_id' => $distrito->id,
                    'direccion' => $faker->streetAddress,
                    'direccion_numero' => $faker->buildingNumber,
                    'opcional' => $faker->optional()->word,
                    'codigo_postal' => $faker->postcode,
                    'instrucciones' => $faker->optional()->sentence,
                    'es_principal' => $index === 1, // La primera dirección para cada comprador será principal
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
