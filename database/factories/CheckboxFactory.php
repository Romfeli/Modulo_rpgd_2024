<?php

namespace Database\Factories;

use App\Models\Checkbox;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckboxFactory extends Factory
{
    protected $model = Checkbox::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ];
    }
}
