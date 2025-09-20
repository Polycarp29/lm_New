<aside class="bg-white shadow-lg border-r fixed inset-y-0 left-0 z-30 w-64 flex flex-col">
    <div class="px-6 py-4 border-b">
        @livewire('components.user-dashboard-logo')
    </div>

    <nav class="flex-1 overflow-y-auto mt-4">
        <ul class="space-y-2 px-4">

            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-100 transition {{ request()->routeIs('dashboard') ? 'bg-gray-100 text-blue-600 font-semibold' : 'text-gray-700' }}">
                    <div class="bg-gray-100 p-2 rounded-md">
                        <!-- Dashboard Icon -->
                        <!-- Keep your SVG here -->
                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><!-- Icon content --></svg>
                    </div>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('tasks') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-100 transition {{ request()->routeIs('tasks') ? 'bg-gray-100 text-blue-600 font-semibold' : 'text-gray-700' }}">
                    <div class="bg-gray-100 p-2 rounded-md">
                        <!-- Tasks Icon -->
                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20"><!-- Icon content --></svg>
                    </div>
                    <span>Tasks</span>
                </a>
            </li>

            <li>
                <a href="{{ route('payments') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-100 transition {{ request()->routeIs('payments') ? 'bg-gray-100 text-blue-600 font-semibold' : 'text-gray-700' }}">
                    <div class="bg-gray-100 p-2 rounded-md">
                        <!-- Payments Icon -->
                        <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><!-- Icon content --></svg>
                    </div>
                    <span>Payments</span>
                </a>
            </li>

            <li>
                <a href="#"
                   class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-100 transition text-gray-700">
                    <div class="bg-gray-100 p-2 rounded-md">
                        <!-- Notifications Icon -->
                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><!-- Icon content --></svg>
                    </div>
                    <span>Notifications</span>
                </a>
            </li>

            <!-- Section Divider -->
            <li class="pt-4">
                <h6 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3">Account Settings</h6>
            </li>

            <li>
                <a href="{{ route('profile') }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-100 transition {{ request()->routeIs('profile') ? 'bg-gray-100 text-blue-600 font-semibold' : 'text-gray-700' }}">
                    <div class="bg-gray-100 p-2 rounded-md">
                        <!-- Profile Icon -->
                        <svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20"><!-- Icon content --></svg>
                    </div>
                    <span>Profile</span>
                </a>
            </li>

        </ul>
    </nav>
</aside>
