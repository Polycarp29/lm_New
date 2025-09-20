<x-filament::page>
    <div class="space-y-4">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Quote Details</h2>
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md">
            <div class="flex flex-col py-8 border-b border-gray-600 text-center dark:border-white">
                <h1 class="text-xl font-bold text-gray-900 dark:text-gray-300">User Details<h1>
            </div>
            <div class="flex flex-col md:flex-row">
                <div class="w-full md:w-1/3 rounded-md  flex flex-col">
                    <h4 class="text-lg font-medium pt-6 text-gray-900 dark:text-gray-300">
                        First Name:
                    </h4>
                    <p class="text-base italic text-gray-900 dark:text-gray-300">
                        {{ $quote->fname }}
                    </p>
                    <h4 class="text-lg font-medium pt-6 text-gray-900 dark:text-gray-300">
                        Email:
                    </h4>
                    <p class="text-gray-900 dark:text-gray-300 italic "> {{ $quote->email }}</p>
                </div>
                <div class="w-full md:w-1/3 rounded-md flex flex-col">
                    <h4 class="text-lg font-medium pt-6 text-gray-900 dark:text-gray-300">
                        Last Name:
                    </h4>
                    <p class="text-base italic text-gray-900 dark:text-gray-300">
                        {{ $quote->lname }}
                    </p>
                    <h4 class="text-lg font-medium pt-6 text-gray-900 dark:text-gray-300">
                        Phone Number:
                    </h4>
                    <p class="text-gray-900 dark:text-gray-300 italic text-base"><strong>Email:</strong>
                        {{ $quote->phone_number }}</p>
                </div>
            </div>
            <div class="flex flex-col py-6 rounded-md">
                <div class="border-2 dark:border-gray-400 border-gray-600 p-2">
                    <h4 class="text-lg font-medium pt-2 text-gray-900 dark:text-gray-300">
                        Service Inquiry:
                    </h4>
                    <p class="text-gray-900 dark:text-gray-300">{{ $quote->service->service_header }}</p>
                </div>
                <div>
                    <div class="flex flex-col py-6 rounded-md">
                        <div class="border-2 dark:border-gray-400 border-gray-600 p-2">
                            <h4 class="text-lg font-medium pt-2 text-gray-900 dark:text-gray-300">
                                Message:
                            </h4>
                            <p class="text-gray-900 dark:text-gray-300">{{ $quote->message }}</p>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
                <div>
                    <x-filament::button>
                        Reply
                    </x-filament::button>
                </div>
            </div>
</x-filament::page>
