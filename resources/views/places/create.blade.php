<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Lugar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white bg-opacity-60 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('places.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-600">Nombre</label>
                        <input type="text" name="name" class="w-full p-2 border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-semibold text-gray-600">Descripción</label>
                        <textarea name="description" class="w-full p-2 border rounded-md"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="upload" class="block text-sm font-semibold text-gray-600">Imagen</label>
                        <input type="file" name="upload" class="w-full p-2 border rounded-md" accept=".jpg, .jpeg, .png, .gif">
                    </div>
                    <div class="mb-4">
                        <label for="latitude" class="block text-sm font-semibold text-gray-600">Latitud</label>
                        <input type="text" name="latitude" class="w-full p-2 border rounded-md">
                    </div>
                    <div class="mb-6">
                        <label for="longitude" class="block text-sm font-semibold text-gray-600">Longitud</label>
                        <input type="text" name="longitude" class="w-full p-2 border rounded-md">
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Guardar Lugar</button>
                        <a href="{{ route('places.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>