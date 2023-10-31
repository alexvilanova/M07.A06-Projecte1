<x-app-layout>
<form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="upload">Selecciona un Archivo</label>
                <input type="file" name="upload" class="form-control" accept=".jpg, .jpeg, .png, .gif">
            </div>
            <button type="submit" class="btn btn-primary">Subir Archivo</button>
        </form>
        <a href="{{ route('files.index') }}" class="btn btn-primary">Volver</a>
</x-app-layout>
