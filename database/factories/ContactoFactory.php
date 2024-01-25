<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contacto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contacto>
 */
class ContactoFactory extends Factory
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
            'userid' => $this->faker->randomElement(["1", "2"]),
            'urlfotoperfil' => $this->faker->randomElement(["https://www.intreasso.org/wp-content/uploads/user-4.png"]),
            'urlidentificacion' => $this->faker->randomElement(["https://www.intreasso.org/wp-content/uploads/imagen-identificacion.png"]),
            'urlhojadevida' => $this->faker->sentence(),
            'ndi' => $this->faker->sentence(),
            'nombre' => $this->faker->sentence(),
            'correo' => $this->faker->randomElement(["prueba@asd.com", "mariaadasd@gmail.coom"]),
            'telefono' => $this->faker->randomElement(["+5785541116", "+5835151155", "+59322954751"]),
            'pais' => $this->faker->randomElement(["Ecuador", "Venezuela", "Perú"]),
            'ciudad' => $this->faker->randomElement(["Bogotá", "Medellín", "Quito"]),
            'segurosocial' => $this->faker->randomElement(["Bogotá", "Medellín", "Quito"]),
            'profesion' => $this->faker->randomElement(["Constructora", "Diseñador", "Agente Inmobiliario"]),
            'fechadecumpleanios' => $this->faker->randomElement(["28-12-1999", "12-06-1929", "02-06-1989"]),
            'status' => $this->faker->randomElement(["aaa", "bbb"]),
            'seguimiento' => $this->faker->randomElement(["Carlos IREA", "American Homes"]),
            'referencia' => $this->faker->randomElement(["Carlos IREA", "American Homes"]),
            'referenciafuente' => $this->faker->randomElement(["Carlos IREA", "American Homes"]),
            'tipodeafiliacion' => $this->faker->sentence(),
            'etiqueta' => $this->faker->randomElement(["''", "''"]),
            'evento' => $this->faker->randomElement(["''", "''"]),
            'fechadeafiliacionintreasso' => $this->faker->randomElement(["28-12-2021", "12-01-2022", "11-01-2023"]),
            'notasdeperfil' => $this->faker->sentence(),
            'notas' => $this->faker->sentence(),
        ];
    }
}
