<div class="col-lg-4 col-md-6">
    <div class="card h-100">
        <div class="card-header pb-0">
            <h6>{{ $cardtitle }}</h6>
            <p class="text-sm">
                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                {{ $description }}
            </p>
        </div>
        <div class="card-body p-3">
            <div class="timeline timeline-one-side">
                @foreach ($getPaymentDetails as $payments)
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="ni ni-bell-55 text-success text-gradient"></i>
                        </span>
                        <div class="timeline-content">
                            <a href="#">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">
                                    {{ $payments->transaction_id . ', ' . $payments->currency . ' ' . $payments->amount }}
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $payments->created_at }}
                                </p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
