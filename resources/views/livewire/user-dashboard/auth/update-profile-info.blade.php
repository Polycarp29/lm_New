    <div class="col-12 col-xl-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                        <h6 class="mb-0">Profile Information</h6>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="javascript:;" wire:click="openEditModal">
                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Edit Profile"></i>
                        </a>
                    </div>
                </div>
            </div>
            @foreach ($profileDetails as $profileinfo)
                <div class="card-body p-3">
                    @if ($profileinfo->bio)
                        <p class="text-sm">
                            {{ strip_tags(Str::limit($profileinfo->bio, 150)) }}
                        </p>
                    @else
                        <p>
                            Profile Bio Not Set
                        </p>
                    @endif
                    <hr class="horizontal gray-light my-4">
                    @if ($profileinfo->id)
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full
                                    Name:</strong> &nbsp;
                                {{ $profileinfo->fname . ' ' . $profileinfo->lname }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong>
                                &nbsp;
                                {{ $profileinfo->phone_number }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Email:</strong> &nbsp;
                                {{ Auth::user() ? Auth::user()->email : $profileinfo->email ?? 'No email available' }}
                            </li>

                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">ID
                                    Number:</strong> &nbsp; {{ $profileinfo->id_number }}</li>

                        </ul>
                    @else
                        <div class="bg-gray-400 p-12">
                            <p class="text-lg"> No Profile Info Found</p>
                        </div>
                    @endif
                </div>
            @endforeach
            <div class="ms-4 mb-4">
                <button type="button" class="btn btn-outline-primary btn-sm mb-0 my-4"
                    wire:click="openEditModal">Update Info</button>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade @if ($showEditModal) show @endif"
            style="display: @if ($showEditModal) block @else none @endif;" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isEditing ? 'Edit Profile Details' : 'Create Profile' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeEditModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="saveProfile">
                            <div class="mb-3">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" wire:model="editFname">
                                @error('editFname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" wire:model="editLname">
                                @error('editLname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" wire:model="editPhone">
                                @error('editPhone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="id_number" class="form-label">ID Number</label>
                                <input type="text" class="form-control" id="phone" wire:model="id_number">
                                @error('id_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" wire:model="editBio"></textarea>
                                @error('editBio')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Profile Picture</label>
                                <input type="file" class="form-control" id="avatar" wire:model="avatar">
                                @error('avatar')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    {{ $isEditing ? 'Save Changes' : 'Create Profile' }}
                                </button>
                                <button type="button" class="btn btn-warning" wire:click="closeEditModal">
                                    Close
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="p-4 alert-success">{{ session('message') }}</div>
        @endif
    </div>
