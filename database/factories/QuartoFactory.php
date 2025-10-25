<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quarto>
 */
class QuartoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'capacidade' => $this->faker->name,
            'ValorDiaria' => $this->faker->numerify('#######'),
            'status' => $this->faker->numerify('###########'),
            'tipoQuarto' => $this->faker->phoneNumber(),
        ];
    }
}
