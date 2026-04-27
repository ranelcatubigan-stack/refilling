<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
protected $fillable = [        
    'user_id',             
    'item_id',
    'maintenance_quantity',
    'start_date',
    'end_date',
    'cost',
    ];

public function user()
    {
    return $this->belongsTo(\App\Models\User::class);
    }

public function item()
    {
    return $this->belongsTo(\App\Models\Item::class);
    }
}