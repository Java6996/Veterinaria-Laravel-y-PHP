<?php

namespace Database\Factories;

use App\Models\Mascota;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mascota>
 */
class MascotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_mascota' => $this->faker->unique()->numberBetween(1, 50),
            'nombre' => $this->faker->name(),
            'especie' => $this->faker->text(45),
            'raza' => $this->faker->text(45),
            'fecha_nacimiento' => $this->faker->date(),
            'user_id' => User::inRandomOrder()->value('id')
        ];
    }
}
//https://laravel.com/docs/12.x/eloquent-factories#main-content

//https://laravel.com/docs/12.x/seeding#writing-seeders
