<header class="h-16 bg-white border-b border-gray-200 sticky top-0 z-30 flex items-center justify-between px-4 md:px-8">
    
    <div class="flex items-center flex-1">
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 mr-3 text-gray-600 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
        </button>

        <div class="hidden md:block w-full max-w-xs">
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" placeholder="Search dashboard..." class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-xl bg-gray-50 text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all duration-200">
            </div>
        </div>
    </div>

    <div class="flex items-center space-x-3">
        
        <button class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors relative">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-2 right-2.5 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
        </button>

        <div class="h-6 w-px bg-gray-200 mx-1"></div>

        <div class="relative">
            <x-dropdown align="right" width="56">
                <x-slot name="trigger">
                    <button class="flex items-center p-1 rounded-full hover:bg-gray-100 transition-all duration-200 focus:outline-none">
                        <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="hidden md:flex flex-col items-start ml-2 mr-1">
                            <span class="text-sm font-semibold text-gray-700 leading-none">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] text-gray-400 uppercase tracking-wider mt-1 leading-none">Administrator</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-2 border-b border-gray-100 bg-gray-50/50 rounded-t-md">
                        <p class="text-xs text-gray-500">Signed in as</p>
                        <p class="text-sm font-medium text-gray-800 truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <div class="p-1">
                        <x-dropdown-link :href="route('profile')" class="rounded-md flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            {{ __('My Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    class="rounded-md flex items-center gap-2 text-red-600 hover:bg-red-50 hover:text-red-700"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>