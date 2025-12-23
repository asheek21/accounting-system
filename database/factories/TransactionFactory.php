<?php

namespace Database\Factories;

use App\Enums\TransactionTypeEnum;
use App\Models\Account;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transactionType = $this->faker->randomElement(TransactionTypeEnum::cases());

        return [
            'account_id' => Account::factory(),
            'category_id' => Category::factory(),
            'date' => $this->faker->dateTimeThisYear(),
            'description' => $this->faker->sentence(),
            'notes' => $this->faker->sentence(),
            'transaction_type' => $transactionType,
            'amount' => $this->faker->randomFloat(2, 10, 2000),
        ];
    }
}
