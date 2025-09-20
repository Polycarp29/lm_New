<div>
    <!-- Address Form -->
    <form id="search" action="#" method="POST" wire:submit.prevent="create">
        @csrf <!-- Include CSRF protection -->
        <fieldset>
            <input type="text" name="address" class="email" placeholder="{{ $placeholder }}" autocomplete="on" required
                wire:model="address">
        </fieldset>
        <fieldset>
            <button type="submit" class="main-button">{{ $request_btn }}</button>
        </fieldset>
    </form>

    <!-- Modal -->
    @if ($isModalOpen)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-full">
                <!-- Success Message -->
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
                <div class="p-6">
                    <h3 class="text-2xl font-semibold text-yellow-600">Almost Done! Let Us Contact You.</h3>
                    <input type="text" class="border p-2 rounded-xl w-full m-2" value="{{ session('address') }}"
                        wire:model="address" readonly>
                    <input type="email" class="border p-2 rounded-xl w-full m-2" placeholder="Your Email"
                        wire:model="email">
                    @error('email')
                        <span class="text-red-600 m-2">{{ $message }}</span>
                    @enderror
                    <input type="text" class="border p-2 rounded-xl w-full m-2" placeholder="Your Name"
                        wire:model="name">
                    @error('name')
                        <span class="text-red-600 m-2">{{ $message }}</span>
                    @enderror
                    <div class="p-4 border-t text-right">
                        <button class="bg-gray-500 text-white px-4 py-2 rounded mr-2" wire:click="closeModal">
                            Close
                        </button>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded" wire:click="submit">
                            Confirm
                        </button>
                    </div>
                </div>
            </div>
    @endif
</div>
