<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'stock',
        'description',
        'photo',
        'discount_min_qty',
        'discount',
        'stock_lower_limit',
        'stock_upper_limit',
    ];
    //id chave primária, incrementável do tipo int,
    //created_at e updated_at gerigos automaticamente
    public $timestamps = true;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    //Relação com a tabela categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //Relação com a tabela items_order
    public function items_order()
    {
        return $this->hasMany(Items_order::class);
    }
    //Relação com a tabela stock_adjustments
    public function stock_adjustments()
    {
        return $this->hasMany(Stock_adjustment::class);
    }
    //Relação com a tabela stock_adjustments
    public function supply_orders()
    {
        return $this->hasMany(Supply_order::class);
    }
    //Alerta para stock minimo
    public function StockLow(): bool
    {
        return $this->stock <= $this->stock_lower_limit;
    }
}
