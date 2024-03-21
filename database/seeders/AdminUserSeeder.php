<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Admin user
        $userAdmin = User::create([
            'name' => 'Administrador General',
            'email' => 'admin@erpcollection.com',
            'password' => Hash::make('1234')
        ]);

        $userAdmin->assignRole('general-admin');

        Person::create([
            'name' => "Administrador",
            'user_id' => $userAdmin->id,
            'token' => $faker->sha256,
        ]);
    }
}
