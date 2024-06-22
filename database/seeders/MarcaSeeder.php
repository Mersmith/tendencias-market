<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Marca::factory()->count(10)->create();

        $marcas = [
            ['nombre' => 'Adidas'],
            ['nombre' => 'Oster'],
            ['nombre' => 'Canon'],
            ['nombre' => 'Xiomi'],
            ['nombre' => 'Samsung'],
            ['nombre' => 'Rexona'],
            ['nombre' => 'Eucerin'],
            ['nombre' => 'Renzo Costa']
        ];

        foreach ($marcas as $marca) {
            Marca::factory(1)->create($marca);
        }
    }
}
