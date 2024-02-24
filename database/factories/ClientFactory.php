<?php

namespace Database\Factories;

use App\Models\ClientType;
use App\Models\Person;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $personIds = Person::pluck('id')->toArray();
        $clientsTypesIds = ClientType::pluck('id')->toArray();
        $userTypeIds = UserType::pluck('id')->toArray();

        return [
            'person_id' => $this->faker->randomElement($personIds),
            'client_type_id' => $this->faker->randomElement($clientsTypesIds),
            'user_type_id' => $this->faker->randomElement($userTypeIds),
            'token' => $this->faker->sha256
        ];
    }
}
