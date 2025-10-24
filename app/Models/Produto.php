<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    /** @use HasFactory<\Database\Factories\ProdutoFactory> */
    use HasFactory;

    protected $fillable = [
        'titulo',
        'conteudo',
        'preco',
        'marca',
        'quantidade', 
        'status'
    ];

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
        // return $this->belongsToMany(Categoria::class, 'categoria_produto');
    }

    protected $casts = [
        'status' => 'boolean',
    ];
}
