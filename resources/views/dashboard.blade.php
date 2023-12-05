<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-8 bg-white border-b border-blue-200 text-center rounded-lg shadow-xl">
                <h3 class="text-4xl mb-6 text-blue-600">{{ __('Get Started') }}</h3>
                <div class="flex justify-center space-x-6">
                    <a href="{{ route('posts.index') }}"
                        class="btn bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-full transition duration-300 ease-in-out">{{ __('Explore Posts') }}</a>
                    <a href="{{ route('places.index') }}"
                        class="btn bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-full transition duration-300 ease-in-out">{{ __('Discover Places') }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
