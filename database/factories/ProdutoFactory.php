<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titulo = $this->faker->words(2, true);
        $marca = $this->faker->words(2, true);
        return [
            'titulo' => ucfirst($titulo),
            'conteudo' => $this->faker->paragraph(),
            'preco' => $this->faker->randomFloat(2, 20, 2000),
            'marca' => $marca,
            'quantidade' => $this->faker->numberBetween(0, 100),
            'status' => true
            // 'imagem' => 'produtos/' . Str::slug($titulo) . '.jpg',
        ];
        
    }
}
