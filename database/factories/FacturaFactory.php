<?php

namespace Database\Factories;

use App\Models\Factura;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Factura>
 */
class FacturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'monto' =>$this->faker->randomFloat(2, 10, 1000),
            'fecha_emision' => $this->faker->date(),
            'estado_pago' => $this->faker->randomElement(['Pagado', 'Pendiente']),
            'email' => User::inRandomOrder()->value('email'),
            'user_id' => User::inRandomOrder()->value('id')
            //randomElement es una función que selecciona un elemento aleatorio de un array.
            //numberBetween es una función que genera un número aleatorio entre dos valores dados.
        ];
    }
}

//https://laravel.com/docs/12.x/eloquent-factories#main-content

//https://laravel.com/docs/12.x/seeding#writing-seeders
