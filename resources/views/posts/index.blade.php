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
                    <div class="mb-4 flex justify-between items-center">
                        <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Subir</a>
                        <form action="{{ route('posts.search') }}" method="get" class="flex">
                            <input type="text" name="query" placeholder="Buscar posts..." class="border rounded-l-md p-2 w-64">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded-r-md p-2">
                                Buscar
                            </button>
                        </form>
                    </div>
                    @foreach ($posts as $post)
                        <div class="mb-4 border p-4 rounded shadow">
                            <p class="text-lg font-semibold">Usuario: {{ $post->user ? $post->user->name : 'No hay información disponible'}}</p>
                            <p class="text-lg font-semibold">Título: {{ $post->user ? $post->title : 'No hay información disponible'}}</p>
                            <p class="text-gray-600">Descripción: {{ $post->description ? $post->description : 'No hay información disponible'}}</p>
                            <a href="{{ route('posts.show', $post)}}">
                                <img class="img-fluid mt-4" src="{{ asset('storage/' . $post->file->filepath) }}" alt="Imagen" />
                            </a>
                        </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
