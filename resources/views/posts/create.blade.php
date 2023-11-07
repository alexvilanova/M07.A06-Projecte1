<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Post') }}   
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Crear Nueva Publicación</h1>
                    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="bg-white p-4 rounded-lg shadow-md">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold">Título:</label>
                        <input type="text" id="title" name="title" class="w-full p-2 border rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold">Descripción:</label>
                        <textarea id="description" name="description" class="w-full p-2 border rounded-md" rows="4"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="upload" class="block text-gray-700 font-bold">Archivo:</label>
                        <input type="file" id="upload" name="upload" value="" class="w-full p-2 border rounded-md">
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Crear</button>
                        <button type="reset" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md hover:bg-gray-400">Limpiar</button>
                        <a href="{{ route('posts.index') }}" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-md hover:bg-gray-400">Volver</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>