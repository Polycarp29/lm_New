<x-filament-panels::page>
    <div class="max-w-3xl mx-auto px-4 py-8">
        {{-- Optional Title --}}
        @if (!empty($taskData->main_title))
            <h1 class="text-4xl font-bold mb-6">{{ $taskData->main_title }}</h1>
        @endif

        {{-- Optional Meta Information --}}
        <div class="text-sm text-gray-500 mb-8">
            @if (!empty($taskData->author))
                <span>By {{ $taskData->author }}</span>
            @endif
            @if (!empty($taskData->published_at))
                <span> • {{ \Carbon\Carbon::parse($taskData->published_at)->format('F j, Y') }}</span>
            @endif
        </div>

        {{-- Blog Content --}}
        <div class="prose prose-lg max-w-none">
            {!! $taskData->content !!}
        </div>
    </div>
</x-filament-panels::page>
