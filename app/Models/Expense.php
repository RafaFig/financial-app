<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Expense extends Model
{
    protected $fillable = [
        'category_id',
        'account_id',
        'name',
        'description',
        'total_amount',
        'status',
        'payment_method',
        'periodicity',
        'installments',
        'start_date',
    ];

    protected $casts = [
        'total_amount' => 'float',
        'start_date' => 'date'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function payers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'expense_users',
            'expense_id',
            'user_id'
        )->using(ExpenseUser::class);
    }
}
