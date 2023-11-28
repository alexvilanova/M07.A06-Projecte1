<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Places') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 flex justify-between items-center">
                        <form action="{{ route('places.search') }}" method="get" class="flex">
                            <input type="text" name="query" placeholder="{{ __('Search places...') }}"
                                class="border rounded-l-md p-2 w-64">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white rounded-r-md p-2">
                                <i class="fi fi-br-search"></i>
                            </button>
                        </form>
                        @can('create', App\Models\Place::class)
                        <a href="{{ route('places.create') }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded"><i class="fi fi-br-plus"></i></a>
                        @endcan
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4">
                        @foreach ($places as $place)
                        <div class="relative bg-white overflow-hidden shadow-lg sm:rounded-lg">
                            <div class="relative group">
                                <a href="{{ route('places.show', $place)}}">
                                    @if ($place->file)
                                    <img src="{{ asset('storage/' . $place->file->filepath) }}" alt="Imagen del lugar"
                                        class="w-full h-64 object-cover transition-opacity duration-300 hover:opacity-75 rounded-t-md">
                                    @endif
                                        <div class="absolute inset-0 flex items-center justify-center">
                                        <h2 class="text-white text-lg font-semibold">{{ $place->name }}</h2>
                                    </div>

                                    <div
                                        class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black to-transparent group-hover:from-transparent group-hover:to-black">
                                        @can('like',App\Models\Place::class )
                                        @if (!auth()->user()->favorites->contains($place))
                                        <form method="POST" action="{{ route('places.favorite', $place) }}">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded"><i class="fi fi-br-plus"></i> {{__('Favourite')}}</button>
                                        </form>
                                        @endif
                                        @if (auth()->user()->favorites->contains($place))
                                        <form method="POST" action="{{ route('places.unfavorite', $place) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded"><i class="fi fi-br-x"></i>{{__('Remove Favourite')}}</button>
                                        </form>
                                        @endif
                                        @endcan
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{ $places->links() }}
        </div>
    </div>
</x-app-layout>