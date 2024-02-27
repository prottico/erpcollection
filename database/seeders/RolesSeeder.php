<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Colección de roles
        $roles = [
            ['name' => 'general-admin', 'guard_name' => 'web', 'label' => 'Administrador'],
            ['name' => 'independent-client', 'guard_name' => 'web', 'label' => 'Cliente Independiente']
        ];

        // Crear un registro para cada rol
        foreach ($roles as $role) {
            Role::updateOrCreate(
                [
                    'name' => $role['name'],
                    'guard_name' => $role['guard_name'],
                    'label' => $role['label'],
                ]
            );
        }
    }
}
