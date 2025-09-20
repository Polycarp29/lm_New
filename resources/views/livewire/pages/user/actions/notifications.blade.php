<div class="flex h-screen bg-gray-50">
    <!-- Sidebar: Users & Notifications -->

    <div class="w-full md:w-1/3 border-r border-gray-200 bg-white p-4 overflow-y-auto" x-data="{ tab: 'notifications' }">
        <!-- Tab Bar -->
        <div class="flex border-b mb-4">
            <!-- Notifications Tab -->
            <button @click="tab = 'notifications'" class="px-4 py-2 font-semibold flex items-center space-x-2"
                :class="tab === 'notifications' ? 'bg-red-600 text-white' : 'text-gray-500'">
                <!-- Bell Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.25 17.25h-.18a2.25 2.25 0 01-4.14 0h-.18a2.25 2.25 0 01-2.25-2.25V12a6 6 0 1112 0v3a2.25 2.25 0 01-2.25 2.25z" />
                </svg>
                <span>Notifications</span>
            </button>

            <!-- Messages Tab -->
            <button @click="tab = 'messages'" class="px-4 py-2 font-semibold ml-4 flex items-center space-x-2"
                :class="tab === 'messages' ? 'bg-red-600 text-white' : 'text-gray-500'">
                <!-- Chat Bubble Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12.75V6a3.75 3.75 0 013.75-3.75h12A3.75 3.75 0 0121.75 6v6.75a3.75 3.75 0 01-3.75 3.75H8.25l-6 4.5v-4.5a3.75 3.75 0 01-3.75-3.75z" />
                </svg>
                <span>Messages</span>
            </button>
        </div>
        <!-- Notifications Section -->
        <div x-show="tab === 'notifications'" class="space-y-2">
            <div class="flex justify-between items-center">
                @if (auth()->user()->unreadNotifications->count())
                    <form method="POST" action="{{ route('notifications.markAllRead') }}">
                        @csrf
                        <button type="submit" class="text-sm text-green-600 hover:underline">Mark all as read</button>
                    </form>
                @endif

                <form action="{{ route('notifications.clear') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:underline">
                        Clear Notifications
                    </button>
                </form>


            </div>

            <!-- Unread -->
            @forelse (auth()->user()->unreadNotifications as $notification)
                <div class="bg-green-50 border-l-4 border-green-400 p-3 rounded text-sm text-green-800">
                    {{ $notification->data['message'] ?? 'No message' }}
                </div>
            @empty
                <p class="text-sm text-gray-500">No new notifications.</p>
            @endforelse

            <hr class="my-2">

            <!-- Read -->
            @foreach (auth()->user()->readNotifications as $notification)
                <div class="bg-gray-50 border-l-4 border-gray-300 p-3 rounded text-sm text-gray-600">
                    {{ $notification->data['message'] ?? 'No message' }}
                </div>
            @endforeach
        </div>

        <!-- Messages Section -->
        <div x-show="tab === 'messages'" class="space-y-2">
            <ul class="space-y-2">
                @foreach ($users as $user)
                    <li wire:click="selectUser({{ $user->id }})"
                        class="cursor-pointer flex items-center p-2 rounded-lg hover:bg-gray-100 transition
                           {{ $selectedUserId === $user->id ? 'bg-red-100' : '' }}">
                        <img src="{{ asset(optional($user->userdetails)->avatar ? 'storage/' . optional($user->userdetails)->avatar : 'assets/images/user.png') }}"
                            alt="{{ $user->name }}"
                            class="w-12 h-12 rounded-full border-2 border-gray-200 object-cover">
                        <div class="px-4 w-full">
                            <div class="flex justify-between items-center">
                                <p class="text-sm font-semibold text-gray-800">{{ $user->name }}</p>
                                <div class="flex items-center space-x-1 text-xs">
                                    <span class="{{ $user->isOnline() ? 'text-green-500' : 'text-gray-400' }}">●</span>
                                    <span class="{{ $user->isOnline() ? 'text-green-600' : 'text-gray-500' }}">
                                        {{ $user->isOnline() ? 'Online' : 'Offline' }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 truncate">{{ $user->email }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>


    <!-- Chat Interface -->
    <div class="w-2/3 flex flex-col">
        <!-- Header -->
        <div class="border-b border-gray-200 p-4 bg-white flex items-center">
            <h3 class="text-lg font-semibold">Chat with {{ $selectedUserName ?: '...' }}</h3>
        </div>

        <!-- Messages -->
        <div wire:poll.5s="loadMessages" class="flex-1 overflow-y-auto p-4 space-y-3 bg-gray-100">
            @foreach ($messages as $message)
                <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div
                        class="{{ $message->user_id === auth()->id() ? 'bg-red-100' : 'bg-white' }} p-3 rounded-lg shadow max-w-sm">
                        <div class="text-sm text-gray-700">{{ $message->content }}</div>
                        @if ($message->chatAttachments && $message->chatAttachments->count())
                            <div x-data="{ previewUrl: null }">
                                @foreach ($message->chatAttachments as $attachment)
                                    @php
                                        $fileUrl = Storage::url($attachment->attachment);
                                        $isImage = Str::startsWith(
                                            mime_content_type(storage_path('app/public/' . $attachment->attachment)),
                                            'image/',
                                        );
                                    @endphp

                                    @if ($isImage)
                                        <button @click="previewUrl = '{{ $fileUrl }}'"
                                            class="text-blue-500 underline text-xs block mt-1">
                                            🖼️ View Image
                                        </button>
                                    @else
                                        <a href="{{ $fileUrl }}" target="_blank"
                                            class="text-blue-500 underline text-xs block mt-1">
                                            📎 Download File
                                        </a>
                                    @endif
                                @endforeach

                                <!-- Image Preview Modal -->
                                <div x-show="previewUrl" x-transition
                                    class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
                                    <div class="bg-white p-4 rounded shadow-lg relative max-w-2xl w-full">
                                        <button @click="previewUrl = null"
                                            class="absolute top-2 right-2 text-gray-600 hover:text-black">
                                            ✖️
                                        </button>
                                        <img :src="previewUrl" class="max-h-[70vh] mx-auto rounded"
                                            alt="Attachment Preview">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="text-right text-xs text-gray-400 mt-1">
                            {{ $message->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Message Input -->
        <div class="p-4 bg-white border-t border-gray-200 flex items-center space-x-2">
            <input wire:model.defer="messageText" type="text" placeholder="Type a message"
                class="flex-1 border rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-300" />

            <label for="uploadFile"
                class="cursor-pointer px-3 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 text-gray-600 text-sm">
                📎
            </label>
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false; progress = 0"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">
                <input wire:model="file" type="file" id="uploadFile" class="hidden" />

                <!-- Show upload progress -->
                <div x-show="isUploading" class="mt-2">
                    <div class="text-sm text-gray-700">Uploading... <span x-text="progress + '%'"></span></div>
                    <div class="w-full bg-gray-200 rounded h-2 mt-1">
                        <div class="bg-blue-500 h-2 rounded" :style="'width: ' + progress + '%'"></div>
                    </div>
                </div>

                <!-- Show file name after upload -->
                @if ($file)
                    <div class="mt-2 text-sm text-green-600">
                        ✅ File ready: {{ $file->getClientOriginalName() }}
                    </div>
                @endif
            </div>


            <button wire:click="sendMessage"
                class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-600">
                Send
            </button>
        </div>
    </div>
</div>

<!-- Toast Notification (Optional) -->
<script>
    window.addEventListener('chat-toast', event => {
        alert("New message from " + event.detail.user);
    });
</script>
