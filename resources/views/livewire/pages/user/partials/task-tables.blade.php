<div class="overflow-x-auto mb-10">
    <table class="min-w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-100 text-xs uppercase text-gray-500">
            <tr>
                <th class="px-6 py-3">Category</th>
                <th class="px-6 py-3">Main Keyword</th>
                <th class="px-6 py-3">Main Title</th>
                <th class="px-6 py-3">Secondary Keywords</th>
                <th class="px-6 py-3">Due Date</th>
                <th class="px-6 py-3">Task Issuer</th>
                <th class="px-6 py-3">Status</th>
                @if($type == 'rejected')
                <th class="px-6 py-3">Task Status</th>
                @endif
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
            @forelse ($tasks as $task)
                <tr class="border-b hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">{{ $task->taskcategory->task_name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $task->main_keyword }}</td>
                    <td class="px-6 py-4">{{ $task->main_title }}</td>
                    <td class="px-6 py-4">{!! $task->secondary_keywords !!}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($task->due_date)->format('F d, Y') }}</td>
                    <td class="px-6 py-4">
                        @if($task->taskcategory && $task->taskcategory->tasktypes)
                            @foreach ($task->taskcategory->tasktypes as $tasktype)
                                <div class="text-sm font-semibold">{{ $tasktype->type_name }}</div>
                                @if($tasktype->taskinsurer)
                                    @foreach($tasktype->taskinsurer as $insurer)
                                        <div class="text-xs text-gray-600">{{ $insurer->issuer_name }}</div>
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            <div class="text-gray-400 text-xs">N/A</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-2 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                            {{ ucfirst(str_replace('_', ' ', $task->progress)) }}
                        </span>
                    </td>
                    @if($type == 'rejected')
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-2 text-xs font-semibold bg-red-100 text-red-800 rounded-full">
                            {{ ucfirst(str_replace('_', ' ', $task->taskstatus)) }}
                        </span>
                    </td>
                    @endif
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('viewTask', ['taskId' => $task->id]) }}"
                           class="inline-flex items-center px-3 py-1 text-sm font-medium text-indigo-600 hover:text-indigo-800 hover:underline focus:outline-none">
                            View
                        </a>

                        @if($type == 'rejected')
                            <button wire:click="redoTask({{ $task->id }})"
                                    class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 bg-red-100 hover:text-red-800 hover:underline focus:outline-none rounded shadow">
                                Redo
                            </button>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $type == 'rejected' ? '9' : '8' }}" class="px-6 py-4 text-center text-gray-400">
                        No tasks found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="p-4 flex justify-center">
        <nav class="inline-flex space-x-2">
            {{-- Previous Page --}}
            @if ($tasks->currentPage() > 1)
                <button wire:click="previousPage" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Prev
                </button>
            @else
                <span class="px-4 py-2 text-gray-400 bg-gray-200 rounded">Prev</span>
            @endif

            {{-- Page Numbers --}}
            @for ($page = 1; $page <= $tasks->lastPage(); $page++)
                @if ($page == $tasks->currentPage())
                    <span class="px-4 py-2 bg-red-600 text-white rounded">{{ $page }}</span>
                @else
                    <button wire:click="gotoPage({{ $page }})" class="px-4 py-2 bg-white border rounded hover:bg-gray-100">
                        {{ $page }}
                    </button>
                @endif
            @endfor

            {{-- Next Page --}}
            @if ($tasks->hasMorePages())
                <button wire:click="nextPage" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Next
                </button>
            @else
                <span class="px-4 py-2 text-gray-400 bg-gray-200 rounded">Next</span>
            @endif
        </nav>
    </div>

</div>
