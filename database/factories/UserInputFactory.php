<?php

namespace Database\Factories;

use App\Models\UserInput;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserInputFactory extends Factory
{
    protected $model = UserInput::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'interested_with' => $this->faker->randomElement(['technology', 'sports', 'politics']),
        ];
    }
}
