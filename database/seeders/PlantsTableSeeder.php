<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plant;

class PlantsTableSeeder extends Seeder
{
    public function run()
    {
        Plant::factory()->count(50)->create();
    }
}
