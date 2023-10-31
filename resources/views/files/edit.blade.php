<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Files') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="upload">Selecciona un Archivo</label>
                            <input type="file" name="upload" class="form-control" accept=".jpg, .jpeg, .png, .gif" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Archivo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
