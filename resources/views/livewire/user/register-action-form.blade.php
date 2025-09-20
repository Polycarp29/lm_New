<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
        <div class="card card-plain mt-8">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">{{ $title }}</h3>
                <p class="mb-0">{{ $description }}</p>
            </div>
            <div class="card-body">
                @if (session()->has('message'))
                <div class="mb-4 text-green-500">
                    {{ session('message') }}
                </div>
                @endif

                @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <form wire:submit.prevent="register" role="form">
                    <label>Username</label>
                    <div class="mb-3">
                        <input type="text" class="form-control" wire:model="name" placeholder="Username"
                            aria-label="Text" aria-describedby="text-addon">
                        <div>
                            @if ($isFormSubmitted)
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @endif
                        </div>
                    </div>
                    <label>Email</label>
                    <div class="mb-3">
                        <input type="email" class="form-control" wire:model="email" placeholder="Email"
                            aria-label="Email" aria-describedby="email-addon">
                        <div>
                            @if ($isFormSubmitted)
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @endif
                        </div>
                    </div>

                    <label>Password</label>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Password" wire:model="password"
                            aria-label="Password" aria-describedby="password-addon">
                        <div>
                            @if ($isFormSubmitted == true )
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @endif
                        </div>
                    </div>
                    <label>Confirm Password</label>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Password"
                            wire:model="password_confirmation" aria-label="Password" aria-describedby="password-addon">
                        <div>
                            @if ($isFormSubmitted == true )
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @endif
                        </div>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="rememberMe" wire:model="remember">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign up</button>
                    </div>
                </form>

            </div>


            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                    Already registered?
                    <a href="{{ route('login') }}" class="text-info text-gradient font-weight-bold">Sign In</a>
                </p>
                <a href="{{ route('google.redirect')}}" class="btn btn-light btn-lg d-flex align-items-center shadow-sm border rounded-pill px-4 py-2">
                    <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Logo" class="me-2" width="24" height="24">
                    <span class="">Sign Up with Google</span>
                </a>
            </div>


        </div>
    </div>

    <div class="col-md-6">
        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                style="background-image: url('{{ asset('assets/images/curved-images/curved6.jpg') }}')"></div>
        </div>
    </div>
</div>