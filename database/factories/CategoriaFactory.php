<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = $this->faker->unique()->word();

        return [
            'nome' => ucfirst($nome),
            'descricao' => $this->faker->sentence(),
            // 'imagem' => 'categorias/' . $nome . '.jpg',
            'status' => true
        ];
        


    }
}
