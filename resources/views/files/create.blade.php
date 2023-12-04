<x-app-layout>
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white bg-opacity-60 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form method="POST" id="create-file-form" action="{{ route('files.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="upload">Selecciona un Archivo</label>
                        <input type="file" name="upload" class="form-control" accept=".jpg, .jpeg, .png, .gif">
                    </div>
                    <span id="upload-error" class="w-full text-sm text-white bg-red-600 "></span>
                    <button type="submit" class="btn btn-primary hover:underline ">Subir Archivo</button>
                </form>
                <a href="{{ route('files.index') }}" class="btn btn-primary hover:underline">Volver</a>
        </div>
</div>
</x-app-layout>
