<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'slug' => $this->faker->slug,
            'pages' => $this->faker->numberBetween(100, 1000),
            'year' => $this->faker->year,
        ];
    }
}
