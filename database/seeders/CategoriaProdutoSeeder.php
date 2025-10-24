<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Categoria;
use App\Models\Produto;

class CategoriaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eletronicos = Categoria::firstWhere('nome', 'Eletrônicos');
        $roupas = Categoria::firstWhere('nome', 'Roupas');
        $livros = Categoria::firstWhere('nome', 'Livros');

        $mouse = Produto::find(1);        
        $monitor = Produto::find(2);      
        $silmarillion = Produto::find(3); 

        $eletronicos->produtos()->syncWithoutDetaching([$mouse->id, $monitor->id]);
        $livros->produtos()->syncWithoutDetaching([$silmarillion->id]);        
    }
}
