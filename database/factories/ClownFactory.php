<?php

namespace Database\Factories;

use App\Models\Clown;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClownFactory extends Factory
{
    protected $model = Clown::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'description' => $this->faker->sentence,
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
