<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <h1>Detalles del lugar</h1>
                        <hr>

                        <p>Nombre: {{ $place->name }}</p>
                        <p>Descripción: {{ $place->description }}</p>
                        <p>Latitud: {{ $place->latitude }}</p>
                        <p>Longitud: {{ $place->longitude }}</p>
                        <img class="img-fluid" src="{{ asset('storage/' . $place->file->filepath) }}" />
                        <hr>
                        <p>Fecha de creación: {{ $place->created_at }}</p>
                        <p>Fecha de actualización: {{ $place->updated_at }}</p>
                        
                        <form method="POST" action="{{ route('places.destroy', $place->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>

                        <a href="{{ route('places.edit', $place->id) }}" class="btn btn-primary">Editar</a>

                        <a href="{{ route('places.index') }}" class="btn btn-primary">Volver a la lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>






