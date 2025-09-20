
<div class="flex flex-col md:flex-row md:justify-between">
    @foreach($middleData as $related)
    <div class="bg-red-700 text-white flex-col md:w-1/4 w-full p-6 rounded-xl shadow-lg mb-4" wire:key="{{ $related->id }}">
        <div class="flex justify-end">
            <div class="flex items-center justify-center h-[80px] w-[80px] rounded-full bg-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="h-12 w-12 fill-gray-200">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="{{ $related->icon }}" />
                </svg>
            </div>
        </div>

        <h3 class="text-xl font-semibold">
           {{ $related->title_data }}
        </h3>
        <p class="text-xl text-white"> {{ $related->analytics }}</p>
    </div>
    @endforeach
</div>

