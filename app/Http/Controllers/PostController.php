<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        return view("posts.index", [
            "posts" => Post::paginate(5)
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")->get();
        $numPosts = $posts->count();
        return view('posts.search', compact('posts', 'numPosts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar fitxer
        
        $validatedData = $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:150',
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024',
        ]);
        
       
        // Obtenir dades del fitxer
        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");
 
 
        // Pujar fitxer al disc dur
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',      // Path
            $uploadName ,   // Filename
            'public'        // Disk
        );
       
        if (\Storage::disk('public')->exists($filePath)) {
            \Log::debug("Disk storage OK");
            $fullPath = \Storage::disk('public')->path($filePath);
            \Log::debug("File saved at {$fullPath}");
            // Desar dades a BD
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);
            // Create del registro post
            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'author_id' => $user = auth()->user()->id,
                'file_id' => $file->id,
                ]);                
            \Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('posts.index')
                ->with('success', 'Publicación guardada con éxito');
        } else {
            \Log::debug("Disk storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("files.create")
                ->with('error', 'Error subiendo publicación');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $fileExists = Storage::disk('public')->exists($post->file->filepath);
        if (!$fileExists) {
            return redirect()->route('posts.index')->with('error', 'Publicación');
        }
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Validar los datos del formulario
        $request->validate([
            'upload' => 'mimes:gif,jpeg,jpg,png|max:1024',
            'title' => 'required|max:20',
            'description' => 'required|max:150'
        ]);
        // Comprueba si se ha enviado un nuevo archivo
        if ($request->hasFile('upload')) {
            // Elimina el archivo anterior del disco
            Storage::disk('public')->delete($post->file->filepath);
    
            // Sube el nuevo archivo al disco
            $newFile = $request->file('upload');
            $newFileName = time() . '_' . $newFile->getClientOriginalName();
            $newFilePath = $newFile->storeAs('uploads', $newFileName, 'public');
            // Actualiza la información del archivo en la base de datos
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
        ]);

    
        return redirect()->route('posts.show', $post)->with('success', ' Publicación modificada con éxito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Verifica si el archivo actual existe en el disco y lo elimina
        if (Storage::disk('public')->exists($post->file->filepath)) {
            Storage::disk('public')->delete($post->file->filepath);
        }
        // Elimina el registro de la BD
        $post->file->delete();
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Publicación eliminada correctamente.');    }
    }
