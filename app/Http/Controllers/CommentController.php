<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'body' => 'required|string',
        ]);

        $comment = new Comment([
            'name' => $validated['name'],
            'body' => $validated['body'],
            'post_id' => $post->id
        ]);

        $post->comments()->save($comment);

        return redirect()->route('post', $post)->with('success', 'Comment added!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $post = $comment->post;
        $comment->delete();
        return redirect()->route('post',$post)->with('success', 'Comment deleted!');
    }
}
