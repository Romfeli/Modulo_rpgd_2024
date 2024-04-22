<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Participante;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un usuario de prueba
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'wweew@example.com',
        ]);

        // Crear 10 participantes ficticios
        Participante::factory()->count(10)->create();

        // Crear un participante adicional con datos aleatorios
        Participante::factory()->create();
    }
}
