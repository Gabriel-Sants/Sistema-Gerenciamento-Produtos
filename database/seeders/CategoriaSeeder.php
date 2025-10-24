<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;


class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nome' => 'Eletrônicos',
                'descricao' => 'Produtos eletrônicos variados',
                // 'imagem' => 'categorias/eletronicos.jpg',
                'status' => true,
            ],
            [
                'nome' => 'Roupas',                
                'descricao' => 'Moda masculina e feminina',
                // 'imagem' => 'categorias/roupas.jpg',
                'status' => true,
            ],
            [
                'nome' => 'Livros',
                'descricao' => 'Livros para todas as idades',
                // 'imagem' => 'categorias/livros.jpg',
                'status' => true,
            ],
        ];

        // DB::table('categorias')->insert($categorias);
        Categoria::insert($categorias);
        // Categoria::factory(20)->create();
    }
}
