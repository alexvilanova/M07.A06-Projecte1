<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Places') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('places.update', $place->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ $place->name }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea name="description" class="form-control">{{ $place->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="upload">Imagen</label>
                            <input type="file" name="upload" class="form-control" accept=".jpg, .jpeg, .png, .gif">
                        </div>
                        <div class="form-group">
                            <label for="coordenadas">Coordenadas</label>
                            <input type="text" name="coordenadas" class="form-control" value="{{ $place->coordenadas }}">
                        </div>
                        <div class="form-group">
                            <label for="latitude">Latitud</label>
                            <input type="text" name="latitude" class="form-control" value="{{ $place->latitude }}">
                        </div>
                        <div class="form-group">
                            <label for="longitude">Longitud</label>
                            <input type="text" name="longitude" class="form-control" value="{{ $place->longitude }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Lugar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>