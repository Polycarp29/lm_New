<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
        <div class="row">
            @foreach($navData as $data )
            <div class="col-12" wire:key="{{ $data->id}}">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('home') }}" class="logo py-4">
                        {{-- <h4>Spac<span>Dyna</span></h4> --}}
                        <img src="{{ asset('storage/' .$data->logo)}}" style="width:80px; height:45px;">
                    </a>

                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="{{ route('home') }}"
                                class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                        <li class="scroll-to-section"><a href="{{ route('about_us') }}"
                                class="{{ request()->routeIs('about_us') ? 'active' : '' }}">About Us</a></li>
                        <li class="scroll-to-section" class="{{ request()->routeIs('services') ? 'active' : '' }}">
                            <a href="{{ route('services') }}"
                                class="{{ request()->routeIs('services') ? 'active' : '' }}">Services
                            </a>
                        </li>
                        <li class="scroll-to-section" class="{{ request()->routeIs('join_us') ? 'active' : ''}}">
                            <a href="{{ route('join_us')}}"  class="{{ request()->routeIs('join_us') ? 'active' : ''}}">Join Us</a>
                        </li>
                        <li class="scroll-to-section "><a href="{{ route('blog') }}"
                                class="{{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a></li>
                        <li class="scroll-to-section">
                            <div class="main-red-button"><a class="calendly-inline-widget" href="https://calendly.com/leemarketingservices2024/30min"> Contact Now</a></div>
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
            @endforeach
        </div>
    </div>
</header>

