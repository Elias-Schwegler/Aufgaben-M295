<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Topic; // add this
use App\Models\Author; // add this
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'topic_id' => Topic::factory(),
            'author_id' => Author::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ];
    }
}
