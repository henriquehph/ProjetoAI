<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = 'cards';
    protected $fillable = ['id', 'card_number', 'balance'];

    // Põe o user ID como chave primária
    protected $primaryKey = 'id';

    // Assegura que o ID não é auto-incremental
    public $incrementing = false;

    // Dar cast aos atributos que precisam
    protected $casts = [
        'balance' => 'decimal:2',  // decimal com 2 casas decimais
    ];

     public function card()
    {
        return $this->hasOne(User::class, 'id');
    }
}
