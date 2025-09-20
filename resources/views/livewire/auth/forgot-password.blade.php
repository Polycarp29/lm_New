<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto p-6 bg-white rounded shadow">
        <div class="mt-4">
            <a href="{{ route('login') }}" class="inline-flex items-center text-red-600 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
                Return to Login
            </a>
        </div>

        <form wire:submit.prevent="sendResetLink">
            @csrf
            <h2 class="text-xl font-bold mb-4">Forgot Password</h2>

            @if (session('status'))
                <div class="text-green-600">{{ session('status') }}</div>
            @endif

            <input type="email" wire:model="email" placeholder="Enter your email" class="w-full mb-2 p-2 border rounded">
            @error('email') <span class="text-red-600">{{ $message }}</span> @enderror

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Send Reset Link</button>
        </form>
    </div>
</div>
