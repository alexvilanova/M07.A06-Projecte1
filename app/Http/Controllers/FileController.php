<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("files.index", [
            "files" => File::all()
        ]);
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("files.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Validar fitxer
        $validatedData = $request->validate([
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024'
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
            \Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('files.show', $file)
                ->with('success', 'File successfully saved');
        } else {
            \Log::debug("Disk storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("files.create")
                ->with('error', 'ERROR uploading file');
        }
    }
 
    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        $fileExists = Storage::disk('public')->exists($file->filepath);
    
        if (!$fileExists) {
            return redirect()->route('files.index')->with('error', 'Imagen no encontrada');
        }
    
        return view('files.show', compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        return view('files.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        // Validar los datos del formulario
        $request->validate([
            'upload' => 'mimes:gif,jpeg,jpg,png|max:1024', // Ajusta las reglas según tus necesidades
        ]);
    
        // Comprueba si se ha enviado un nuevo archivo
        if ($request->hasFile('upload')) {
            // Elimina el archivo anterior del disco
            Storage::disk('public')->delete($file->filepath);
    
            // Sube el nuevo archivo al disco
            $newFile = $request->file('upload');
            $newFileName = time() . '_' . $newFile->getClientOriginalName();
            $newFilePath = $newFile->storeAs('uploads', $newFileName, 'public');
    
            // Actualiza la información del archivo en la base de datos
            $file->update([
                'original_name' => $newFile->getClientOriginalName(),
                'filesize' => $newFile->getSize(),
                'filepath' => $newFilePath,
            ]);
        }
    
        return redirect()->route('files.show', $file)->with('success', 'Archivo actualizado con éxito');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
    // Verifica si el archivo actual existe en el disco y lo elimina
    if (Storage::disk('public')->exists($file->filepath)) {
        Storage::disk('public')->delete($file->filepath);
    }

    // Elimina el registro de la BD
    $file->delete();

    return redirect()->route('files.index')->with('success', 'Archivo eliminado correctamente.');    }
}
