<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Payer extends Model
{
    protected $fillable = [
        'name',
    ];

    public function expenses(): BelongsToMany
    {
        return $this->belongsToMany(
            Expense::class,
            'expense_payers',
            'payer_id',
            'expense_id'
        )->using(ExpensePayer::class);
    }
}
