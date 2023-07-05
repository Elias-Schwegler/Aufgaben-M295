<?php

namespace Database\Seeders;

use App\Models\Clown;
use Illuminate\Database\Seeder;

class ClownTableSeeder extends Seeder
{
    public function run()
    {
        Clown::factory()->count(50)->create();
    }
}
