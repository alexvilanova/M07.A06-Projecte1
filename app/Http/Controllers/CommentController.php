<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        $user = auth()->user();
        $comment = $post->comments()->create([
            'author_id' => $user->id,
            'comment' => $request->comment,
        ]);
        
        return back()->with('success', __('Comment published'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment)
    {
        if ($comment->post_id == $post->id) {
            $comment->delete();
            return back()->with('success', __('Comment delete'));
        } else {
            return back()->with('error', __('Comment does no belong to post'));           
        }

    }
}
