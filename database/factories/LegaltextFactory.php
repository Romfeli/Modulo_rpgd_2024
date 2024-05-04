<?php

namespace Database\Factories;

use App\Models\LegalText;
use Illuminate\Database\Eloquent\Factories\Factory;

class LegaltextFactory extends Factory
{
    protected $model = LegalText::class;

    public function definition()
{
    return [
        'title' => $this->faker->sentence,
        'content' => $this->faker->paragraph,
    ];
}

}
