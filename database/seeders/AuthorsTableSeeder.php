<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorsTableSeeder extends Seeder
{
    public function run()
    {
        Author::factory()->count(10)->create();
    }
}
