<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del lugar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <img class="w-full h-64 object-cover mb-4 rounded-lg"
                        src="{{ asset('storage/' . $place->file->filepath) }}" alt="Place Image">
                </div>
                <div>
                    <p class="mb-2"><strong>Nombre:</strong> {{ $place->name }}</p>
                    <p class="mb-2"><strong>Descripción:</strong> {{ $place->description }}</p>
                    <p class="mb-2"><strong>Latitud:</strong> {{ $place->latitude }}</p>
                    <p class="mb-2"><strong>Longitud:</strong> {{ $place->longitude }}</p>

                    <hr class="my-6">

                    <p class="mb-2"><strong>Fecha de creación:</strong> {{ $place->created_at }}</p>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('places.index', $place->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2">
                            <i class="fas fa-list"></i> <i class="fi fi-sr-undo-alt"></i>
                        </a>
                        <a href="{{ route('places.edit', $place->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded mr-2">
                            <i class="fas fa-edit"></i> <i class="fi fi-sr-blog-pencil"></i>
                        </a>
                        <form action="{{ route('places.destroy', $place->id) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                                <i class="fas fa-trash-alt"></i> <i class="fi fi-sr-trash-xmark"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>