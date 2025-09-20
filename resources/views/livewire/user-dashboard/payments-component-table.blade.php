<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="row">
                    <div class="card-header pb-0">
                        <h6>All Payments</h6>
                    </div>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <div class="p-4" style="width:400px;">
                                <input class="form-control" type="text" placeholder='Search anything'  wire:model.live.debounce.300ms="search" />
                            </div>
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Task Description</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $data)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $data->transaction_id }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        @if($data->task)
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $data->task->company_issuer}}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $data->task->task_name}}</p>
                                            </td>
                                        @endif
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{ $data->status ? 'Processed' : ''}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $data->created_at}}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('reciept_pdf', ['task_id' => $data->task_id])}}" class="text-secondary font-weight-bold text-xs btn btn-outline-primary btn-sm mb-0 me-3" data-toggle="tooltip" data-original-title="Edit user">
                                                Download PDF
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Paginate --}}
                        <div class="pagination">
                            {{-- Previous Page Button --}}
                            @if($payments->onFirstPage())
                                <a href="#" class="prev" disabled>Previous</a>
                            @else
                                <a href="{{ $payments->previousPageUrl() }}" class="prev">Previous</a>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach($payments->getUrlRange(1, $payments->lastPage()) as $pageNumber => $url)
                                <a href="{{ $url }}" class="page {{ $payments->currentPage() == $pageNumber ? 'active' : '' }}">{{ $pageNumber }}</a>
                            @endforeach

                            {{-- Next Page Button --}}
                            @if($payments->hasMorePages())
                                <a href="{{ $payments->nextPageUrl() }}" class="next">Next</a>
                            @else
                                <a href="#" class="next" disabled>Next</a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
