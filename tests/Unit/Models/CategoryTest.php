<?php

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;

it('belongs to a user', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['user_id' => $user->id]);

    expect($category->user->id)->toBe($user->id);
});

it('has many transactions', function () {
    $category = Category::factory()->create();
    $transactions = Transaction::factory()->count(2)->create(['category_id' => $category->id]);

    expect($category->transactions->pluck('id'))->toContain($transactions->first()->id);
    expect($category->transactions)->toHaveCount(2);
});
