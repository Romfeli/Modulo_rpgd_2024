<?php

namespace Database\Factories;
// database/factories/AparienciaFactory.php

use App\Models\Apariencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class AparienciaFactory extends Factory
{
    protected $model = Apariencia::class;

    public function definition()
    {
        return [
            'is_logo_active' => true, // Ajusta según tus necesidades
        ];
    }
}
