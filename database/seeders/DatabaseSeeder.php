<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participante;
use App\Models\LegalText;
use App\Models\Checkbox;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 participantes ficticios
        Participante::factory()->count(10)->create();

        // Crear un participante adicional con datos aleatorios
        Participante::factory()->create();

        // Crear registros ficticios para la tabla Checkbox
        Checkbox::factory()->count(2)->create();
        // Crear registros ficticios para la tabla Checktexto legalbox

        LegalText::factory()->count(1)->create();
    }
}