<?php

namespace Database\Factories;

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
        return [
            'physical_client' => $this->faker->address(),
            'identification' => $this->faker->unique()->randomNumber(8, true),
            'name' => $this->faker->name(),
            'lastname' => $this->faker->lastName(),
            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'associated_company' => $this->faker->company(),
            'identity_type' => $this->faker->randomElement(['1', '2']),
            'user_id' => null,
        ];
    }
}
