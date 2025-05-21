<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supply_order extends Model
{
    protected $fillable = [
        'product_id',
        'registered_by_user_id',
        'status',
        'quantity',
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
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
