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
        /*$this->call(UserSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(SedeSeeder::class);
        $this->call(AlmacenSeeder::class);
        $this->call(TipoDocumentoSeeder::class);
        $this->call(SerieSeeder::class);*/
        $this->call(CategoriaSeeder::class);
        /*$this->call(MarcaSeeder::class);
        $this->call(CategoriaMarcaSeeder::class);
        $this->call(TallaSeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(ProductoSeeder::class);
        $this->call(VariacionSeeder::class);
        //$this->call(InventarioSeeder::class);//Ahora se agrega stock con GuiaEntradaDirectoSeeder
        $this->call(ListaPrecioSeeder::class);
        $this->call(ProductoListaPreciosSeeder::class);
        $this->call(ProductoDescuentoSeeder::class);
        $this->call(GuiaEntradaDirectoSeeder::class);
        $this->call(ImagenSeeder::class);
        $this->call(ImagenablesSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(MostradorSeeder::class);
        $this->call(VitrinaSeeder::class);
        $this->call(AvisoSeeder::class);
        $this->call(GridSeeder::class);
        $this->call(TemporizadorSeeder::class);
        $this->call(SliderProductosSeeder::class);
        $this->call(EnlacesRapidosSeeder::class);
        $this->call(EcommerceFooterSeeder::class);*/
    }
}
