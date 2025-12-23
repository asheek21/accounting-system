<?php

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;

it('belongs to a user', function () {
    $user = User::factory()->create();
    $account = Account::factory()->create(['user_id' => $user->id]);

    expect($account->user->id)->toBe($user->id);
});

it('has many transactions', function () {
    $account = Account::factory()->create();
    $transactions = Transaction::factory()->count(3)->create(['account_id' => $account->id]);

    expect($account->transactions->pluck('id'))->toContain($transactions->first()->id);
    expect($account->transactions)->toHaveCount(3);
});
