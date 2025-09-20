<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="max-w-md mx-auto p-6 bg-white rounded shadow">
        <form wire:submit.prevent="resetPassword">
            <h2 class="text-xl font-bold mb-4">Reset Password</h2>

            <input type="email" wire:model="email" placeholder="Your email" class="w-full mb-2 p-2 border rounded">
            @error('email') <span class="text-red-600">{{ $message }}</span> @enderror

            <input type="password" wire:model="password" placeholder="New password" class="w-full mb-2 p-2 border rounded">
            @error('password') <span class="text-red-600">{{ $message }}</span> @enderror

            <input type="password" wire:model="password_confirmation" placeholder="Confirm password" class="w-full mb-2 p-2 border rounded">

            <button class="bg-green-600 text-white px-4 py-2 rounded">Reset Password</button>
        </form>
    </div>

</div>

