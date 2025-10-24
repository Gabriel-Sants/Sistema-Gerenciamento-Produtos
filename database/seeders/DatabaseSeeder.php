<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categoria;
use App\Models\Produto;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // $categorias = Categoria::factory(5)->create();

        // Produto::factory(20)->create()->each(function ($produto) use ($categorias) {
        //     $produto->categorias()->attach(
        //         $categorias->random(rand(1, 3))->pluck('id')->toArray()
        //     );
        // });

        $this->call([
            UserSeeder::class,
            CategoriaSeeder::class,
            ProdutoSeeder::class,
            CategoriaProdutoSeeder::class,
        ]);
    }
}
