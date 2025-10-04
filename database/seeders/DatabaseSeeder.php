<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // se crearon los usuarios de prueba brindados en txt
        // Usuario empleado
        User::factory()->create([
            'name' => 'Amalia',
            'email' => 'amalia@prueba',
            'password' => bcrypt('amalia1234'),
            'role' => 'empleado',
        ]);

        // Usuario cliente 1
        User::factory()->create([
            'name' => 'Lucas',
            'email' => 'lucas@prueba.com',
            'password' => bcrypt('lucas1234'),
            'role' => 'cliente',
        ]);

        // Usuario cliente 2
        User::factory()->create([
            'name' => 'Juan',
            'email' => 'juan@prueba',
            'password' => bcrypt('juan1234'),
            'role' => 'cliente',
        ]);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory(10)->create();
        $this->call([
            MascotaSeeder::class,
            DiagnosticoSeeder::class,
            FacturaSeeder::class
        ]);

    }
}
