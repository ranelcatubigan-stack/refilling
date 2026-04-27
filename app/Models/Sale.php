<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'item_id',
        'quantity',
        'type',
        'total_price',
        'date',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
