<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;

class FarmController extends Controller
{
    public function getFarms()
    {
        return Farm::all();
    }
}
