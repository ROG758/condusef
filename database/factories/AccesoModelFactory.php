<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccesoModel>
 */
class AccesoModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'nombreSistema' -> $this->faker->word,
            'descripcion'-> $this->faker->word,
            'nivelAceeso'-> $this->faker->word,
        ];
    }
}