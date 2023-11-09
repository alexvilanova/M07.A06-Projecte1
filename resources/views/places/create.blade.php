<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Lugar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('places.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="upload">Imagen</label>
                            <input type="file" name="upload" class="form-control" accept=".jpg, .jpeg, .png, .gif">
                        </div>
                        <div class="form-group">
                            <label for="latitude">Latitud</label>
                            <input type="text" name="latitude" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="longitude">Longitud</label>
                            <input type="text" name="longitude" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Lugar</button>
                    </form>
                    <a href="{{ route('places.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>