<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Evento;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{
    protected $model = Contacto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'userid' => $this->faker->sentence(),
            'nombre' => $this->faker->sentence(),
            'fecha' => $this->faker->sentence(),
            'tipo' => $this->faker->sentence(),
            'urlimagen' => $this->faker->sentence(),
            'descripcion' => $this->faker->sentence(),
            'pais' => $this->faker->sentence(),
            'urldeacceso' => $this->faker->sentence(),
            'destacado' => $this->faker->sentence(),
        ];
    }
}
