<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_name',
        'contact_number',
        'email_address',
        'street_address',
        'barangay',
        'city',
        'region',
        'zip_code',
        'country',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
