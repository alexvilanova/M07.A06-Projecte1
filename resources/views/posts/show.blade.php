<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publication details') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <img class="w-full h-64 object-cover mb-4 rounded-lg"
                        src="{{ asset("storage/{$post->file->filepath}") }}" alt="Post Image">
                </div>
                <div>
                    <p class="mb-2"><strong>{{ __('User') }}:</strong> {{ $post->user->name }}</p>
                    <p class="mb-2"><strong>{{ __('File Size') }}:</strong> {{ $post->file->filesize }} bytes</p>
                    <p class="mb-2"><strong>{{ __('Description') }}:</strong> {{ $post->description }}</p>
                    <p class="mb-2"><strong>{{ __('Publication Date') }}:</strong> {{ $post->created_at->format('d M Y H:i') }}</p>
                    <p class="mb-2"><strong>{{ __('Likes') }}:</strong> {{ $post->liked()->count() }}</p>
                    <p class="mb-2"><strong>{{ __('Visibility') }}:</strong> {{ __($post->visibility->name) }}</p>

                    <hr class="my-6">

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('posts.index', $post->id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mr-2">
                            <i class="fas fa-list"></i> <i class="fi fi-sr-undo-alt"></i>
                        </a>
                        @can('update', $post)
                        <a href="{{ route('posts.edit', $post->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded mr-2">
                            <i class="fas fa-edit"></i> <i class="fi fi-sr-blog-pencil"></i>
                        </a>
                        @endcan
                        <!-- @can('delete', $post) -->
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                                <i class="fas fa-trash-alt"></i> <i class="fi fi-sr-trash-xmark"></i>
                            </button>
                        </form>
                        <!-- @endcan -->
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-lg mt-4">
            @include('posts.comments.create')
            @include('posts.comments.list', ['comments' => $comments])
            {{ $comments->links() }}
        </div>
    </div>
</x-app-layout>