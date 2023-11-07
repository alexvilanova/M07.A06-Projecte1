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
                    <div class="mb-4">
  		            <a href="{{ route('posts.create') }}">Subir</a>
                      <form action="{{ route('posts.search') }}" method="get">
                            <input type="text" name="query" placeholder="Buscar posts...">
                            <button type="submit">Buscar</button>
                      </form>
                        @foreach ($posts as $post)
                            <p>Usuario: {{ $post->user ? $post->user->name : 'No hay información disponible'}}</p>
                            <p>Titulo: {{ $post->user ? $post->title : 'No hay información disponible'}}</p>
                            <p>Descripción: {{ $post->description ? $post->description : 'No hay información disponible'}}</p>
                            <a href="{{ route('posts.show', $post) }}"><img class="img-fluid" src="{{ asset('storage/' . $post->file->filepath) }}" /></a>
                        @endforeach
                        {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
