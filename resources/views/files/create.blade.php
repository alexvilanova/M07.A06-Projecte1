<x-app-layout>
<form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="upload">Selecciona un Archivo</label>
                <input type="file" name="upload" class="form-control" accept=".jpg, .jpeg, .png, .gif" required>
            </div>
            <button type="submit" class="btn btn-primary">Subir Archivo</button>
        </form>
</x-app-layout>
