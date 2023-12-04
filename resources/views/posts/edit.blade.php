<x-app-layout>
    <div class="max-w-5xl mx-auto bg-white bg-opacity-40 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{__('Upload File')}}</h2>
        <form method="POST" action="{{ route('posts.update', $post->id) }}" id="update-post-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-600">{{__('Title')}}</label>
                <input type="text" value="{{ $post->title }}" name="title" id="title" class="mt-1 p-2 w-full border rounded-md">
                <span id="error-title" class="text-red-500"></span>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-600">{{__('Description')}}</label>
                <textarea name="description" id="description" class="mt-1 p-2 w-full border rounded-md" rows="4">{{ $post->description }}</textarea>
                <span id="error-description" class="text-red-500"></span>
            </div>

            <div class="mb-4">
                <img class="img-fluid w-20 h-20 mb-4" src="{{ asset("storage/{$post->file->filepath}") }}" alt="Your image" />
                <label for="upload" class="block text-sm font-medium text-gray-600">{{__('Select a File')}}</label>
                <input type="file" name="upload" id="upload" class="mt-1 p-2 w-full border rounded-md" accept=".jpg, .jpeg, .png, .gif">
            </div>
            <div class="mb-4">
                <label for="visibility" class="block text-sm font-medium text-gray-600">{{ __('Visibility') }}</label>
                <select name="visibility_id" id="visibility" class="mt-1 p-2 w-full border rounded-md">
                    @foreach($visibilities as $visibility)
                        <option value="{{ $visibility->id }}" @if($visibility->id == $post->visibility->id) selected @endif>
                            {{ __($visibility->name)  }}
                        </option>
                    @endforeach
                </select>
                <span id="error-visibility" class="text-red-500"></span>
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600">{{__('Upload File')}}</button>
            </div>
        </form>
        <div class="mt-4">
            <a href="{{ route('posts.show', $post) }}" class="block text-center bg-gray-200 hover:bg-gray-300 text-blue-500 font-semibold py-2 px-4 rounded-md">{{__('Back')}}</a>
        </div>
    </div>
</x-app-layout>
