<x-layouts.main>
            <!-- Page Content -->
            <main class="p-12">
                <h2 class="text-2xl font-bold text-red-600 mb-6">Overview</h2>
                @livewire('pages.user.actions.dashboard-overview')

                <div class="px-2 py-4">
                    <h1 class="text-2xl text-red-600 font-bold">
                        Task Overview Analytics
                    </h1>
                </div>

                @livewire('pages.user.actions.dashboard-analytics')
                @livewire('pages.user.actions.dashboard-tasks')
            </main>

        </div>

    <!-- Sidebar Toggle Script -->
    <script>
        const toggleBtn = document.getElementById('mobile-menu-button');
      const mobileSidebar = document.getElementById('mobile-sidebar');

      toggleBtn.addEventListener('click', () => {
        mobileSidebar.classList.toggle('-translate-x-full');
      });
    </script>
</x-layouts.main>
