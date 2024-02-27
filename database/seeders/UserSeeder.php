<?php

namespace Database\Seeders;

use App\Models\IdentityType;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $identityTypes = IdentityType::pluck('id')->toArray();
        $faker = Faker::create();

        $independentUser = User::create([
            'name' => 'Cliente Independiente',
            'email' => 'independiente@erpcollection.com',
            'password' => Hash::make('1234')
        ]);

        $person = $independentUser->person()->create([
            'identification' => $faker->unique()->randomNumber(8, true),
            'name' => $independentUser->name,
            'lastname' => $faker->lastName(),
            'phone' => $faker->e164PhoneNumber(),
            'email' => $independentUser->email,
            'identity_type_id' => $faker->randomElement($identityTypes),
            'user_id' =>  $independentUser->id,
            'token' => $faker->sha256
        ]);

        $person->client()->create([
            'person_id' => $person->id,
            'client_type_id' => 2,
            'user_type_id' => 2,
            'token' => $faker->sha256
        ]);

        $independentUser->assignRole('independent-client');

        User::factory(20)->create();
    }
}
