<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produtos = [
            [
                'titulo' => 'Mouse - Grifft',
                'marca' => 'Redragon',                
                'preco' => 50.00,                     
                'conteudo' => 'Mouse sem fio, 1800 DPI....',
                'quantidade' => 200,                     
                'status' => true,
            ],
            [
                'titulo' => 'Monitor - AOC HERO',
                'marca' => 'AOC',                     
                'preco' => 700.00,                    
                'conteudo' => 'Monitor Gamer AOC HERO QUAD 1440p QHD 155hz 1ms Q27G2',
                'quantidade' => 50,                      
                'status' => true,
            ],
            [
                'titulo' => 'Silmarillion',
                'marca' => null,                     
                'conteudo' => 'O Silmarillion é o relato dos Dias Antigos da Primeira Era...',
                'preco' => 100.00,                    
                'quantidade' => 80,                      
                'status' => true,
            ],
        ];

        // DB::table('produtos')->insert($produtos);
        Produto::insert($produtos);
        Produto::factory(20)->create();
    }
}
