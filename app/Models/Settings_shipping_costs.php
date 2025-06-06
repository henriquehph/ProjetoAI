<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings_shipping_costs extends Model
{
    protected $fillable = [
        'min_value_threshold',
        'max_value_threshold',
        'shipping_cost',
    ];

    public $timestamps = true;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public static function getShippingCostForTotal(float $total): float
    {
        return self::where('min_value_threshold', '<=', $total)
        ->where('max_value_threshold', '>', $total)
        ->value('shipping_cost') ?? 0;
    }

}
