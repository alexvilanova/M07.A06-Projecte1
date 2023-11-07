<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <div class="py-12 ">
        <div class="max-w-7xl  bg-white mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold mb-4">Detalles</h1>
            <p class="text-lg font-semibold mb-2">{{ $post->title }}</p>
            <p class="text-gray-600 mb-4">{{ $post->description }}</p>
            <img src="{{ asset('storage/' . $post->file->filepath) }}" alt="Image" class="w-50 h-50 mb-4">
            <a href="{{ route('posts.edit', $post->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2">Editar</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded mr-2">Eliminar</button>
            </form>
            <a href="{{ route('posts.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded">Volver al Listado</a>
        </div>
    </div>
    </x-app-layout>