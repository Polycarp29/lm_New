<div class="card-body p-3">
    <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
    <ul class="list-group">
        <li class="list-group-item border-0 px-0">
            <div class="form-check form-switch ps-0">
                <input class="form-check-input ms-auto" type="checkbox"
                    id="flexSwitchCheckDefault" wire:model.lazy="task_assigned" {{$task_assigned ? 'checked' : null}}>
                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                    for="flexSwitchCheckDefault">Email me when tasks are assigned</label>
            </div>
        </li>
        <li class="list-group-item border-0 px-0">
            <div class="form-check form-switch ps-0">
                <input class="form-check-input ms-auto" type="checkbox" wire:model.lazy="reviews_posted"
                    id="flexSwitchCheckDefault1" {{ $reviews_posted ? 'checked' : null }}>
                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                    for="flexSwitchCheckDefault1">Email me when reviews are posted</label>
            </div>
        </li>
        <li class="list-group-item border-0 px-0">
            <div class="form-check form-switch ps-0">
                <input class="form-check-input ms-auto" type="checkbox" wire:model.lazy="payment_notifications"
                    id="flexSwitchCheckDefault2" {{ $payment_notifications ? 'checked' : null }}>
                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                    for="flexSwitchCheckDefault2">Email me on payment notifications</label>
            </div>
        </li>
    </ul>
    <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
    <ul class="list-group">
        <li class="list-group-item border-0 px-0">
            <div class="form-check form-switch ps-0">
                <input class="form-check-input ms-auto" type="checkbox"
                    id="flexSwitchCheckDefault3" wire:model.lazy="task_approval" {{ $task_approval ? 'checked' : null }}>
                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                    for="flexSwitchCheckDefault3">Notification on task approval</label>
            </div>
        </li>
        <li class="list-group-item border-0 px-0">
            <div class="form-check form-switch ps-0">
                <input class="form-check-input ms-auto" type="checkbox"
                    id="flexSwitchCheckDefault4" wire:model.lazy="task_submission" {{ $task_submission ? 'checked' : null }}>
                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                    for="flexSwitchCheckDefault4">Notification on task submission</label>
            </div>
        </li>
        <li class="list-group-item border-0 px-0 pb-0">
            <div class="form-check form-switch ps-0">
                <input class="form-check-input ms-auto" type="checkbox"
                    id="flexSwitchCheckDefault5" wire:model.lazy="news_letter" {{ $news_letter ? 'checked' : null }}>
                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                    for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
            </div>
        </li>
    </ul>
</div>
