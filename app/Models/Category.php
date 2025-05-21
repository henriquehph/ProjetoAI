<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'image',
    ];

    public $timestamps = true;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    //Relação com a tabela products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
