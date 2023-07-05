<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::with(['topic', 'author'])->get();
    }

    public function show($id)
    {
        $post = Post::find($id);
    
        if ($post) {
            return response()->json($post, 200);
        } else {
            return response()->json('Post mit id= ' . $id . ' wurde nicht gefunden.', 404);
        }
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());

        if ($post) {
            return response()->json([
                'message' => 'Post erfolgreich erstellt.',
                'post' => $post
            ], 201);
        } else {
            return response()->json('Fehler beim Erstellen des Posts.', 500);
        }
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->update($request->all());
            return response()->json([
                'message' => 'Post wurde erfolgreich aktualisiert.',
                'post' => $post
            ], 200);
        } else {
            return response()->json('Post wurde nicht gefunden.', 404);
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);
    
        if ($post) {
            $post->delete();
            return response()->json('Post wurde gelöscht.', 200);
        } else {
            return response()->json('Post wurde nicht gefunden.', 404);
        }
    }

    public function postsByTopic(string $search) {
        $posts = Post::where('id', 'like', '%' . $search . '%')
            ->orWhere('title', 'like', '%' . $search . '%')
            ->orWhere('content', 'like', '%' . $search . '%')
            ->orWhereHas('topic', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        if(count($posts) > 0){
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
