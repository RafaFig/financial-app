<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ExpensePayer extends Pivot
{
    protected $fillable = [
        'expense_id',
        'payer_id'
    ];
}
