<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Places') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white bg-opacity-40 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white bg-opacity-40 border-b border-gray-200">
                    <form action="{{ route('places.update', $place->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 ">
                            <label for="name" class="block text-sm font-semibold text-gray-600">{{__('Name')}}</label>
                            <input type="text" name="name" class="w-full p-2 border rounded-md" value="{{ $place->name }}">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-semibold text-gray-600">{{__('Description')}}</label>
                            <textarea name="description" class="w-full p-2 border rounded-md">{{ $place->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="imagen" class="block text-sm font-semibold text-gray-600">{{__('Image')}}</label>
                            <input type="file" name="imagen" class="w-full p-2 border rounded-md" accept=".jpg, .jpeg, .png, .gif">
                        </div>

                        <div class="mb-4">
                            <label for="latitude" class="block text-sm font-semibold text-gray-600">{{__('Latitude')}}</label>
                            <input type="text" name="latitude" class="w-full p-2 border rounded-md" value="{{ $place->latitude }}">
                        </div>

                        <div class="mb-4">
                            <label for="longitude" class="block text-sm font-semibold text-gray-600">{{__('Longitude')}}</label>
                            <input type="text" name="longitude" class="w-full p-2 border rounded-md" value="{{ $place->longitude }}">
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">{{__('Update Place')}}</button>

                        <a href="{{ route('places.show', $place) }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">{{__('Home')}}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>