<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock_adjustment extends Model
{
    protected $fillable = [
        'product_id',
        'registered_by_user_id',
        'quantity_changed',
    ];
    //id chave primária, incrementável do tipo int,
    //created_at e updated_at gerigos automaticamente
    public $timestamps = true;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    //Relação com a tabela products
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
    //Relação com a tabela users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
