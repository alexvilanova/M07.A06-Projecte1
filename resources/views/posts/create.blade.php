<x-app-layout>
    <div class="max-w-5xl mx-auto bg-white bg-opacity-40 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Subir Archivo</h2>
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">Título</label>
                <input type="text" name="title" id="title" class="mt-1 p-2 w-full border rounded-md">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-600">Descripción</label>
                <textarea name="description" id="description" class="mt-1 p-2 w-full border rounded-md" rows="4"></textarea>
            </div>

            <div class="mb-4">
                <label for="upload" class="block text-sm font-medium text-gray-600">Selecciona un Archivo</label>
                <input type="file" name="upload" id="upload" class="mt-1 p-2 w-full border rounded-md" accept=".jpg, .jpeg, .png, .gif">
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">Subir Archivo</button>
            </div>
        </form>
        <div class="mt-4">
            <a href="{{ route('posts.index') }}" class="block text-center bg-gray-200 hover:bg-gray-300 text-blue-500 font-semibold py-2 px-4 rounded-md">Volver</a>
        </div>
    </div>
</x-app-layout>
