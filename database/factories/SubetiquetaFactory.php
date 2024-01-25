<?php

namespace Database\Factories;

use App\Models\Etiqueta;
use App\Models\Subetiqueta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subetiqueta>
 */
class SubetiquetaFactory extends Factory
{
    protected $model = Subetiqueta::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'etiqueta_id' => Etiqueta::inRandomOrder()->first()->id,
        ];
    }
}
