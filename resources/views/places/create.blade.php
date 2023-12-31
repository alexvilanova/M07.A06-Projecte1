<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Place') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white bg-opacity-60 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('places.store') }}" id="create-place-form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-600">{{__('Name')}}</label>
                        <input type="text" name="name" class="w-full p-2 border rounded-md">
                        <span id="error-name" class="text-red-500"></span>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-semibold text-gray-600">{{__('Description')}}</label>
                        <textarea name="description" class="w-full p-2 border rounded-md"></textarea>
                        <span id="error-description" class="text-red-500"></span>
                    </div>
                    <div class="mb-4">
                        <label for="upload" class="block text-sm font-semibold text-gray-600">{{__('Image')}}</label>
                        <input type="file" name="upload" class="w-full p-2 border rounded-md" accept=".jpg, .jpeg, .png, .gif">
                        <span id="error-upload" class="text-red-500"></span>
                    </div>
                    <div class="mb-4">
                        <label for="latitude" class="block text-sm font-semibold text-gray-600">{{__('Latitude')}}</label>
                        <input type="text" name="latitude" class="w-full p-2 border rounded-md">
                        <span id="error-latitude" class="text-red-500"></span>
                    </div>
                    <div class="mb-6">
                        <label for="longitude" class="block text-sm font-semibold text-gray-600">{{__('Longitude')}}</label>
                        <input type="text" name="longitude" class="w-full p-2 border rounded-md">
                        <span id="error-longitude" class="text-red-500"></span>
                    </div>
                    <div class="mb-4">
                        <label for="visibility" class="block text-sm font-medium text-gray-600">{{ __('Visibility') }}</label>
                        <select name="visibility_id" id="visibility" class="mt-1 p-2 w-full border rounded-md">
                            @foreach($visibilities as $visibility)
                                <option value="{{ $visibility->id }}">{{ __($visibility->name)  }}</option>
                            @endforeach
                        </select>
                        <span id="error-visibility" class="text-red-500"></span>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">{{__('Save Place')}}</button>
                        <a href="{{ route('places.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">{{__('Back')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
