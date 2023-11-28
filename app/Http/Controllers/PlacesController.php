<?php

namespace App\Http\Controllers;

use App\Models\Place; // Asegúrate de importar el modelo correcto
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class PlacesController extends Controller // Cambia el nombre del controlador
{
    public function __construct()
    {
        $this->authorizeResource(Place::class, 'place');
    }

    public function index()
    {
        return view("places.index", [
            "places" => Place::paginate(6)
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $places = Place::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")->paginate(5);
        return view('places.index', compact('places'));
    }

    public function create()
    {
        return view("places.create");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024',
        ]);

        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();

        $uploadName = time() . '_' . $fileName;
        $filePath = $upload->storeAs('uploads', $uploadName, 'public');

        if (Storage::disk('public')->exists($filePath)) {
            $fullPath = Storage::disk('public')->path($filePath);

            $file = File::create([
                'filepath' => $filePath,
                'filesize' => $fileSize,
            ]);

            $place = Place::create([
                'name' => $request->name,
                'description' => $request->description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'author_id' => auth()->user()->id,
                'file_id' => $file->id,
            ]);

            return redirect()->route('places.index')
                ->with('success', __('Location successfully saved'));
        } else {
            return redirect()->route('files.create')
                ->with('error', __('Error uploading place'));
        }
    }

    public function show(Place $place)
    {
        $fileExists = Storage::disk('public')->exists($place->file->filepath);
        if (!$fileExists) {
            return redirect()->route('places.index')->with('error', __('Lugar no encontrado'));
        }
        return view('places.show', compact('place'));
    }

    public function edit(Place $place)
    {
        return view('places.edit', compact('place'));
    }

    public function update(Request $request, Place $place)
    {
        $request->validate([
            'upload' => 'mimes:gif,jpeg,jpg,png|max:1024',
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->hasFile('upload')) {
            Storage::disk('public')->delete($place->file->filepath);

            $newFile = $request->file('upload');
            $newFileName = time() . '_' . $newFile->getClientOriginalName();
            $newFilePath = $newFile->storeAs('uploads', $newFileName, 'public');

            $place->file->update([
                'original_name' => $newFile->getClientOriginalName(),
                'filesize' => $newFile->getSize(),
                'filepath' => $newFilePath,
            ]);
        }

        $place->update([
            'name' => $request->name,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'updated_at' => now(),
        ]);

        return redirect()->route('places.show', $place)->with('success', __('Successfully modified location'));
    }

    public function destroy(Place $place)
    {
        if (Storage::disk('public')->exists($place->file->filepath)) {
            Storage::disk('public')->delete($place->file->filepath);
        }

        $place->file->delete();
        $place->delete();

        return redirect()->route('places.index')->with('success', __('Correctly removed place'));
    }

    public function favorite(Place $place)
    {
        $user = auth()->user();

        if ($user->favorites->contains($place)) {
            return back()->with('error', __('You have already liked this place'));
        }
        else {
            $user->favorites()->attach($place);

            return back()->with('success', __('You have liked the place'));            
        }
    }
    public function unfavorite(Place $place)
    {
        $user = auth()->user();
        
        if (!$user->favorites->contains($place)) {
            return back()->with('error', __('You haven t liked this place yet'));
        }

        $user->favorites()->detach($place);

        return back()->with('success', __('You have unliked the post.'));
    }
}