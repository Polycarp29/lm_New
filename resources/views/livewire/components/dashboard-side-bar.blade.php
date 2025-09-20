<div>
    <!-- Sidebar (Desktop) -->
    <aside class="hidden lg:flex flex-col w-64 bg-white shadow-md p-6 space-y-6 min-h-screen">
        <div class="h-20 flex items-center justify-center overflow-hidden">
            <img src="{{ asset('storage/' . $data->logo) }}"
                 alt="Company Logo"
                 class="h-10 object-contain" />
        </div>
        <nav class="flex flex-col space-y-3 text-gray-900 font-bold pt-6">
            <a href="{{ route('dashboard')}}"
                class="flex items-center space-x-4 p-3 rounded-xl bg-gray-50 hover:bg-yellow-100 text-gray-900
                {{ request()->routeIs('dashboard') ? 'bg-yellow-100 text-red-500' : ''}}
                hover:text-red-600 shadow transition no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M3 6h18M4 14h16v6H4z" />
                </svg>
                <span class="no-underline">Dashboard</span>
            </a>

            <a href="{{route('tasks_get')}}"
                class="flex items-center space-x-4 p-3 rounded-xl bg-gray-50 hover:bg-yellow-100 text-gray-900 hover:text-red-600
                {{ request()->routeIs('tasks_get') ? 'bg-yellow-100 text-red-500' : ''}}
                shadow transition no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2a4 4 0 00-4-4H3m6 6h6m6-6h-3a4 4 0 00-4 4v2m0 0v6" />
                </svg>
                <span class="no-underline">Tasks</span>
            </a>

            <a href="{{ route('get_notifications')}}"
                class="flex items-center space-x-4 p-3 rounded-xl bg-gray-50 hover:bg-yellow-100 text-gray-900
                {{ request()->routeIs('get_notifications') ? 'bg-yellow-100 text-red-500' : ''}}
                hover:text-red-600 shadow transition no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="no-underline">Notifications</span>
            </a>

            <a href="{{ route('profile')}}"
                class="flex items-center space-x-4 p-3 rounded-xl bg-gray-50 hover:bg-yellow-100 text-gray-900
                {{ request()->routeIs('profile') ? 'bg-yellow-100 text-red-500' : ''}}
                hover:text-red-600 shadow transition no-underline ">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A4 4 0 0112 20a4 4 0 016.879-2.196M15 11a3 3 0 01-6 0 3 3 0 016 0z" />
                </svg>
                <span class="no-underline">Profile</span>
            </a>
            <form method="POST" action={{ route('logout')}}>
                @csrf
                <button
                class="flex items-center space-x-4 p-3  text-gray-900 hover:text-red-600  transition no-underline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                </svg>
                <span class="no-underline">Logout</span>
            </button>
            </form>

        </nav>

    </aside>

    <!-- Mobile Sidebar Toggle Button -->
    <div class="lg:hidden absolute top-4 left-4 z-50">
        <button id="mobile-menu-button" class="text-gray-700 focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Sidebar (Mobile) -->
    <div id="mobile-sidebar"
        class="lg:hidden fixed inset-y-0 left-0 w-64 bg-white shadow-md p-6 transform -translate-x-full transition-transform duration-300 ease-in-out z-40">
        <div class="text-2xl font-bold text-red-600 mb-6">Admin Panel</div>
        <nav class="flex flex-col space-y-4 text-gray-700 font-medium">
            <a href="#" class="hover:text-red-600">📊 Dashboard</a>
            <a href="#" class="hover:text-red-600">👥 Users</a>
            <a href="#" class="hover:text-red-600">📈 Reports</a>
            <a href="#" class="hover:text-red-600">⚙️ Settings</a>
            <a href="#" class="hover:text-red-600">🚪 Logout</a>
        </nav>
    </div>
</div>
