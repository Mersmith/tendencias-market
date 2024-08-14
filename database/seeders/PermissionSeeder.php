<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view_users',
            'edit_users',
            'delete_users',
            'view_roles',
            'edit_roles',
            'delete_roles',
            // Agrega más permisos según tus necesidades
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'description' => 'Permiso para ' . str_replace('_', ' ', $permission)]);
        }

        // Asignar permisos a roles
        $adminRole = Role::where('name', 'admin')->first();
        $vendedorRole = Role::where('name', 'vendedor')->first();
        $compradorRole = Role::where('name', 'comprador')->first();

        // Asignar todos los permisos al rol de administrador
        $adminRole->permissions()->attach(Permission::all());

        // Asignar algunos permisos al rol de vendedor
        $vendedorRole->permissions()->attach(
            Permission::whereIn('name', ['view_users', 'view_roles'])->get()
        );

        // Asignar solo el permiso de ver usuarios al rol de comprador
        $compradorRole->permissions()->attach(
            Permission::where('name', 'view_users')->first()
        );
    }
}
