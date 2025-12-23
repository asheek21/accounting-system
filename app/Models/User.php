<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * User has many accounts
     */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    /**
     * User has many categories
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * User has many transactions through accounts
     */
    public function transactions()
    {
        return $this->hasManyThrough(
            Transaction::class,
            Account::class,
            'user_id',
            'account_id',
            'id',
            'id'
        );
    }

    /**
     * Total income for user
     */
    public function getTotalIncomeAttribute()
    {
        return $this->transactions()
            ->where('transaction_type', TransactionTypeEnum::income)
            ->sum('amount');
    }

    /**
     * Total expenses for user
     */
    public function getTotalExpensesAttribute()
    {
        return $this->transactions()
            ->where('transaction_type', TransactionTypeEnum::expense)
            ->sum('amount');
    }
}
