<div class="flex flex-col md:grid grid-cols-3 gap-4">
    @foreach ($services as $service)
        <div
            class="flex flex-col p-6 bg-white shadow-lg rounded-xl transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110">
            <div>
                <div class="w-[80px] h-[80px] rounded-full bg-red-600 my-4 overflow-hidden">
                    <img src="{{ asset('storage/'. $service->icon )}}" class="p-4">
                </div>
                <h3 class="text-xl font-bold py-2">
                    {{ $service->service_header }}
                </h3>
                <p class="text-base text-gray-600">
                    {{ strip_tags($service->description) }}
                </p>
                <div class="py-4 flex justify-end">
                    <button wire:click="openModal({{ $service->id }})" class="px-4 py-2 bg-black text-white rounded">
                        Ask Quote
                    </button>
                </div>
            </div>
        </div>
    @endforeach


    <!-- Modal -->
    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Ask for a Quote</h2>

                @if (session()->has('message'))
                    <div class="bg-green-500 text-white p-2 rounded m-2">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Error Message -->
                @if (session()->has('error'))
                    <div class="bg-red-500 text-white p-2 rounded m-2">
                        {{ session('error') }}
                    </div>
                @endif

                <form wire:submit.prevent="save">
                    @csrf
                    <div class="mb-4">
                        <input type="text" wire:model="name" placeholder="Name"
                            class="w-full border border-gray-300 rounded px-4 py-2">
                        @error('name')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <input type="text" wire:model="surname" placeholder="Surname"
                            class="w-full border border-gray-300 rounded px-4 py-2">
                        @error('surname')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <input type="email" wire:model="email" placeholder="Your Email"
                            class="w-full border border-gray-300 rounded px-4 py-2">
                        @error('email')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <input type="text" wire:model="phone_number" placeholder="Your Phone Number"
                            class="w-full border border-gray-300 rounded px-4 py-2">
                        @error('phone_number')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" wire:model="serviceId" value="{{ $serviceId }}">
                    <div class="mb-4">
                        <input type="text" value="{{ $serviceName }}"
                            class="w-full border border-gray-300 rounded px-4 py-2" readonly>
                    </div>
                    <div class="mb-4">
                        <input type="text" value="{{ $price  }}"
                            class="w-full border border-gray-300 rounded px-4 py-2" readonly>
                    </div>
                    <div class="mb-4">
                        <textarea wire:model="message" placeholder="Message" class="w-full border border-gray-300 rounded px-4 py-2"></textarea>
                        @error('message')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-between items-center">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded"
                            wire:loading.delay.1000ms>
                            Submit

                            <div wire:loading>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
                                    <path fill="#FDFFF2" stroke="#FDFFF2" stroke-width="24" transform-origin="center"
                                        d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z">
                                        <animateTransform type="rotate" attributeName="transform" calcMode="spline"
                                            dur="2" values="0;120" keyTimes="0;1" keySplines="0 0 1 1"
                                            repeatCount="indefinite"></animateTransform>
                                    </path>
                                </svg>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    @endif
</div>
