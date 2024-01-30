<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::all();
        return response()->json([
            'success' => true,
            'data' => $files
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar fitxer
        $validatedData = $request->validate([
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);
        // Desar fitxer al disc i inserir dades a BD
        $upload = $request->file('upload');
 
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        \Log::debug("Storing file '{$fileName}' ($fileSize)...");
 
 
        // GUARDAR EN DISCO DURO
        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs(
            'uploads',      // Path
            $uploadName ,   // Filename
            'public'        // Disk
        );

        // Si el archivo se ha guardado inserta en BD
        if (\Storage::disk('public')->exists($filePath)) {
            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);    
        } else {
            $file = false;
        }

        \Log::debug($file);

        if ($file) {
            return response()->json([
                'success' => true,
                'data'    => $file
            ], 201);
        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Error uploading file'
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $file = File::find($id);

        if (!$file) {
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $file
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $file = File::find($id);
        if ($file) {

            $validatedData = $request->validate([
                'upload' => 'required|mimes:gif,jpeg,jpg,png|max:2048',
            ]);
    
            \Storage::disk('public')->delete($file->filepath);
    
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
    
            return response()->json([
                'success' => true,
                'message' => 'File updated successfully',
                'data' => $file
            ], 200);
    
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = File::find($id);

        if ($file) {
            if (\Storage::disk('public')->exists($file->filepath)) {
                \Storage::disk('public')->delete($file->filepath);
                $file->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'File deleted successfully',
                    'data' => $file
                ], 200);
            }
        
        } else { 
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);
        }

    }

    public function update_workaround(Request $request, $id)
    {
        return $this->update($request, $id);
    }
 
}
