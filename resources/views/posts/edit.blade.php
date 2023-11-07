<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Editar Publicación</h1>
                    <form method="post" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data" class="bg-white p-4 rounded-lg shadow-md">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold">Título:</label>
                            <input type="text" id="title" name="title" value="{{ $post->title }}" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold">Descripción:</label>
                            <textarea id="description" name="description" class="w-full p-2 border rounded-md" rows="4">{{ $post->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="imagen" class="block text-gray-700 font-bold">Imagen actual:</label>
                            <img src="{{ asset('storage/' . $post->file->filepath) }}" alt="Image" class="w-20 mb-4">
                        </div>
                        <div class="mb-4">
                            <label for="upload" class="block text-gray-700 font-bold">Archivo:</label>
                            <input type="file" id="upload" name="upload" class="w-full p-2 border rounded-md">
                        </div>
                        <div class="flex space-x-4">
                            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Guardar</button>
                            <a href="{{ route('posts.index') }}" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md hover:bg-gray-400">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>