<section class="main-banner">
    <div class="container mx-auto p-12 bg-gray-200 rounded">
        @if ($getPost)
            <header class="p-6">
                <h1 class="text-2xl font-bold px-4 border-l-4 border-yellow-400">
                    {{ $title }}
                </h1>
            </header>

            <div class="flex flex-col p-6 space-y-2">
                <p class="text-xl font-bold">
                    Job Title:
                    <span class="font-light ml-2">{{ $title }}</span>
                </p>
                <p class="text-xl font-bold">
                    Job Nature:
                    <span class="font-light ml-2">{{ $getPost->type }}</span>
                </p>
            </div>

            <div class="p-6 text-lg text-gray-700 w-full md:w-2/3">
                {!! $getPost->job_description !!}
            </div>
        @endif

        <div class="p-6">
            <button class="px-6 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded"
                wire:click="openModal({{ $getPost->id }})">
                Apply
            </button>
        </div>
    </div>

    {{-- Modal Script --}}
    <script>
        Livewire.on('closeModalAfterDelay', () => {
            setTimeout(() => {
                document.getElementById('modal').classList.add('hidden');
            }, 3000);
        });
    </script>

    {{-- Modal --}}
    @if ($isModalOpen)
        <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative">

                {{-- Loading State --}}
                <div wire:loading wire:target="save"
                    class="absolute inset-0 bg-white bg-opacity-70 flex items-center justify-center z-10">
                    <div class="text-center">
                        <svg class="animate-spin h-8 w-8 text-yellow-600 mb-4" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.964 7.964 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <p class="text-yellow-600 font-semibold">Submitting...</p>
                    </div>
                </div>

                <h2 class="text-xl font-bold mb-4">Apply for This Vacancy</h2>

                {{-- Flash Messages --}}
                @if (session()->has('message'))
                    <div class="bg-green-500 text-white p-2 rounded mb-2">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="bg-red-500 text-white p-2 rounded mb-2">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Application Form --}}
                <form wire:submit.prevent="save" class="space-y-4">
                    @csrf

                    <input type="text" wire:model="fname" placeholder="First Name"
                        class="w-full border border-gray-300 rounded px-4 py-2" />
                    @error('fname')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror

                    <input type="text" wire:model="mname" placeholder="Middle Name"
                        class="w-full border border-gray-300 rounded px-4 py-2" />
                    @error('mname')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror

                    <input type="text" wire:model="lname" placeholder="Last Name"
                        class="w-full border border-gray-300 rounded px-4 py-2" />
                    @error('lname')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror

                    <input type="text" wire:model="phone_number" placeholder="Phone Number"
                        class="w-full border border-gray-300 rounded px-4 py-2" />
                    @error('phone_number')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror

                    <input type="hidden" wire:model="jobId" value="{{ $jobId }}">
                    <input type="text" value="{{ $jobName }}" readonly
                        class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100" />

                    <input type="email" wire:model="email" placeholder="Email"
                        class="w-full border border-gray-300 rounded px-4 py-2" />
                    @error('email')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror

                    {{-- File Upload --}}
                    {{-- File Upload --}}
                    <div class="mb-4">
                        <label for="uploadFile1" class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Your CV <span class="text-red-500">*</span>
                        </label>

                        <label for="uploadFile1"
                            class="flex flex-col items-center justify-center w-full h-48 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:border-yellow-500 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center space-y-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12M7 16l-4 4m0 0l4 4m-4-4h18" />
                                </svg>
                                <p class="text-sm text-gray-500">Click to upload or drag and drop</p>
                                <p class="text-xs text-gray-400">PDF, DOCX, ODT only. Max size: 2MB.</p>
                            </div>
                            <input id="uploadFile1" type="file" wire:model="cv" class="hidden" />
                        </label>

                        @error('cv')
                            <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
                        @enderror

                        {{-- Preview or file name (optional) --}}
                        @if ($cv)
                            <p class="mt-2 text-sm text-green-600">Selected file: {{ $cv->getClientOriginalName() }}
                            </p>
                        @endif
                    </div>



                    {{-- Action Buttons --}}
                    <div class="flex justify-between pt-4">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</section>
