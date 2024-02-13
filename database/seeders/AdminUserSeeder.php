<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        $userAdmin = User::create([
            'name' => 'Administrador General',
            'email' => 'admin@erpcollection.com',
            'password' => Hash::make('1234')
        ]);

        $userAdmin->assignRole('admin');

        Person::create([
            'name' => "Administrador",
            'user_id' => $userAdmin->id
        ]);
    }
}
