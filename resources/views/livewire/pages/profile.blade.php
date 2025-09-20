<x-layouts.dashboard>

    {{-- Top Section --}}
    <div class="main-content position-relative max-height-vh-100 h-100">
        <!-- Navbar -->
        <nav
            class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
            <div class="container-fluid py-1">
                <nav aria-label="breadcrumb">
                    <h6 class="text-white font-weight-bolder ms-2">Profile</h6>
                </nav>
                <div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">

                        </div>
                    </div>
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Logout</span>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 pe-0 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0">
                                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                    </div>
                                </a>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid">
            <div class="page-header min-height-250 border-radius-lg mt-4 d-flex flex-column justify-content-end">
                <span class="mask bg-primary opacity-9"></span>
                <div class="w-100 position-relative p-3">
                    <div class="d-flex justify-content-between align-items-end">
                        @if ($profileDetails->isNotEmpty())
                            @foreach ($profileDetails as $data)
                                @if ($data->fname && $data->lname)
                                    <!-- Check if both first and last names exist -->
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xl position-relative me-3">
                                            <img src="{{ $data->avatar ? asset('storage/' . $data->avatar) : asset('assets/images/user.png') }}"
                                                alt="profile_image" class="w-100 border-radius-lg shadow-sm">

                                        </div>
                                        <div>
                                            <h5 class="mb-1 text-white font-weight-bolder">
                                                {{ $data->fname . ' ' . $data->lname }}
                                            </h5>
                                        </div>
                                    </div>
                                @else
                                    <div class="container">
                                        <span>Please Complete your Profile Details</span>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="container">
                                <span>No profile details available</span>
                            </div>
                        @endif

                        <div class="d-flex align-items-center">
                            <a href="javascript:;" class="btn btn-outline-white mb-0 me-1 btn-sm">
                                Billing
                            </a>
                            <a href="javascript:;" class="btn btn-outline-white mb-0 btn-sm">
                                Payments
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Platform Settings</h6>
                        </div>
                        @livewire('user-dashboard.actions.email-preferences')
                    </div>
                </div>
                @livewire('user-dashboard.auth.update-profile-info')

                @livewire('user-dashboard.components.accounts')
            </div>
        </div>
    </div>
    </div>
    </div>

</x-layouts.dashboard>
