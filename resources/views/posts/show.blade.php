<x-app-layout>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
			<div class="container">
				<h1>Detalles de la publicación</h1>
				<hr>
                <img class="img-fluid" src="{{ asset("storage/{$post->file->filepath}") }}" />
				<hr>
                <p>Usuario: {{ $post->user->name }}</p>
				<p>Tamaño de la imagen: {{ $post->file->filesize}} bytes</p>
				<p>Fecha publicación: {{ $post->updated_at}}</p>
                <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
				    @csrf
				    @method('DELETE')
				    <button type="submit" class="btn btn-danger">Eliminar</button>
				</form>
				<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Editar</a>
			</div>
        </div>
    </div>
</x-app-layout>
