<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Gruposfacebook;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gruposfacebook>
 */
class GruposfacebookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'urlgrupo' => $this->faker->sentence(),
            'nombre' => $this->faker->sentence(),
            'pais' => $this->faker->sentence(),
            'cantidadmiembros' => $this->faker->sentence(),
        ];
    }
}
