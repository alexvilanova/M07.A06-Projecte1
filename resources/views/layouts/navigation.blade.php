<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800 dark:text-gray-200">
                    SOCIAL HUB                
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-4 sm:flex">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard*')">
                    {{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts*')">
                    {{ __('Posts') }}
                </x-nav-link>
                @can('viewAny', App\Models\File::class)
                <x-nav-link :href="route('files.index')" :active="request()->routeIs('files*')">
                    {{ __('Files') }}
                </x-nav-link>
                @endcan
                <x-nav-link :href="route('places.index')" :active="request()->routeIs('places*')">
                    {{ __('Places') }}
                </x-nav-link>
                <!-- ABOUT -->
                <x-nav-link :href="route('about.index')" :active="request()->routeIs('about*')">
                    {{ __('About') }}
                </x-nav-link>

            </div>

            <!-- User Dropdown -->
            
            <div class="hidden sm:flex items-center space-x-4">
                <x-language-switcher />
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Icon for Mobile -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="inline-flex items-center text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard*')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts*')">
                {{ __('Posts') }}
            </x-responsive-nav-link>
            <!-- Enlace a files.index -->
            @can('viewAny', App\Models\File::class)
            <x-responsive-nav-link :href="route('files.index')" :active="request()->routeIs('files.*')">
                {{ __('Files') }}
            </x-responsive-nav-link>
            @endcan
            <!-- Enlace a places.index -->
            <x-responsive-nav-link :href="route('places.index')" :active="request()->routeIs('places.*')">
                {{ __('Places') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive User Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>