<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    protected $fillable = [
        'category_id',
        'account_id',
        'name',
        'description',
        'amount',
        'net_amount',
        'periodicity',
    ];

    protected $casts = [
        'amount' => 'float',
        'net_amount' => 'float'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
