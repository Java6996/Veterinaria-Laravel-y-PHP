<?php

namespace Database\Factories;

use App\Models\Diagnostico;
use App\Models\Mascota;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diagnostico>
 */
class DiagnosticoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sintomas' => $this->faker->sentence(12),
            'diagnostico' => $this->faker->sentence(10),
            'tratamiento' => $this->faker->sentence(15),
            'fecha' => $this->faker->date(),
            'mascota_id' => Mascota::inRandomOrder()->value('id_mascota'),
            'user_id' => User::inRandomOrder()->value('id'),
        ];
    }
}

//https://laravel.com/docs/12.x/eloquent-factories#main-content

//https://laravel.com/docs/12.x/seeding#writing-seeders
