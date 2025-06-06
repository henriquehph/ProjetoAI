<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    //Função para mostrar as fotos
    public function getPhotoFullUrlAttribute() {
        if ($this->photo && Storage::disk('public')->exists("categories/{$this->photo}")) {
            return asset("storage/categories/{$this->photo}");
        } else {
            return asset("storage/categories/category_no_image.png");
        }
    }
}
