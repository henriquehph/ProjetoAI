<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items_order extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'discount',
        'subtotal',
    ];

    public $timestamps = true;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    //Relação com a tabela products
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
    //Relação com a tabela orders
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
    //Cálculo do valor do subtotal
    public function subtotal()
    {
        return $this->quantity * $this->unit_price - $this->discount;
    }
}
