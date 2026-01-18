<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-blue-600">
                PentaWork
            </a>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex items-center gap-8">

                <a href="{{ route('dashboard') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium">
                    Dashboard
                </a>

                <a href="{{ route('jobs.index') }}"
                   class="text-gray-700 hover:text-blue-600 font-medium">
                    Jobboard
                </a>

                <!-- Profile with dropdown -->
                <div class="relative" x-data="{ openDropdown: false }">
                    <button @click="openDropdown = !openDropdown"
                        class="w-10 h-10 rounded-full overflow-hidden border border-gray-300">
                        <img src="/image/default-profile.png" alt="Profile">
                    </button>

                    <div x-show="openDropdown" @click.outside="openDropdown = false"
                        class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md py-2 z-50">

                        <a href="{{ route('profile') }}"
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Hamburger -->
            <button @click="open = !open" class="sm:hidden text-gray-600 hover:text-gray-900">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'block': !open }" class="block"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !open, 'block': open }" class="hidden"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="sm:hidden" x-show="open" @click.outside="open = false">
        <div class="px-4 pt-3 pb-3 space-y-3">

            <a href="{{ route('dashboard') }}"
               class="block text-gray-700 font-medium hover:text-blue-600">
                Dashboard
            </a>

            <a href="{{ route('jobs.index') }}"
               class="block text-gray-700 font-medium hover:text-blue-600">
                Jobboard
            </a>

            <hr class="my-2">

            <div class="text-gray-800 font-semibold">{{ Auth::user()->name }}</div>
            <div class="text-gray-500 text-sm mb-3">{{ Auth::user()->email }}</div>

            <a href="{{ route('profile') }}"
               class="block text-gray-700 hover:text-blue-600">
               Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block w-full text-left text-gray-700 hover:text-blue-600 mt-2">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</nav>
