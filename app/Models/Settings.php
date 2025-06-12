<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'membership_fee',
    ];

    public $timestamps = true;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public function getMembershipFeeAttribute($value)
    {
        return $value ?? 100; // 100 is the default membership fee
    }
}
