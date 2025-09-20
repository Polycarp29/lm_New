<div class="card shadow h-100">
    <div class="card-header pb-0 p-3">
        <h6 class="mb-0">{{ $title }}</h6>
    </div>
    <div class="card-body pb-0 p-3">
        @if ($reviewData)
            <ul class="list-group">
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <div class="w-100">
                        <div class="d-flex mb-2">
                            <span class="me-2 text-sm font-weight-bold text-dark">Task Name:</span>
                            <span class="ms-auto text-sm font-weight-bold">{{ $reviewData['task']->task_name }}</span> <!-- Task Name -->
                        </div>
                        <div class="d-flex mb-2">
                            <span class="me-2 text-sm font-weight-bold text-dark">Positive Reviews</span>
                            <span class="ms-auto text-sm font-weight-bold">{{ $reviewData['positivePercentage'] }}%</span>
                        </div>
                        <div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="{{ $reviewData['positivePercentage'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $reviewData['positivePercentage'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <div class="w-100">
                        <div class="d-flex mb-2">
                            <span class="me-2 text-sm font-weight-bold text-dark">Neutral Reviews</span>
                            <span class="ms-auto text-sm font-weight-bold">{{ $reviewData['neutralPercentage'] }}%</span>
                        </div>
                        <div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{ $reviewData['neutralPercentage'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $reviewData['neutralPercentage'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <div class="w-100">
                        <div class="d-flex mb-2">
                            <span class="me-2 text-sm font-weight-bold text-dark">Negative Reviews</span>
                            <span class="ms-auto text-sm font-weight-bold">{{ $reviewData['negativePercentage'] }}%</span>
                        </div>
                        <div>
                            <div class="progress progress-md">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="{{ $reviewData['negativePercentage'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $reviewData['negativePercentage'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        @else
            <p>No approved tasks found for reviews.</p>
        @endif
    </div>
    <div class="card-footer pt-0 p-3 d-flex align-items-center">
        <div class="w-60">
            <p class="text-sm">
                Check your reviews on your performance on the most recent approved task.
            </p>
        </div>
        <div class="w-40 text-end">
            <!-- Collapsible View All Reviews Button -->
            <button class="btn btn-dark mb-0 text-end" type="button" data-bs-toggle="collapse" data-bs-target="#reviewsCollapse" aria-expanded="false" aria-controls="reviewsCollapse">
                View all reviews
            </button>
        </div>
    </div>
    <div class="collapse" id="reviewsCollapse">
        <div class="card-body">
            <!-- Your code to show all reviews (redirect or show more details) -->
            <p></p>
        </div>
    </div>
</div>
