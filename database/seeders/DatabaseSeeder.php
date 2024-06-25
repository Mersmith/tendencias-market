<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MarcaSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(TallaSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(SubcategoriaSeeder::class);
        $this->call(ProductoSeeder::class);
        //$this->call(VariacionSeeder::class);
    }
}
