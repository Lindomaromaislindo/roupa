<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition(): array
    {
        return [
            'colecao_id' => \App\Models\Colecao::factory(),
            'nome' => $this->faker->words(3, true),
            'preco' => $this->faker->randomFloat(2, 30, 500),
            'descricao' => $this->faker->sentence(12),
            'imagem' => $this->faker->imageUrl(640, 480, 'fashion', true, 'clothes'),
        ];
    }
}
