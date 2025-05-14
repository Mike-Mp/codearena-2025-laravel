<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $comment = new Comment([
            'name' => $validated['name'],
            'body' => $validated['body'],
            'user_id' => Auth::id(),
        ]);

        $post->$comments()->save($comment);

        return redirect()->back()->with('success', 'Comment added!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', $comment);

        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted!');
    }
}
