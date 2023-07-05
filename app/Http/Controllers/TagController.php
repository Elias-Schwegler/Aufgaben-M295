<?php


namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function postsByTag($tagSlug) 
    {
        $tag = Tag::where('slug', '=', $tagSlug)->with('posts')->first();

        return $tag->posts;
    }
}
