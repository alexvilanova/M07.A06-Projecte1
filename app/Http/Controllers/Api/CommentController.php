<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($postId)
    {
        if ( $this->authorize('viewAny', App\Models\Post::class)) {
            $post = Post::find($postId);
            return response()->json([
                'success' => true,
                'data' => $post->comments ?? []
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $postId)
    {
        if ( $this->authorize('create', App\Models\Comment::class)) {

            $request->validate([
                'comment' => 'required|string',
            ]);
        
            $post = Post::find($postId);
            if (!$post) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found'
                ], 404);    
            }
            
            $user = auth()->user();
            $comment = $post->comments()->create([
                'author_id' => $user->id,
                'comment' => $request->comment,
            ]);
            
            return response()->json([
                'success' => true,
                'data' => $comment
            ], 201);
        }
}
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($postId, $commentId)
    {
        $post = Post::find($postId);
        $comment = Comment::find($commentId);
        \Log::debug($comment);
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);    
        }
        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Comment not found'
            ], 404);    
        }
        if ( $this->authorize('delete', $comment)) {
            $comment->delete();
            return response()->json([
                'success' => true,
                'data' => $post
            ], 200);
        }
}
}
