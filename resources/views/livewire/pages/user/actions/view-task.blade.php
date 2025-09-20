@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
@endpush
<div class="flex sm:flex md:flex  lg:flex flex-col sm:flex-col lg:flex-row md:flex-col p-8">
    <div class="w-full sm:w-full md:w-full lg:w-1/2 px-4 mb-6">
        <div class="bg-white shadow-lg rounded-2xl p-8">
            <div class="space-y-4">
                <!-- Title -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $taskData->taskcategory->task_name ?? 'Not Set' }}
                    </h2>
                </div>

                <!-- Instructions Section -->
                <div>
                    <h3 class="text-base font-semibold text-gray-700 mb-2">Task Instructions</h3>
                    <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                        {!! $taskData->taskcategory->task_description ?? 'Not Set' !!}
                    </ul>
                </div>
                <div>
                    @php
                        $insurer = $taskData->taskcategory?->tasktypes->first()?->taskinsurer->first();
                    @endphp

                    @if ($insurer)
                        <a href="{{ route('sop.view', ['id' => $insurer->id]) }}"
                            class="px-6 py-2 bg-green-200 font-light text-green-600 rounded-xl
          transition delay-150 duration-300 ease-in-out
          hover:text-green-700 hover:-translate-y-1 hover:scale-110">
                            View Sheet SOP
                        </a>
                    @else
                        <span class="text-red-600">No insurer found</span>
                    @endif

                </div>

            </div>
        </div>
        @php
            $seoData = json_decode($taskData->seo_analysis, true);
        @endphp

        <div class="w-full bg-white shadow p-8 rounded-lg space-y-6 text-gray-800 mt-4">
            <h2 class="text-2xl font-bold flex items-center gap-2 text-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 11V3m0 0l-3.5 3.5M11 3l3.5 3.5M4 21h16a1 1 0 001-1v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2a1 1 0 001 1z" />
                </svg>
                SEO Analysis Summary
            </h2>
            <div class="bg-gray-100 p-4 rounded space-y-2">
                {{-- Score --}}
                <div class="w-full">
                    <h3 class="font-bold mb-2 flex items-center gap-2 text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-3 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6" />
                        </svg>
                        Performance Score
                    </h3>
                    @php
                        $score = is_numeric($seoData['seo_performance_score'] ?? null)
                            ? $seoData['seo_performance_score']
                            : 0;
                        $barColor = match (true) {
                            $score >= 80 => 'bg-green-500',
                            $score >= 60 => 'bg-yellow-500',
                            $score >= 40 => 'bg-orange-500',
                            default => 'bg-red-500',
                        };
                    @endphp
                    <div class="w-full bg-gray-200 rounded-full h-5">
                        <div class="{{ $barColor }} h-5 rounded-full text-white text-sm flex items-center justify-center"
                            style="width: {{ $score }}%">
                            {{ $score }}%
                        </div>
                    </div>
                </div>

                {{-- Main Keyword Usage --}}
                <div>
                    <h3 class="font-bold flex items-center gap-2 text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-yellow-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16h6" />
                        </svg>
                        Main Keyword Usage
                    </h3>
                    @php
                        $keyword = $seoData['main_keyword_usage']['keyword'] ?? 'N/A';
                        $keyword = is_array($keyword) ? implode(', ', $keyword) : $keyword;
                        $frequency = $seoData['main_keyword_usage']['frequency'] ?? 0;
                    @endphp
                    <p><strong>Keyword:</strong> {{ $keyword }}</p>
                    <p><strong>Frequency:</strong> {{ $frequency }}</p>
                    @if (!empty($seoData['main_keyword_usage']['locations']) && is_array($seoData['main_keyword_usage']['locations']))
                        <p><strong>Locations:</strong></p>
                        <ul class="list-disc list-inside">
                            @foreach ($seoData['main_keyword_usage']['locations'] as $location)
                                <li>{{ is_array($location) ? json_encode($location) : $location }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Secondary Keywords --}}
                <div>
                    <h3 class="font-bold flex items-center gap-2 text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h10M7 11h10M7 15h5" />
                        </svg>
                        Secondary Keywords
                    </h3>
                    <div></div>
                    <p><strong>Used:</strong></p>
                    <ul class="list-disc list-inside ml-4">
                        @foreach ($seoData['secondary_keywords_usage']['used_keywords'] ?? [] as $keyword)
                            <li>{{ is_array($keyword) ? implode(', ', $keyword) : $keyword }}</li>
                        @endforeach
                    </ul>
                    @if (
                        !empty($seoData['secondary_keywords_usage']['missing_keywords']) &&
                            is_array($seoData['secondary_keywords_usage']['missing_keywords']))
                        <p class="mt-2 text-red-600"><strong>Missing:</strong></p>
                        <ul class="list-disc list-inside ml-4 text-red-600">
                            @foreach ($seoData['secondary_keywords_usage']['missing_keywords'] as $keyword)
                                <li>{{ is_array($keyword) ? implode(', ', $keyword) : $keyword }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                {{-- Word Count and Headings --}}
                <div>
                    <h3 class="font-bold  text-xl flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6M9 16h6M9 8h6M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Content Stats
                    </h3>
                    <p>
                        <strong>Word Count:</strong>
                        {{ is_array($seoData['word_count'] ?? null) ? implode(', ', $seoData['word_count']) : $seoData['word_count'] ?? 'N/A' }}
                    </p>

                    @php
                        $headings = $seoData['heading_structure'] ?? [];
                        $h1 = is_scalar($headings['H1'] ?? null) ? $headings['H1'] : json_encode($headings['H1'] ?? 0);
                        $h2 = is_scalar($headings['H2'] ?? null) ? $headings['H2'] : json_encode($headings['H2'] ?? 0);
                        $h3 = is_scalar($headings['H3'] ?? null) ? $headings['H3'] : json_encode($headings['H3'] ?? 0);
                    @endphp

                    <p><strong>Headings:</strong>
                        H1: {{ $h1 }},
                        H2: {{ $h2 }},
                        H3: {{ $h3 }}
                    </p>

                </div>

                {{-- Links --}}
                <div>
                    <h3 class="font-bold  text-xl flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 015.657 5.657l-1.414 1.414a4 4 0 01-5.657 0m-2.828-2.828a4 4 0 010-5.657l1.414-1.414a4 4 0 015.657 0" />
                        </svg>
                        Linking
                    </h3>
                    <p><strong>Internal Links:</strong> {{ $seoData['internal_links'] ?? 0 }}</p>
                    <p><strong>External Links:</strong> {{ $seoData['external_links'] ?? 0 }}</p>
                </div>

            </div>










            {{-- Readability & Structure --}}
            <div>
                <div class="bg-green-200 p-4 rounded my-2">
                    <h3 class="font-bold flex items-center gap-2 text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-teal-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Quality
                    </h3>
                    <p><strong>Readability:</strong>
                        {{ is_array($seoData['readability'] ?? null) ? json_encode($seoData['readability']) : $seoData['readability'] ?? 'N/A' }}
                    </p>
                    <p><strong>Structure:</strong>
                        {{ is_array($seoData['content_structure'] ?? null) ? json_encode($seoData['content_structure']) : $seoData['content_structure'] ?? 'N/A' }}
                    </p>
                </div>

                <div class="bg-red-200 p-4 rounded">
                    <p><strong>On-page SEO Issues:</strong>
                        @php
                            $issues = $seoData['on_page_seo_issues'] ?? [];

                            // Ensure it's an array, flatten if nested, and stringify all values
if (!is_array($issues)) {
    $output = $issues ?: 'None';
} else {
    $flatten = collect($issues)
        ->flatten()
        ->map(function ($item) {
            return is_scalar($item) ? (string) $item : json_encode($item);
        });
    $output = $flatten->implode(', ') ?: 'None';
                            }
                        @endphp

                        {{ $output }}
                    </p>
                </div>

            </div>

            {{-- Recommendations --}}
            @if (!empty($seoData['recommendations']) && is_array($seoData['recommendations']))
                <div class="bg-gray-200 p-4 rounded">
                    <h3 class="font-bold  text-xl flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Recommendations
                    </h3>
                    <ul class="list-disc list-inside ml-4 text-blue-800">
                        @foreach ($seoData['recommendations'] as $rec)
                            <li>{{ is_array($rec) ? json_encode($rec) : $rec }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>




    </div>
    <div class="w-full sm:w-full md:w-full lg:w-1/2 px-4">
        <div class="bg-white shadow-lg rounded-2xl p-8">
            <div class="space-y-6">
                <!-- Section Header -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Task Details</h2>
                    <p class="text-sm text-gray-500 mt-1">Overview and submission panel for current content task.</p>
                </div>

                <!-- Task Info -->
                <div class="border-t pt-6">
                    <div class="bg-white shadow-md rounded-xl overflow-hidden divide-y divide-gray-200">

                        <!-- Main Keyword & Header Title -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6 bg-gray-50">
                            <div>
                                <h2 class="text-sm font-medium text-gray-500 uppercase">Main Keyword</h2>
                                <p class="text-lg font-semibold text-gray-800">{{ $taskData->main_keyword }}</p>
                            </div>
                            <div>
                                <h2 class="text-sm font-medium text-gray-500 uppercase">Header Title</h2>
                                <p class="text-lg font-semibold text-gray-800">{{ $taskData->main_title }}</p>
                            </div>
                        </div>

                        <!-- Secondary Keywords -->
                        <div class="p-6 bg-gray-50">
                            <h2 class="text-sm font-medium text-gray-500 uppercase mb-2">Secondary Keywords</h2>
                            <ul class="list-disc list-inside space-y-1 text-gray-700 text-sm">
                                <p>{!! $taskData->secondary_keywords ?? 'Not Set' !!}</p>

                            </ul>
                        </div>

                        <!-- Picture Keywords -->
                        <div class="p-6 bg-gray-50">
                            <h2 class="text-sm font-medium text-gray-500 uppercase mb-2">Picture Keywords</h2>
                            <ul class="list-disc list-inside space-y-1 text-gray-700 text-sm">
                                <p>
                                    {!! $taskData->keyword_photo ?? 'Not Set' !!}
                                </p>
                            </ul>
                        </div>

                        {{-- Suggested Topics --}}

                        <div class="p-6 bg-gray-50">
                            <h2 class="text-sm font-medium text-gray-500 uppercase mb-2">Suggested Topics</h2>
                            <ul class="list-disc list-inside space-y-1 text-gray-700 text-sm">
                                <p>{!! $taskData->suggested_topics ?? 'Not Set' !!}</p>
                            </ul>
                        </div>

                        <div class="p-6 bg-gray-50">
                            <h2 class="text-sm font-medium text-gray-500 uppercase mb-2">Suggested SubTopics</h2>
                            <ul class="list-disc list-inside space-y-1 text-gray-700 text-sm">
                                <p>{!! $taskData->suggested_subtopics ?? 'Not Set' !!}</p>
                            </ul>
                        </div>

                        <!-- Reviewer, SEO Status, and Deadline -->
                        <div class="p-6 bg-gray-50 space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div>
                                    <h2 class="text-sm font-medium text-gray-500 uppercase">Reviewer</h2>
                                    <p class="text-base font-semibold text-gray-800">{!! $taskData->reviewer->name ?? 'Not Assigned' !!}</p>
                                </div>

                                <div class="flex items-center gap-2">
                                    @php
                                        $seoStatus = $taskData->seo_approved ? 'approved' : 'pending';
                                        $badgeClass = $taskData->seo_approved
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-yellow-100 text-yellow-800';

                                    @endphp

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                        SEO Status: {{ $seoStatus }}
                                    </span>

                                    @php
                                        use Carbon\Carbon;

                                        $dueDate = Carbon::parse($taskData->due_date);
                                        $now = Carbon::now();
                                        $daysLeft = $now->diffInDays($dueDate, false); // false to get negative numbers if overdue

                                        $warning = '';
                                        if ($daysLeft < 0) {
                                            $warning = 'text-red-600'; // Overdue
                                        } elseif ($daysLeft <= 3) {
                                            $warning = 'text-yellow-600'; // Approaching
                                        } else {
                                            $warning = 'text-green-600'; // Safe
                                        }
                                    @endphp

                                    <span class="font-semibold  text-sm {{ $warning }}">
                                        Deadline: {{ $dueDate->format('Y-m-d') }}
                                        @if ($daysLeft < 0)
                                            (Overdue by {{ abs($daysLeft) }} days)
                                        @elseif ($daysLeft <= 3)
                                            (Due in {{ $daysLeft }} day{{ $daysLeft == 1 ? '' : 's' }})
                                        @endif
                                    </span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Link Input -->
                <form wire:submit.prevent="submittask">
                    <div>
                        <label for="doc_link" class="block text-sm font-semibold text-gray-700 mb-2">Submit Task
                            Link</label>
                        <input type="url" id="doc_link" name="doc_link"
                            placeholder="https://example.com/your-task-link" wire:model.defer="blogLink"
                            class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm px-4 py-2">
                        @error('blogLink')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="progress" class="block text-sm font-semibold text-gray-700 mb-2">Progress
                            Status</label>
                        <select id="progress" name="progress" wire:model.defer="status"
                            class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm px-4 py-2">
                            <option value="">Select progress</option>
                            <option value="in_progress">In Progress</option>
                            <option value="done">Done</option>
                        </select>
                        @error('status')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div x-data="{ submitted: false }"
                        @task-submitted.window="submitted = true; setTimeout(() => submitted = false, 3000)"
                        class="mt-4">
                        <button type="submit" wire:target="submittask" wire:loading.attr="disabled"
                            :class="submitted
                                ?
                                'bg-green-600 hover:bg-green-700' :
                                'bg-indigo-600 hover:bg-indigo-700'"
                            class="w-full flex items-center justify-center text-white text-sm font-semibold py-3 px-6 rounded-lg shadow-md transition duration-200 relative">

                            <!-- Loading Spinner -->
                            <svg wire:loading wire:target="submittask"
                                class="animate-spin h-5 w-5 text-white absolute left-4"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                            </svg>

                            <!-- Success Tick -->
                            <svg x-show="submitted" x-transition.opacity.duration.300ms
                                class="h-5 w-5 text-green-400 absolute left-4" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>

                            <span x-text="submitted ? 'Submitted' : 'Submit Task'"></span>
                        </button>
                    </div>
                </form>


                {{-- Manually Submit Task --}}
                <div class="border border-gray-600 p-8 my-6">
                    <p>
                        You can manually submit the task here when Google Document fails.
                    </p>
                    <button class="px-6 py-2 bg-green-600 my-4 text-gray-100 rounded" wire:click="openManualDialog">
                        Manually Submit
                    </button>
                </div>

                <!-- Manual Modal -->
                @if ($manualModal)
                    <div
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 overflow-y-auto">
                        <div
                            class="bg-white rounded-lg shadow-lg w-full max-w-2xl my-10 overflow-y-auto max-h-[90vh] p-6">
                            <form wire:submit.prevent="manuallyAnalyse">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-semibold">Manual SEO Submission</h2>
                                    <button type="button" wire:click="closeManualDialog"
                                        class="text-gray-500 hover:text-red-500 text-2xl">
                                        &times;
                                    </button>
                                </div>
                                <div class="mb-4" wire:ignore x-data="{ quill: null }" x-init="quill = new Quill($refs.quillEditor, {
                                    theme: 'snow'
                                });

                                // Set initial content
                                quill.root.innerHTML = @js($content);

                                // Watch for changes and sync to Livewire
                                quill.on('text-change', function() {
                                    @this.set('content', quill.root.innerHTML);
                                });">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                                    <div x-ref="quillEditor"
                                        class="bg-white border border-gray-300 rounded h-40 p-2 overflow-y-auto"></div>
                                </div>


                                <div class="mb-4">
                                    <label for="doc_link"
                                        class="block text-sm font-medium text-gray-700 mb-1">Document Link</label>
                                    <input type="text" id="doc_link" name="doc_link" wire:model.defer="blogLink"
                                        placeholder="Enter the document link"
                                        class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm px-4 py-2">
                                </div>

                                <!-- Status Dropdown -->
                                <div class="mb-4">
                                    <label for="progress"
                                        class="block text-sm font-medium text-gray-700 mb-1">Progress</label>
                                    <select id="progress" name="progress" wire:model.defer="status"
                                        class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm px-4 py-2">
                                        <option value="">Select progress</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="done">Done</option>
                                    </select>
                                </div>

                                <!-- Photo Upload -->
                                <div class="p-4 bg-red-100 mt-4 mb-4 border border-red-500">
                                    <p class="text-base font-semibold text-red-600 text-center">
                                        Upload your Ai Checker screenshot below for verification
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Upload
                                        Photo</label>
                                    <input type="file" id="photo" name="plagarism" wire:model="plagarism"
                                        accept="image/*"
                                        class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm px-4 py-2">

                                    @error('plagarism')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>


                                <!-- Submit Button -->
                                <div x-data="{ analyzing: false, done: false, error: false }"
                                    @analysis-submitted.window="
                                   analyzing = false;
                                   done = true;
                                   error = false;
                                   setTimeout(() => done = false, 3000);
                                "
                                    @analysis-failed.window="
                                   analyzing = false;
                                   done = false;
                                   error = true;
                                   setTimeout(() => error = false, 5000);
                                "
                                    class="text-right">

                                    <button type="button"
                                        @click.prevent="
                                       if (analyzing || done) return;
                                       analyzing = true;
                                       done = false;
                                       error = false;
                                       $wire.manuallyAnalyse();
                                   "
                                        :class="done ? 'bg-green-600 hover:bg-green-700' : 'bg-blue-600 hover:bg-blue-700'"
                                        class="flex items-center justify-center gap-2 text-white px-4 py-2 rounded transition min-w-[160px] relative">

                                        <!-- Spinner -->
                                        <svg x-show="analyzing"
                                            class="w-5 h-5 animate-spin text-white absolute left-3"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                        </svg>

                                        <!-- Tick -->
                                        <svg x-show="done" x-transition.opacity.duration.300ms
                                            class="w-5 h-5 text-green-400 absolute left-3"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>

                                        <span
                                            x-text="analyzing ? 'Analyzing...' : (done ? 'Analyzed' : 'Analyze & Submit')"></span>
                                    </button>

                                    <!-- Optional error feedback -->
                                    <p x-show="error" x-transition class="text-sm text-red-500 mt-2">Analysis failed.
                                        Please check your input and try again.</p>
                                </div>



                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
@endpush
