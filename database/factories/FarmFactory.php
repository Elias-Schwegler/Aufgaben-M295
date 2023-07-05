<?php

namespace Database\Factories;

use App\Models\Farm;
use App\Models\Plant; 
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; 

class FarmFactory extends Factory
{
    protected $model = Farm::class;

    public function definition()
    {
        $name = $this->faker->company;
        return [
            'plant_id' => Plant::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'zip' => $this->faker->postcode,
        ];
    }
}
