<div class="mx-auto container mt-4 h-auto">
    <!-- Profile Banner -->
    <div class="w-full h-60 bg-gradient-to-r from-yellow-400 to-yellow-600 relative rounded-lg">
        <!-- Profile Picture -->
        <div x-data="{ isUploading: false }" x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false; $dispatch('profile-uploaded')"
            x-on:livewire-upload-error="isUploading = false" class="absolute group -bottom-16 left-6">
            <div class="w-32 h-32 bg-white rounded-full shadow-lg border-4 border-white overflow-hidden relative">

                <!-- Profile Image -->
                <img src="{{ asset('storage/' . ($userData->avatar ?? 'assets/images/user.png')) }}" alt="Profile Picture"
                    class="w-full h-full object-cover">

                <!-- Loading Spinner -->
                <div x-show="isUploading"
                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    <svg class="animate-spin h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                </div>

                <!-- Upload overlay -->
                <div
                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <label class="text-white cursor-pointer flex flex-col items-center">
                        <span>Upload</span>
                        <input type="file" wire:model="avatar" class="hidden">
                    </label>
                </div>

            </div>
        </div>



    </div>

    <!-- Profile Info -->
    <div class="pt-20 px-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-500">
                    {{ trim(($userData->fname ?? '') . ' ' . ($userData->lname ?? '')) }}
                </h1>

            </div>
            <div class="mt-4 sm:mt-0">
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                    wire:click="editProfile">Edit
                    Profile</button>
            </div>
        </div>

        <div class="mt-4 max-w-2xl text-gray-400">
            <p>
                {!! $userData->bio  ?? '' !!}
            </p>
        </div>
    </div>

    <div class="modal fade @if ($modal) show @endif"
        style="display: @if ($modal) block @else none @endif; background: rgba(0, 0, 0, 0.6);" tabindex="-1"
        role="dialog">
        <div class="modal-dialog modal-dialog-centered rounded-xl" role="document">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <div class="modal-header bg-yellow-600 text-white rounded-top-3">
                    <h5 class="modal-title">{{ 'Profile Details '}}</h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeEditModal"></button>
                </div>

                <div class="modal-body p-4 bg-light">
                    <form wire:submit.prevent="updateProfile" class="space-y-4">

                        <div class="mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control rounded-2" id="fname" wire:model="editFname">
                            @error('editFname') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control rounded-2" id="lname" wire:model="editLname">
                            @error('editLname') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control rounded-2" id="phone" wire:model="editPhone">
                            @error('editPhone') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_number" class="form-label">ID Number</label>
                            <input type="text" class="form-control rounded-2" id="id_number" wire:model="id_number">
                            @error('id_number') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control rounded-2" id="bio" wire:model="editBio" rows="3"></textarea>
                            @error('editBio') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-secondary" wire:click="closeEditModal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ $isEditing ? 'Save Changes' : 'Create Profile' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Include Alpine.js -->
    <div class="p-6 container mx-auto" x-data="{ activeTab: 'profile' }">
        <div class="flex flex-row bg-gray-50 rounded-lg shadow-lg overflow-hidden">
            <!-- Sidebar -->
            <div class="w-1/3 bg-white p-6 border-r space-y-4">
                <!-- Profile Info -->
                <button @click="activeTab = 'profile'"
                    class="flex items-center w-full p-4 rounded-lg hover:bg-gray-100 transition"
                    :class="{'bg-yellow-100 text-yellow-800 font-semibold': activeTab === 'profile'}">
                    <svg class="w-5 h-5 mr-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M5.121 17.804A9 9 0 1118.88 6.196 9 9 0 015.12 17.804z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Profile Info
                </button>

                <!-- Account Info -->
                <button @click="activeTab = 'account'"
                    class="flex items-center w-full p-4 rounded-lg hover:bg-gray-100 transition"
                    :class="{'bg-yellow-100 text-yellow-800 font-semibold': activeTab === 'account'}">
                    <svg class="w-5 h-5 mr-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 11c0-2.209 2.686-4 6-4s6 1.791 6 4-2.686 4-6 4-6-1.791-6-4z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 15v2c0 2.209 2.686 4 6 4s6-1.791 6-4v-2" />
                    </svg>
                    Account Info
                </button>

                <!-- Settings -->
                <button @click="activeTab = 'settings'"
                    class="flex items-center w-full p-4 rounded-lg hover:bg-gray-100 transition"
                    :class="{'bg-yellow-100 text-yellow-800 font-semibold': activeTab === 'settings'}">
                    <svg class="w-5 h-5 mr-3 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M10.325 4.317c.426-1.756 3.024-1.756 3.45 0a1.724 1.724 0 002.591 1.104c1.527-.856 3.239.856 2.383 2.383a1.724 1.724 0 001.104 2.592c1.756.426 1.756 3.024 0 3.45a1.724 1.724 0 00-1.104 2.591c.856 1.527-.856 3.239-2.383 2.383a1.724 1.724 0 00-2.592 1.104c-.426 1.756-3.024 1.756-3.45 0a1.724 1.724 0 00-2.591-1.104c-1.527.856-3.239-.856-2.383-2.383a1.724 1.724 0 00-1.104-2.592c-1.756-.426-1.756-3.024 0-3.45a1.724 1.724 0 001.104-2.591c-.856-1.527.856-3.239 2.383-2.383a1.724 1.724 0 002.592-1.104z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Settings
                </button>
            </div>

            <!-- Main Content -->
            <div class="w-2/3 bg-white p-8">
                <!-- Profile Info -->
                <div x-show="activeTab === 'profile'" x-cloak class="bg-white p-6 rounded-lg shadow-md">
                    <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Profile Information</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Full Name</label>
                            <div class="mt-1 text-gray-800 font-semibold">{{ trim(($userData->fname ?? '') . ' ' . ($userData->lname ?? ''))}}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <div class="mt-1 text-gray-800 font-semibold">{{ $userData->user->email ?? 'N/A' }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone</label>
                            <div class="mt-1 text-gray-800 font-semibold">{{ $userData->phone_number ?? '' }}</div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">ID Number</label>
                            <div class="mt-1 text-gray-800 font-semibold">{{ $userData->id_number  ?? ''}}</div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500">Bio</label>
                            <div class="mt-2 text-gray-700 leading-relaxed">{{ $userData->bio ?? '' }}</div>
                        </div>
                    </div>
                </div>


                <!-- Account Info -->
                <div x-show="activeTab === 'account'" x-cloak>
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Account Information</h1>

                    <!-- Email Address -->
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Email Address</h2>
                        <div class="flex items-center justify-between">
                            <div class="text-gray-600">
                                {{ Auth::user()->email }}
                            </div>
                            <button class="btn btn-sm btn-primary" wire:click='openEmailModal'>
                                Change Email
                            </button>
                        </div>
                    </div>

                    <div class="modal fade @if ($updateEmailModal) show @endif"
                        style="display: @if ($updateEmailModal) block @else none @endif; background: rgba(0, 0, 0, 0.6);"
                        tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content border-0 shadow-lg rounded-3">
                                <div class="modal-header bg-yellow-600 text-white rounded-top-3">
                                    <h5 class="modal-title">{{ 'Update Email'}}</h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        wire:click="closeEmailModal"></button>
                                </div>

                                <div class="modal-body p-4 bg-light">
                                    <form wire:submit.prevent="updateemail" class="space-y-4">

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control rounded-2" id="fname"
                                                wire:model="editEmail">
                                            @error('email') <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="d-flex justify-content-end gap-2 mt-4">
                                            <button type="button" class="btn btn-secondary" wire:click="closeEmailModal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                 Save Changes
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Password</h2>
                        <div class="flex items-center justify-between">
                            <div class="text-gray-600">
                                ••••••••
                            </div>
                            <button class="btn btn-sm btn-primary" wire:click='openPasswordModal'>
                                Change Password
                            </button>
                        </div>
                    </div>

                    <div class="modal fade @if ($updatePasswordModal) show @endif"
                    style="display: @if ($updatePasswordModal) block @else none @endif; background: rgba(0, 0, 0, 0.6);"
                    tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-0 shadow-lg rounded-3">
                            <div class="modal-header bg-warning text-white rounded-top-3">
                                <h5 class="modal-title">Update Password</h5>
                                <button type="button" class="btn-close btn-close-white" wire:click="closePasswordModal"></button>
                            </div>

                            <div class="modal-body p-4 bg-light">
                                <form wire:submit.prevent="updatePassword" class="space-y-4">

                                    <!-- Current Password -->
                                    <div class="mb-3" x-data="{ show: false }">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <div class="input-group">
                                            <input :type="show ? 'text' : 'password'" class="form-control rounded-2" id="current_password"
                                                wire:model.defer="current_password">
                                            <span class="input-group-text bg-white border-start-0" style="cursor: pointer" @click="show = !show">
                                                <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                                            </span>
                                        </div>
                                        @error('current_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- New Password -->
                                    <div class="mb-3" x-data="{ show: false }">
                                        <label for="password" class="form-label">New Password</label>
                                        <div class="input-group">
                                            <input :type="show ? 'text' : 'password'" class="form-control rounded-2" id="password"
                                                wire:model.defer="password">
                                            <span class="input-group-text bg-white border-start-0" style="cursor: pointer" @click="show = !show">
                                                <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3" x-data="{ show: false }">
                                        <label for="password" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <input :type="show ? 'text' : 'password'" class="form-control rounded-2" id="password"
                                                wire:model.defer="password_confirmation">
                                            <span class="input-group-text bg-white border-start-0" style="cursor: pointer" @click="show = !show">
                                                <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                                            </span>
                                        </div>
                                        @error('password_confirmation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                        <button type="button" class="btn btn-secondary" wire:click="closePasswordModal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            Save Changes
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                    <!-- Two-Factor Authentication (2FA) -->
                    {{-- <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Two-Factor Authentication</h2>
                        <div class="flex items-center justify-between">
                            <div class="text-gray-600">
                                {{ Auth::user()->two_factor_enabled ? 'Enabled' : 'Disabled' }}
                            </div>
                            <button class="btn btn-sm btn-primary">
                                {{ Auth::user()->two_factor_enabled ? 'Manage 2FA' : 'Enable 2FA' }}
                            </button>
                        </div>
                    </div> --}}

                    <!-- Login History -->
                    {{-- <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Recent Logins</h2>
                        <ul class="text-gray-600 space-y-2 text-sm">
                            <li>📍 New York, NY — Chrome on Windows — 2 hours ago</li>
                            <li>📍 Los Angeles, CA — Safari on iPhone — Yesterday</li>
                            <li>📍 London, UK — Firefox on Mac — 3 days ago</li>
                        </ul>
                    </div> --}}

                </div>


                <!-- Settings -->
                <div x-show="activeTab === 'settings'" x-cloak>
                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Settings</h1>

                    <!-- Theme Settings -->
                    {{-- <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Appearance</h2>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="radio" name="theme" value="light" class="radio" checked>
                                <span class="ml-2 text-gray-600">Light Mode</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="theme" value="dark" class="radio">
                                <span class="ml-2 text-gray-600">Dark Mode</span>
                            </label>
                        </div>
                    </div> --}}

                    <!-- Notification Settings -->
                    <div class="mb-6 border p-4">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Notifications</h2>

                        <div class="space-y-4">
                            <!-- Email Toggle -->
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Email me about new updates</span>
                                <button type="button"
                                        wire:click="toggleEmail"
                                        class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors duration-200 focus:outline-none"
                                        :class="{ 'bg-red-600': {{ $emailTurnOn ? 'true' : 'false' }}, 'bg-gray-300': {{ $emailTurnOn ? 'false' : 'true' }} }"
                                >
                                    <span class="sr-only">Toggle Email Updates</span>
                                    <span class="inline-block w-4 h-4 transform bg-white rounded-full transition-transform duration-200"
                                          :class="{ 'translate-x-6': {{ $emailTurnOn ? 'true' : 'false' }}, 'translate-x-1': {{ $emailTurnOn ? 'false' : 'true' }} }"></span>
                                </button>
                            </div>

                            <!-- SMS Toggle -->
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Send me SMS alerts</span>
                                <button type="button"
                                        wire:click="toggleSms"
                                        class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors duration-200 focus:outline-none"
                                        :class="{ 'bg-yellow-500': {{ $smsTurnOn ? 'true' : 'false' }}, 'bg-gray-300': {{ $smsTurnOn ? 'false' : 'true' }} }"
                                >
                                    <span class="sr-only">Toggle SMS</span>
                                    <span class="inline-block w-4 h-4 transform bg-white rounded-full transition-transform duration-200"
                                          :class="{ 'translate-x-6': {{ $smsTurnOn ? 'true' : 'false' }}, 'translate-x-1': {{ $smsTurnOn ? 'false' : 'true' }} }"></span>
                                </button>
                            </div>

                            <!-- Login Attempts Toggle -->
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Notify me about login attempts</span>
                                <button type="button"
                                        wire:click="toggleLoginAttempts"
                                        class="relative inline-flex items-center h-6 rounded-full w-11 transition-colors duration-200 focus:outline-none"
                                        :class="{ 'bg-green-600': {{ $loginAttemptsTurnOn ? 'true' : 'false' }}, 'bg-gray-300': {{ $loginAttemptsTurnOn ? 'false' : 'true' }} }"
                                >
                                    <span class="sr-only">Toggle Login Alerts</span>
                                    <span class="inline-block w-4 h-4 transform bg-white rounded-full transition-transform duration-200"
                                          :class="{ 'translate-x-6': {{ $loginAttemptsTurnOn ? 'true' : 'false' }}, 'translate-x-1': {{ $loginAttemptsTurnOn ? 'false' : 'true' }} }"></span>
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- Language Settings -->
                    {{-- <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Language</h2>
                        <select class="select select-bordered w-full">
                            <option>English (US)</option>
                            <option>Español (Spanish)</option>
                            <option>Français (French)</option>
                            <option>Deutsch (German)</option>
                        </select>
                    </div> --}}

                    <!-- Privacy Settings -->
                    {{-- <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Privacy</h2>
                        <div class="space-y-3">
                            <label class="flex items-center">
                                <input type="checkbox" class="checkbox">
                                <span class="ml-2 text-gray-600">Make my profile private</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="checkbox" checked>
                                <span class="ml-2 text-gray-600">Hide my online status</span>
                            </label>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>