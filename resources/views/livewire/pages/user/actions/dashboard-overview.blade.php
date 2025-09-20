<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Total Tasks -->
    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition duration-300">
        <div class="flex items-center gap-5">
            <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-6h6v6m2 4H7a2 2 0 01-2-2V7a2 2 0 012-2h3l2-2h2l2 2h3a2 2 0 012 2v12a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">{{ $taskCount }}</h3>
                <p class="text-sm text-gray-600">Total Tasks</p>
                <span class="text-xs text-gray-400">Monthly overview of assigned tasks</span>
            </div>
        </div>
    </div>

    <!-- Rejected Tasks -->
    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition duration-300">
        <div class="flex items-center gap-5">
            <div class="flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-yellow-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">0</h3>
                <p class="text-sm text-gray-600">Rejected Tasks</p>
                <span class="text-xs text-gray-400">Track all disapproved submissions</span>
            </div>
        </div>
    </div>

    <!-- Approved Tasks -->
    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition duration-300">
        <div class="flex items-center gap-5">
            <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div>
                <h3 class="text-xl font-semibold text-gray-800">{{ $approvedTasks }}</h3>
                <p class="text-sm text-gray-600">Approved Tasks</p>
                <span class="text-xs text-gray-400">Monthly review of completed work</span>
            </div>
        </div>
    </div>

</div>