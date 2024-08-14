<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin'], ['description' => 'Administrador del sistema']);
        $vendedorRole = Role::firstOrCreate(['name' => 'vendedor'], ['description' => 'Usuario vendedor o tienda']);
        $compradorRole = Role::firstOrCreate(['name' => 'comprador'], ['description' => 'Usuario comprador']);

        // Crear 10 usuarios con el rol de administrador
        for ($i = 1; $i <= 10; $i++) {
            User::factory()->create([
                'name' => 'Administrador ' . $i,
                'email' => 'admin' . $i . '@example.com',
                'password' => bcrypt('123'),
            ])->roles()->attach($adminRole);
        }

        // Crear 10 usuarios con el rol de vendedor
        for ($i = 1; $i <= 10; $i++) {
            User::factory()->create([
                'name' => 'Vendedor ' . $i,
                'email' => 'vendedor' . $i . '@example.com',
                'password' => bcrypt('1234'),
            ])->roles()->attach($vendedorRole);
        }

        // Crear 10 usuarios con el rol de comprador
        for ($i = 1; $i <= 10; $i++) {
            User::factory()->create([
                'name' => 'Comprador ' . $i,
                'email' => 'comprador' . $i . '@example.com',
                'password' => bcrypt('12345'),
            ])->roles()->attach($compradorRole);
        }

        // Crear más usuarios aleatorios
        User::factory(10)->create();
    }
}
