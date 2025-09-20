<div class="card-body px-0 pb-2">
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Company</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Task Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Completion</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <div class="p-4" style="width:400px;">
                    <input class="form-control" type="text" placeholder='Search anything'  wire:model.live.debounce.300ms="search" />
                </div>
                @forelse ($tasks as $data)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="{{ asset('assets/images/service-icon-04.png') }}"
                                        class="avatar avatar-sm me-3" alt="xd">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $data->company_issuer }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $data->task_name }}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <div class="progress-wrapper w-75 mx-auto">
                                @if($data->completion_status == 'completed')
                                    <div class="progress-percentage">
                                        <span class="text-xs font-weight-bold">100%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                @elseif($data->completion_status == 'in_progress')
                                    <div class="progress-percentage">
                                        <span class="text-xs font-weight-bold">60%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                @else
                                    <div class="progress-percentage">
                                        <span class="text-xs font-weight-bold">10%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                @endif
                            </div>
                        </td>

                        <td class="align-middle text-center text-sm">
                            <div class="d-flex">
                                <button class="btn w-60 px-3 mb-2 ms-2" style="background-color:green; color:white;"
                                    data-class="bg-white" onclick="sidebarType(this)">View</button>
                            </div>
                        </td>
                    </tr>
                    @empty

                    <tr>
                        <td colspan="2" class="border border-gray-300  text-center">
                            <div class="ms-6">
                                No Tasks Found
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">
            {{-- Previous Page Button --}}
            @if($tasks->onFirstPage())
                <a href="#" class="prev" disabled>Previous</a>
            @else
                <a href="#" wire:click="previousPage" wire:loading.attr="disabled" class="prev">Previous</a>
            @endif

            {{-- Page Numbers --}}
            @foreach($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                @if($page == $tasks->currentPage())
                    <a href="#" class="page active">{{ $page }}</a>
                @else
                    <a href="#" wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled" class="page">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next Page Button --}}
            @if($tasks->hasMorePages())
                <a href="#" wire:click="nextPage" wire:loading.attr="disabled" class="next">Next</a>
            @else
                <a href="#" class="next" disabled>Next</a>
            @endif
        </div>

    </div>
</div>
