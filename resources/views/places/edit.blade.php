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
                    <form action="{{ route('places.update', $place->id) }}" id="update-place-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 ">
                            <label for="name" class="block text-sm font-semibold text-gray-600">{{__('Name')}}</label>
                            <input type="text" name="name" class="w-full p-2 border rounded-md" value="{{ $place->name }}">
                            <span id="error-name" class="text-red-500"></span>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-semibold text-gray-600">{{__('Description')}}</label>
                            <textarea name="description" class="w-full p-2 border rounded-md">{{ $place->description }}</textarea>
                            <span id="error-description" class="text-red-500"></span>
                        </div>

                        <div class="mb-4">
                            <label for="imagen" class="block text-sm font-semibold text-gray-600">{{__('Image')}}</label>
                            <input type="file" name="imagen" class="w-full p-2 border rounded-md" accept=".jpg, .jpeg, .png, .gif">
                        </div>

                        <div class="mb-4">
                            <label for="latitude" class="block text-sm font-semibold text-gray-600">{{__('Latitude')}}</label>
                            <input type="text" name="latitude" class="w-full p-2 border rounded-md" value="{{ $place->latitude }}">
                            <span id="error-latitude" class="text-red-500"></span>
                        </div>

                        <div class="mb-4">
                            <label for="longitude" class="block text-sm font-semibold text-gray-600">{{__('Longitude')}}</label>
                            <input type="text" name="longitude" class="w-full p-2 border rounded-md" value="{{ $place->longitude }}">
                            <span id="error-longitude" class="text-red-500"></span>
                        </div>
                        <div class="mb-4">
                            <label for="visibility" class="block text-sm font-medium text-gray-600">{{ __('Visibility') }}</label>
                            <select name="visibility_id" id="visibility" class="mt-1 p-2 w-full border rounded-md">
                                @foreach($visibilities as $visibility)
                                    <option value="{{ $visibility->id }}" @if($visibility->id == $place->visibility->id) selected @endif>
                                    {{ __($visibility->name)  }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="error-visibility" class="text-red-500"></span>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">{{__('Update Place')}}</button>

                        <a href="{{ route('places.show', $place) }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">{{__('Home')}}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>