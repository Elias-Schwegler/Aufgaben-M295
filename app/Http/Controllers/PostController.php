<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;    // Add this
use App\Models\Topic;  // Add this
use App\Models\Author; // Add this

class PostController extends Controller
{
    public function index() {
        $posts = Post::with(['topic', 'author'])->get()->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'topic' => $post->topic->name,
            ];
        });

        return $posts;
    }

    public function postsByTopic(string $search) {
        $posts = Post::where('id', 'like', '%' . $search . '%')
            ->orWhere('title', 'like', '%' . $search . '%')
            ->orWhere('content', 'like', '%' . $search . '%')
            ->orWhereHas('topic', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        if($posts){
            return $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                    'topic' => $post->topic ? $post->topic->name : null, 
                ];
            });
        }
        else {
            return response('Not Found', 404);
        }
        
    }

}
