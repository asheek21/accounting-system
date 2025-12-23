<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // check if user exist else create user factory
        $user = User::firstWhere('email', 'testuser@gmail.com');

        if (! $user) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'testuser@gmail.com',
            ]);
        }

        Account::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);
    }
}
