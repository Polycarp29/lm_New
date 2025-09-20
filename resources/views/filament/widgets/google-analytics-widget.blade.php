<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold border-4 border-b border-white py-4 inline-block flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
            </svg>
            <span>Google Analytics Data</span>
        </h2>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Country Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No. Users
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->getData()['countries'] as $row)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $row['dimensionValues'][0]['value'] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $row['metricValues'][0]['value'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::card>
</x-filament::widget>
