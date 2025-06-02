<?php

namespace Database\Factories;

use App\Models\Colecao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\colecao>
 */
class ColecaoFactory extends Factory
{
    protected $model = Colecao::class;

    public function definition(): array
    {
        return [
            'nome_colecao' => $this->faker->words(2, true), 
            'descricao' => $this->faker->sentence(10),
            'data_lancamento' => $this->faker->date(),
        ];
    }
}

