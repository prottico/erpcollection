<?php

namespace Database\Factories;

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
        return [
            'credit_start_date' => $this->faker->date(),
            'debt_capital' => $this->faker->randomNumber(),
            'term' => $this->faker->date(),
            'current_interest_rate' => $this->faker->randomNumber(),
            'default_interest_rate' => $this->faker->randomNumber(),
            'interest_owed' => $this->faker->randomNumber(),
            'last_payment_day' => $this->faker->date(),
            'currency' => $this->faker->currencyCode(),
            'base_execution_document' => $this->faker->text(15),
            'path_base_execution_document' => $this->faker->imageUrl(),
            'description' => $this->faker->text(50),
            'comments' => $this->faker->text(30),
        ];
    }
}
