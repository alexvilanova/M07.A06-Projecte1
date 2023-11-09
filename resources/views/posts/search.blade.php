<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 flex items-center justify-between">
                        <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Subir</a>
                        <form action="{{ route('posts.search') }}" method="get" class="flex">
                            <input type="text" name="query" placeholder="Buscar posts..." class="border rounded-l-md p-2 w-64">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded-r-md p-2">
                                Buscar
                            </button>
                        </form>
                        <a href="{{ route('posts.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded">Reset</a>
                    </div>
                    <p class="mb-2">Se encontraron {{ $numPosts }} posts.</p>
                    @foreach ($posts as $post)
                        <div class="border p-4 mb-4 rounded shadow">
                            <p class="text-lg font-semibold">Usuario: {{ $post->user ? $post->user->name : 'No hay información disponible'}}</p>
                            <p class="text-lg font-semibold">Título: {{ $post->user ? $post->title : 'No hay información disponible'}}</p>
                            <p class="text-gray-600">Descripción: {{ $post->description ? $post->description : 'No hay información disponible'}}</p>
                            <a href="{{ route('posts.show', $post) }}">
                                <img class="img-fluid mt-4" src="{{ asset('storage/' . $post->file->filepath) }}" alt="Imagen" />
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
