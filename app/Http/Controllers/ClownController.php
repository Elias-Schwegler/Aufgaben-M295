<?php

namespace App\Http\Controllers;

use App\Models\Clown;
use Illuminate\Http\Request;

class ClownController extends Controller
{
    public function index()
    {
        return Clown::all();
    }
}
