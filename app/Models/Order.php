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
        return $this->HasMany(Items_order::class);
    }
    //Relação com a tabela operation
    public function operation()
    {
        return $this->HasMany(Operation::class);
    }
    //Relação com a tabela users
    public function user()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function getTotalOrdersAttribute($filter, $userId)
    {
        return $this->compareOrders($filter)->where('id')->count();
    }

    public function getMostExpensiveOrder($filter, $userId)
    {
        return $this->compareOrders($filter)->where('id')->orderBy('total', 'desc')->first();
    }
    public function getCheapestOrder($filter, $userId)
    {
        return $this->compareOrders($filter)->where('id')->orderBy('total', 'asc')->first();
    }
    public function getAverageMoneySpentOnOrder($filter, $userId)
    {
        return $this->compareOrders($filter)->where('id')->average('total');
    }

    public function getAverageProductsPerOrder($filter)
    {
        return $this->compareOrders($filter)->where('id')->average('total_items');
    }
    public function compareOrders($filter)
    {
        if ($filter == 'Month') {
            return $this->orders()->whereMonth('created_at', now()->month);
        } elseif ($filter == 'Year') {
            return $this->orders()->whereYear('created_at', now()->year);
        } else {
            return $this->orders();
        }
    }
}
