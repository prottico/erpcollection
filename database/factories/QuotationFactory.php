<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\TypePayment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quotation>
 */
class QuotationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clientsIds = Client::whereNotIn('person_id', [1, 2])->pluck('id')->toArray();
        $typePaymentIds = TypePayment::pluck('id')->toArray();

        return [
            'credit_start_date' =>  \Carbon\Carbon::parse($this->faker->dateTime()->format('d-m-Y')),
            'debt_capital' => $this->faker->randomFloat(2, 0, 10000),
            'term' => $this->faker->numberBetween(1, 30) . ' días',
            'current_interest_rate' => $this->faker->randomFloat(2, 0, 100),
            'default_interest_rate' => $this->faker->randomFloat(2, 0, 100),
            'interest_owed' => $this->faker->randomFloat(2, 0, 10000),
            'last_payment_day' =>  \Carbon\Carbon::parse($this->faker->dateTime()->format('d-m-Y')),
            'currency' => $this->faker->currencyCode(),
            'base_execution_document' => $this->faker->text(15),
            'path_base_execution_document' => $this->faker->imageUrl(),
            'description' => $this->faker->text(50),
            'comments' => $this->faker->text(30),
            'client_id' => $this->faker->randomElement($clientsIds),
            'type_payment_id' => $this->faker->randomElement($typePaymentIds),
            'token' => $this->faker->sha256
        ];
    }
}
