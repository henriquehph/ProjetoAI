<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingCost extends Model
{
    protected $table = 'SETTINGS_SHIPPING_COSTS';

    public $timestamps = false;

    protected $fillable = [
        'min_value_threshold',
        'max_value_threshold',
        'shipping_cost',
    ];
}
