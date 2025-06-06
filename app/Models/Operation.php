<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable = [
        'card_id_id',
        'type',
        'value',
        'date',
        'debit_type',
        'credit_type',
        'payment_type',
        'payment_reference',
        'order_id',
    ];

    public $timestamps = true;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
