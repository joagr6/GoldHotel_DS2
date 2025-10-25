<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hospede;
use App\Models\Quarto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Gera datas coerentes (entrada antes da saída)
        $dataEntrada = $this->faker->dateTimeBetween('now', '+1 week');
        $dataSaida = $this->faker->dateTimeBetween($dataEntrada, '+2 weeks');

        return [
            'data_entrada' => $dataEntrada,
            'data_saida' => $dataSaida,
            'status' => $this->faker->randomElement(['ativa', 'finalizada', 'cancelada']),

            // IDs de hóspede e quarto (precisam existir ou ser criados)
            'hospede_id' => Hospede::factory(),
            'quarto_id' => Quarto::factory(),
        ];
    }
}
