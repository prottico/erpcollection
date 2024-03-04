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

        // Creacion de un cliente independiente
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
            'token' => $faker->sha256,
            'associated_company' => $faker->company()
        ]);

        $person->client()->create([
            'person_id' => $person->id,
            'client_type_id' => 2,
            'user_type_id' => 2,
            'token' => $faker->sha256,
        ]);

        $independentUser->assignRole('independent-client');

        // Creacion de un cliente compañía
        $companyUser = User::create([
            'name' => 'Cliente Compañía',
            'email' => 'company@erpcollection.com',
            'password' => Hash::make('1234')
        ]);

        $company = $companyUser->person()->create([
            'identification' => $faker->unique()->randomNumber(8, true),
            'name' => $companyUser->name,
            'lastname' => $faker->lastName(),
            'phone' => $faker->e164PhoneNumber(),
            'email' => $companyUser->email,
            'identity_type_id' => $faker->randomElement($identityTypes),
            'user_id' =>  $companyUser->id,
            'token' => $faker->sha256,
            'associated_company' => $faker->company(),
        ]);

        $company->client()->create([
            'person_id' => $company->id,
            'client_type_id' => 1,
            'user_type_id' => 1,
            'token' => $faker->sha256,
        ]);

        $companyUser->assignRole('company-client');

        // Cracion de un abogado
        $lawyerUser = User::create([
            'type_user_id' => 3,
            'name' => 'Abogado de prueba',
            'email' => 'abogado@erpcollection.com',
            'password' => Hash::make('1234')
        ]);

        $lawyerUser->person()->create([
            'identification' => $faker->unique()->randomNumber(8, true),
            'name' => $lawyerUser->name,
            'lastname' => $faker->lastName(),
            'phone' => $faker->e164PhoneNumber(),
            'email' => $lawyerUser->email,
            'identity_type_id' => $faker->randomElement($identityTypes),
            'user_id' =>  $lawyerUser->id,
            'token' => $faker->sha256
        ]);

        $lawyerUser->assignRole('lawyer');

        User::factory(20)->create();
    }
}
