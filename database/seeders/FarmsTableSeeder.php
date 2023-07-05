<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Farm;

class FarmsTableSeeder extends Seeder
{
    public function run()
    {
        Farm::factory()->count(10)->create();
    }
}
