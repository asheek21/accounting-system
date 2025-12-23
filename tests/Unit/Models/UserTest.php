<?php

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;

it('has many accounts', function () {
    $user = User::factory()->create();
    $accounts = Account::factory()->count(3)->create(['user_id' => $user->id]);

    expect($user->accounts()->count())->toBe(3);
    expect($user->accounts->pluck('id'))->toContain($accounts->first()->id);
});

it('has many categories', function () {
    $user = User::factory()->create();
    $categories = Category::factory()->count(2)->create(['user_id' => $user->id]);

    expect($user->categories()->count())->toBe(2);
    expect($user->categories->pluck('id'))->toContain($categories->first()->id);
});

it('has many transactions through accounts', function () {
    $user = User::factory()->create();
    $account = Account::factory()->create(['user_id' => $user->id]);
    $transaction = Transaction::factory()->create(['account_id' => $account->id]);

    expect($user->transactions->pluck('id'))->toContain($transaction->id);
});
