<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function getPlants()
    {
        return Plant::all();
    }

    public function getPlant($slug)
    {
        return Plant::where('slug', $slug)->firstOrFail();
    }
}
