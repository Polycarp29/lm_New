<section class="bg-gray-100 py-12 mt-6">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold text-center mb-2">Open Positions</h1>
        <p class="text-lg text-center text-gray-600 mb-8">Be part of our amazing team. Apply below!</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($getData as $position)
                @php $title = $position->{'job-title'} ?? ''; @endphp
                <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold mb-2">{{ $title }}</h2>
                        <p class="text-gray-600">{{ strip_tags(Str::limit($position->job_description, 150)) }}</p>
                    </div>
                    <div class="mt-4 flex flex-wrap gap-3">
                        <a href="{{ route('job.view', ['title' => $title]) }}"
                           class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                            View Details
                        </a>
                        <button wire:click="openModal({{ $position->id }})"
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                            Apply
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center col-span-full">
                    <p class="text-gray-500 font-medium">No Job Openings Available</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Modal --}}
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
            <div class="bg-white w-full max-w-lg rounded-lg p-6 shadow-lg relative">
                {{-- Preloader --}}
                <div wire:loading wire:target="save"
                     class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center z-10">
                    <div class="text-center">
                        <svg class="animate-spin h-8 w-8 text-yellow-600 mx-auto" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75 fill-current" d="M4 12a8 8 0 018-8V0C5.373..."/>
                        </svg>
                        <p class="text-yellow-600 mt-2">Submitting...</p>
                    </div>
                </div>

                <h2 class="text-2xl font-bold mb-4">Apply For This Vacancy</h2>

                @if (session()->has('message'))
                    <div class="bg-green-500 text-white text-sm p-2 mb-4 rounded">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="bg-red-500 text-white text-sm p-2 mb-4 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <form wire:submit.prevent="save" class="space-y-4">
                    @csrf
                    <input type="text" wire:model="fname" placeholder="First Name"
                           class="w-full border rounded px-4 py-2" />
                    @error('fname') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

                    <input type="text" wire:model="mname" placeholder="Middle Name"
                           class="w-full border rounded px-4 py-2" />
                    @error('mname') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

                    <input type="text" wire:model="lname" placeholder="Last Name"
                           class="w-full border rounded px-4 py-2" />
                    @error('lname') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

                    <input type="text" wire:model="phone_number" placeholder="Phone Number"
                           class="w-full border rounded px-4 py-2" />
                    @error('phone_number') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

                    <input type="email" wire:model="email" placeholder="Email"
                           class="w-full border rounded px-4 py-2" />
                    @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

                    <input type="text" value="{{ $jobName }}" readonly
                           class="w-full border rounded px-4 py-2 bg-gray-100 text-gray-600" />

                    {{-- File Upload --}}
                    <label for="uploadFile1" class="block text-sm font-medium text-gray-700">Upload CV (PDF, DOCX, ODT)</label>
                    <input type="file" id="uploadFile1" wire:model="cv"
                           class="w-full border rounded px-4 py-2" />
                    @error('cv') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

                    {{-- Actions --}}
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" wire:click="closeModal" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400 transition">
                            Cancel
                        </button>
                        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</section>
