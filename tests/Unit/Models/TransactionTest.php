<?php

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;

it('belongs to an account', function () {
    $account = Account::factory()->create();
    $transaction = Transaction::factory()->create(['account_id' => $account->id]);

    expect($transaction->account->id)->toBe($account->id);
});

it('belongs to a category if assigned', function () {
    $category = Category::factory()->create();
    $transaction = Transaction::factory()->create(['category_id' => $category->id]);

    expect($transaction->category->id)->toBe($category->id);
});
