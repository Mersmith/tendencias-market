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
        $this->call(SedeSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(TallaSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(SubcategoriaSeeder::class);     
        $this->call(ProductoSeeder::class);
        $this->call(VariacionSeeder::class);
        $this->call(InventarioSeeder::class);
        $this->call(ListaPrecioSeeder::class);
        $this->call(VariacionListaPreciosSeeder::class);
    }
}
