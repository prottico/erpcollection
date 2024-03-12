<?php

namespace Database\Factories;

use App\Models\IdentityType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $identityTypes = IdentityType::pluck('id')->toArray();
        return [
            // 'physical_client' => $this->faker->address(),
            'identification' => $this->faker->unique()->randomNumber(8, true),
            'name' => $this->faker->name(),
            'lastname' => $this->faker->lastName(),
            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'associated_company' => $this->faker->company(),
            // 'comercial_name' => $this->faker->company(),
            'identity_type_id' => $this->faker->randomElement($identityTypes),
            'user_id' =>  $this->faker->randomElement($userIds),
            'token' => $this->faker->sha256
        ];
    }
}
