<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_name',
        'supplier_id',
        'description',
        'price',
        'quantity',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
