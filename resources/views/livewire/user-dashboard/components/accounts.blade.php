<div class="col-12 col-xl-4">
    <div class="card h-100">
        <div class="card-header pb-0 p-3">
            <h6 class="mb-0">Account Details</h6>
        </div>

        @if ($accountDetails && $accountDetails->isNotEmpty())
            @php
                $account = $accountDetails->first();
            @endphp
            <div class="card-body p-3">
                <ul class="list-group">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Account Name</h6>
                            <p class="mb-0 text-xs">{{ $account->account_name }}</p>
                        </div>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                        <div class="d-flex align-items-start flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Payment Method</h6>
                            <p class="mb-0 text-xs">{{ $account->methods }}</p>
                        </div>
                    </li>
                    @if ($account->methods === 'Bank')
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Bank Name</h6>
                                <p class="mb-0 text-xs">{{ $account->bank_name }}</p>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Account Number</h6>
                                <p class="mb-0 text-xs">{{ $account->bank_account }}</p>
                            </div>
                        </li>
                    @elseif ($account->methods === 'Mpesa')
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Mpesa Number</h6>
                                <p class="mb-0 text-xs">{{ $account->mpesa_number }}</p>
                            </div>
                        </li>
                    @elseif ($account->methods === 'Paypal')
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Paypal Email</h6>
                                <p class="mb-0 text-xs">{{ $account->paypal_email }}</p>
                            </div>
                        </li>
                    @endif
                </ul>
                <div>
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0 my-4"
                        wire:click="openModal">Update Info</button>
                </div>
            </div>
        @else
            <div class="card-body p-3">
                <p class="mb-0 text-xs">No account details available.</p>
                <div>
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0 my-4" wire:click="openModal">Add
                        Info</button>
                </div>
            </div>
        @endif

        <div class="modal fade @if ($isModalOpen) show @endif"
            style="display: @if ($isModalOpen) block @else none @endif;" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isEditing ? 'Edit Account Details ' : 'Add Account Details ' }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="saveAccountDetails">
                            <div class="mb-3">
                                <label for="account_name" class="form-label">Account Name</label>
                                <input type="text" class="form-control" id="accountName" wire:model="accountName">
                                @error('accountName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="method" class="form-label">Payment Method</label>
                                <select wire:model="methods" class="form-select">
                                    <option value="" selected>Select Method</option>
                                    <option value="Bank">Bank</option>
                                    <option value="Mpesa">Mpesa</option>
                                    <option value='Cash'>Cash</option>
                                    <option value="Paypal">Paypal</option>
                                </select>
                                @error('methods')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($methods === 'Bank')
                                <div class="mb-3">
                                    <label>Bank Name</label>
                                    <input type="text" class="form-control" wire:model="bank_name">
                                    @error('bank_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Bank Account</label>
                                    <input type="text" wire:model="bank_account" class="form-control">
                                    @error('bank_account')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            @elseif ($methods === 'Mpesa')
                                <div class="mb-3">
                                    <label>Mpesa Number</label>
                                    <input class="form-control" type="text" wire:model="mpesa_number">
                                    @error('mpesa_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            @elseif ($methods === 'Paypal')
                                <div class="mb-3">
                                    <label>Paypal Email</label>
                                    <input class="form-control" type="email" wire:model="paypal_email">
                                    @error('paypal_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            @endif

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">
                                    {{ $isEditing ? 'Save Changes' : 'Add' }}
                                </button>
                                <button type="button" class="btn btn-warning" wire:click="closeModal">
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
</div>
