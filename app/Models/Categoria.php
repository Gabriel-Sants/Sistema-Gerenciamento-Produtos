<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao'
    ];
    

    public function produtos()
    {
        return $this->belongsToMany(Produto::class);
        // return $this->belongsToMany(Produto::class, 'categoria_produto');
    }

}
