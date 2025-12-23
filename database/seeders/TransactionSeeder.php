<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = Account::all();

        $categories = Category::all();

        foreach ($accounts as $account) {

            // Create random number of transactions per account
            $transactionsCount = rand(5, 15);

            for ($i = 0; $i < $transactionsCount; $i++) {

                Transaction::factory()->create([
                    'account_id' => $account->id,
                    'category_id' => $categories->random()->id,
                ]);

            }
        }
    }
}
