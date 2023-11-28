<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 flex justify-between items-center">
                        <form action="{{ route('posts.search') }}" method="get" class="flex">
                            <input type="text" name="query" placeholder="Buscar posts..."
                                class="border rounded-l-md p-2 w-64">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded-r-md p-2">
                                <i class="fi fi-br-search"></i>
                            </button>
                        </form>
                        @can('create', App\Models\Post::class)
                        <a href="{{ route('posts.create') }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded"><i
                                class="fi fi-br-plus"></i></a>
                        @endcan
                    </div>
                    @foreach ($posts as $post)
                        <div class="mb-8 border p-3 rounded shadow mx-auto sm:w-full md:w-1/1 lg:w-1/1 xl:w-1/1">
                            <p class="text-lg font-semibold">
                                {{ $post->user ? $post->user->name : 'No hay información disponible' }}</p>
                            <a href="{{ route('posts.show', $post) }}">
                                <img class="img-fluid mt-2" src="{{ asset('storage/' . $post->file->filepath) }}"
                                    alt="Imagen" />
                            </a>
                            <br>
                            <div class="flex items-center justify-between mt-2">
                                <div class="text-sm">{!! $post->title !!}</div>
                                <div class="flex items-center space-x-2">
                                    <p class="text-sm">{{ $post->liked()->count() }}</p>
                                    @can('like',App\Models\Post::class )
                                        @if (!auth()->user()->likes->contains($post))
                                            <form method="POST" action="{{ route('posts.likes', $post) }}">
                                                @csrf
                                                <button type="submit" class="text-red-500 text-sm"><i
                                                        class="fi fi-br-heart"></i></button>
                                            </form>
                                        @endif
                                        @if (auth()->user()->likes->contains($post))
                                            <form method="POST" action="{{ route('posts.unlike', $post) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 text-sm"><i
                                                        class="fi fi-ss-heart"></i></button>
                                            </form>
                                        @endif
                                    @else
                                        <button type="submit" class="text-red-500 text-sm"><i
                                                            class="fi fi-ss-heart"></i></button>

                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>