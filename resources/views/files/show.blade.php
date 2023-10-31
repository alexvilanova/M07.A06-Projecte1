<x-app-layout>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
			<div class="container">
				<h1>Detalles del Archivo</h1>
				<img class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" />

				<form method="POST" action="{{ route('files.destroy', $file->id) }}">
				    @csrf
				    @method('DELETE')
				    <button type="submit" class="btn btn-danger">Eliminar</button>
				</form>

				<a href="{{ route('files.edit', $file->id) }}" class="btn btn-primary">Editar</a>
			    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
