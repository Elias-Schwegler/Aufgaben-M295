<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function postsByTopic($slug) 
    {
        $topic = Topic::where('slug', '=', $slug)->with('posts')->first();

        return $topic->posts;
    }
}
