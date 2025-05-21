<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'member_id',
        'status',
        'date',
        'total_items',
        'shipping_cost',
        'total',
        'nif',
        'delivery_address',
        'pdf_receipt',
        'cancel_reason',
    ];

    public $timestamps = true;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    //Relação com a tabela Item_orders
    public function item_order()
    {
        return $this->HasMany(Item_order::class);
    }
    //Relação com a tabela operation
    public function operation()
    {
        return $this->HasMany(Operation::class);
    }
    //Relação com a tabela users
    public function user()
    {
        return $this->HasMany(User::class);
    }
}
