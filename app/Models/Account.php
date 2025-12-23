<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getBalanceAttribute()
    {
        $income = $this->transactions()
            ->where('type', 'income')
            ->sum('amount');

        $expense = $this->transactions()
            ->where('type', 'expense')
            ->sum('amount');

        return $income - $expense;
    }

    public function getAccountNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setAccountNameAttribute($value)
    {
        $this->attributes['account_name'] = strtolower($value);
    }
}
