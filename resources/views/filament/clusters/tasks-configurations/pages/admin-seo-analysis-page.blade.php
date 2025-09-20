<x-filament-panels::page>
    <div class="space-y-6">

        @php
            $seoData = json_decode($taskData->seo_analysis, true);
        @endphp

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">SEO Analysis Report</h1>
            {{-- <x-filament::button wire:click="reanalyze">
                🔄 Reanalyze Blog
            </x-filament::button> --}}
        </div>

        {{-- Stat-Like Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <x-filament::card>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">SEO Score</h3>

                {{-- Label + Score --}}
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Current Score</span>
                    <span
                        class="text-sm font-semibold text-gray-800 dark:text-white">{{ $taskData->perfomance_score }}/100</span>
                </div>

                {{-- Progress Bar --}}
                <x-filament::card>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">SEO Score</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $seoScore }}%</p>
                        </div>
                        <x-filament::badge
                            color="{{ $seoScore >= 80 ? 'success' : ($seoScore >= 50 ? 'warning' : 'danger') }}">
                            {{ $seoScore >= 80 ? 'Excellent' : ($seoScore >= 50 ? 'Needs Improvement' : 'Poor') }}
                        </x-filament::badge>
                    </div>
                </x-filament::card>
            </x-filament::card>


            <x-filament::card class="text-center">
                <div class="text-xl font-bold text-gray-500 dark:text-gray-400">Main Keyword</div>
                <div class="text-emerald-50 font-bold text-primary-600 dark:text-yellow-400">
                    {{ $taskData->main_keyword }}</div>
            </x-filament::card>

            <x-filament::card class="text-center">
                <div class="text-xl font-bold text-gray-500 dark:text-gray-400">Secondary Keywords Used:</div>
                @foreach ($seoData['secondary_keywords_usage']['used_keywords'] ?? [] as $keyword)
                    <li>{{ is_array($keyword) ? implode(', ', $keyword) : $keyword }}</li>
                @endforeach
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
            </x-filament::card>

            <x-filament::card class="text-center">
                <div class="text-xl font-bold text-gray-500 dark:text-gray-400">Word Count</div>
                <div class="text-emerald-50 font-bold text-primary-600 dark:text-yellow-400">{{ $seoData['word_count'] ?? 'N/A' }}</div>
            </x-filament::card>

            <x-filament::card class="text-center">
                <div class="text-xl font-bold text-gray-500 dark:text-gray-400">Headings:</div>
                <div class="text-emerald-50 font-bold text-primary-600 dark:text-yellow-400">
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
            </x-filament::card>

            <x-filament::card class="text-center">
                <div class="text-xl font-bold text-gray-500 dark:text-gray-400">Linking:</div>
                <p class="text-gray-500"><strong>Internal Links:</strong> {{ $seoData['internal_links'] ?? 0 }}</p>
                <p class="text-gray-500"><strong>External Links:</strong> {{ $seoData['external_links'] ?? 0 }}</p>

            </x-filament::card>


            <x-filament::card class="text-center">
                <div class="text-xl font-bold text-gray-500 dark:text-gray-400">Quality:</div>
                <p class="text-gray-500"><strong>Readability:</strong>
                    {{ is_array($seoData['readability'] ?? null) ? json_encode($seoData['readability']) : $seoData['readability'] ?? 'N/A' }}
                </p>
                <p class="text-gray-500"><strong>Structure:</strong>
                    {{ is_array($seoData['content_structure'] ?? null) ? json_encode($seoData['content_structure']) : $seoData['content_structure'] ?? 'N/A' }}
                </p>
            </x-filament::card>



        </div>

        {{-- Recommendations --}}
        <x-filament::section heading="SEO Issues" description="Potential issues that the blog has after  analysis">
                <div class="text-danger-600">
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

                </div>
        </x-filament::section>

        {{-- Issues --}}
        <x-filament::section heading="Recommendations" description="Best practices to improve blog ranking for SEO">
            @if (!empty($seoData['recommendations']) && is_array($seoData['recommendations']))
            <ul class="list-disc list-inside ml-4 text-green-600">
                @foreach ($seoData['recommendations'] as $rec)
                    <li>{{ is_array($rec) ? json_encode($rec) : $rec }}</li>
                @endforeach
            </ul>
            @endif
        </x-filament::section>
    </div>
</x-filament-panels::page>
