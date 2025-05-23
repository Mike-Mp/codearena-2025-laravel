<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index(?User $user = null)
    {
        $posts = Post::query()->published()->when($user, function($query) use ($user) {
            return $query->where('user_id', $user->id);
        })->orderByDesc('promoted')->latest('published_at')->paginate(9);

        $authors = User::query()->whereHas('posts', function($query) {
            $query->published();
        })->get(); 

        return view('posts.index', compact('posts','authors'));
    }

    public function show(Post $post)
    {
        if (!$post->isPublished()) {
            abort(404);
        }

        $comments = $post->comments()->orderByDesc('created_at')->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function promoted()
    {
        $posts = Post::query()->published()->promoted()->latest('published_at')->paginate(9);

        return view('promoted.index', compact('posts'));
    }
}
