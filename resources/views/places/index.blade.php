<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Places') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <form action="{{ route('places.search') }}" method="get">
                    <input type="text" name="query" placeholder="Buscar lugares...">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
                <a href="{{ route('places.create') }}" class="btn btn-primary">Crear Nuevo Lugar</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($places as $place)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <img src="{{ asset('storage/' . $place->file->filepath) }}" alt="Imagen del lugar" class="img-fluid w-full h-64 object-cover">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold">{{ $place->name }}</h2>
                            <p class="text-gray-600">{{ $place->description }}</p>
                            <p>Latitud: {{ $place->latitude }}</p>
                            <p>Longitud: {{ $place->longitude }}</p>
                            <p>Fecha de creación: {{ $place->created_at }}</p>
                            <p>Fecha de actualización: {{ $place->updated_at }}</p>
                            <div class="mt-4">
                                <a href="{{ route('places.show', $place->id) }}" class="btn btn-primary">Ver</a>
                                <br><a href="{{ route('places.edit', $place->id) }}" class="btn btn-primary">Editar</a>
                                <form action="{{ route('places.destroy', $place->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $places->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
