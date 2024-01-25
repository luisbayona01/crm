<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Publicacion;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publicacion>
 */
class PublicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'userid' => $this->faker->sentence(),
            'urlimagen' => $this->faker->sentence(),
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->sentence(),
            'pais' => $this->faker->sentence(),
            'ubicacion' => $this->faker->sentence(),
            'precio' => $this->faker->sentence(),
            'comision' => $this->faker->sentence(),
        ];
    }
}
