<div class="p-6 bg-white rounded-xl shadow-md mt-4">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-900">Assigned Tasks</h2>
        <input type="text" wire:model.live="search" placeholder="Search tasks..."
            class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none" />
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto text-left text-sm text-gray-900">
            <thead class="bg-gray-100 text-gray-700 font-bold uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Task</th>
                    <th class="px-6 py-4">Category Name</th>
                    <th class="px-6 py-4">Secondary Keywords</th>
                    <th class="px-6 py-4">Due Date</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($fetchTaskData as $task)
                <tr>
                    <td class="px-6 py-4 font-semibold">{{ $task->main_title ?? 'No Title' }}</td>
                    <td class="px-6 py-4">{{ $task->taskcategory->task_name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{!! $task->secondary_keywords ?? 'N/A' !!}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($task->due_date)->format('F d, Y') }}</td>
                    <td class="px-6 py-4">
                        @php
                        $status = $task->progress ?? 'Pending';
                        $statusColor = match($status) {
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'in_progress' => 'bg-blue-100 text-blue-800',
                        'done' => 'bg-green-100 text-green-800',
                        default => 'bg-gray-100 text-gray-800'
                        };
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $statusColor }}">
                            {{ $status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex justify-center space-x-2">
                        <a href="{{ route('viewTask', ['taskId' => $task->id])}}"
                            class="text-xs bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                            View
                    </a>
                        <button wire:click="acceptedTask({{$task->id}})"
                            class="text-xs bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                            Accept
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">No tasks found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="flex justify-between items-center mt-6">
        <span class="text-sm text-gray-600">
            Showing {{ $fetchTaskData->firstItem() }} to {{ $fetchTaskData->lastItem() }} of {{ $fetchTaskData->total()
            }} tasks
        </span>
        <div class="flex space-x-2">
            @if ($fetchTaskData->onFirstPage())
            <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 rounded cursor-not-allowed">Prev</span>
            @else
            <button wire:click="previousPage"
                class="px-3 py-1 text-sm text-gray-600 bg-gray-100 rounded hover:bg-gray-200">Prev</button>
            @endif

            @foreach ($fetchTaskData->getUrlRange(1, $fetchTaskData->lastPage()) as $page => $url)
            @if ($page == $fetchTaskData->currentPage())
            <button class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">{{ $page }}</button>
            @else
            <button wire:click="gotoPage({{ $page }})"
                class="px-3 py-1 text-sm text-gray-600 bg-gray-100 rounded hover:bg-gray-200">{{ $page }}</button>
            @endif
            @endforeach

            @if ($fetchTaskData->hasMorePages())
            <button wire:click="nextPage"
                class="px-3 py-1 text-sm text-gray-600 bg-gray-100 rounded hover:bg-gray-200">Next</button>
            @else
            <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 rounded cursor-not-allowed">Next</span>
            @endif
        </div>
    </div>


</div>