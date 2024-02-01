<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     // POLICIES DE USUARIO?
    public function __construct()
    {
        //$this->authorizeResource(Post::class, 'post');
        //$this->middleware('can:store,App\Models\Post')->only('store');
        //$this->middleware('can:delete,post')->only('delete');
    }

    public function index()
    {
        if ( $this->authorize('viewAny', App\Models\Post::class)) {
            $posts = Post::all();
            return response()->json([
                "success" => true,
                "data" => $posts,
            ], 200 );
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ( $this->authorize('create', App\Models\Post::class)) {
            $validatedData = $request->validate([
                'title' => 'required|max:20',
                'description' => 'required|max:150',
                'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024',
                'visibility_id' => 'required|exists:visibilities,id',
            ]);
            $upload = $request->file('upload');
            $fileName = $upload->getClientOriginalName();
            $fileSize = $upload->getSize();
    
            $uploadName = time() . '_' . $fileName;
            $filePath = $upload->storeAs(
                'uploads',      // Path
                $uploadName ,   // Filename
                'public'        // Disk
            );
        
            if (\Storage::disk('public')->exists($filePath)) {
                $fullPath = \Storage::disk('public')->path($filePath);
                $file = File::create([
                    'filepath' => $filePath,
                    'filesize' => $fileSize,
                ]);
                $user = auth()->user();
                $post = Post::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'author_id' => $user->id,
                    'file_id' => $file->id,
                    'visibility_id' => $request->visibility_id,
                    ]);
                \Log::debug($post);     
                return response()->json([
                    'success' => true,
                    'data' => $post
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Error uploading post",
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);
        }
        if ( $this->authorize('view', $post)) {
        return response()->json([
            'success' => true,
            'data' => $post
        ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        if ($post) {
            if ( $this->authorize('update', $post)) {
                $request->validate([
                    'upload' => 'mimes:gif,jpeg,jpg,png|max:1024',
                    'title' => 'required|max:20',
                    'description' => 'required|max:150',
                    'visibility_id' => 'required|exists:visibilities,id',
                ]);
        
                // Comprueba si se ha enviado un nuevo archivo
                if ($request->hasFile('upload')) {
                    \Storage::disk('public')->delete($post->file->filepath);
            
                    $newFile = $request->file('upload');
                    $newFileName = time() . '_' . $newFile->getClientOriginalName();
                    $newFilePath = $newFile->storeAs('uploads', $newFileName, 'public');
                    $post->file->update([
                        'original_name' => $newFile->getClientOriginalName(),
                        'filesize' => $newFile->getSize(),
                        'filepath' => $newFilePath,
                    ]);
                }
        
                $newTitle = $request->title;
                $newDescription = $request->description;
        
                $post->update([
                    'title' => $newTitle,
                    'description' => $newDescription,
                    'updated_at' => now(),
                    'visibility_id' => $request->visibility_id,
                ]);
                return response()->json([
                    'success' => true,
                    'data' => $post
                ], 200);     
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);    
    
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);    
        }

        if ( $this->authorize('delete', $post)) {
            if (\Storage::disk('public')->exists($post->file->filepath)) {
                \Storage::disk('public')->delete($post->file->filepath);
            }
            $post->file->delete();
            $post->delete();
            return response()->json([
                'success' => true,
                'data' => $post
            ], 200);    
        }
    }

    public function like(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);    
        }

        if ( $this->authorize('like', $post)) {
            $user = auth()->user();
            if ($user->likes->contains($post)) {
                return response()->json([
                    'success' => false,
                    'message' => 'You have already liked this post'
                ], 422);    
            }
            else {
                $user->likes()->attach($post);

                return response()->json([
                    'success' => true,
                    'data' => [
                        'likes' =>  $post->liked()->count()
                    ] // PENDIENTE SUSTITUIR con cantidad de likes ?
                    ], 201);    
                }
        }
    }
    public function unlike(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found'
            ], 404);    
        }
        $user = auth()->user();
        if (!$user->likes->contains($post)) {
            return response()->json([
                'success' => false,
                'message' => 'You have not liked the post'
            ], 422);    
        }

        $user->likes()->detach($post);

        return response()->json([
            'success' => true,
            'data' => [
                'likes' =>  $post->liked()->count()
            ] // PENDIENTE SUSTITUIR con cantidad de likes ?
        ], 200);    
}

}
