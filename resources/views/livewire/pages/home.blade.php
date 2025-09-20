<x-layouts.app>

    @section('title', $seoDetails->brand_name)
    @section('meta_title', $seoDetails->meta_description)
    @section('meta_description', $seoDetails->meta_description)
    @section('meta_image', asset('storage/' . $seoDetails->logo))

    {{-- Hero start --}}
    <livewire:components.hero-section />
    {{-- Hero End --}}

    {{-- About Us --}}
    <div id="about" class="about-us section">
        <div class="container">
            @foreach ($aboutConfig as $entry)
                <div class="row">
                    @if ($entry->rightImage)
                        <div class="col-lg-4">
                            <div class="left-image wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
                                <img src={{ asset('storage/' . $entry->rightImage->right_image) }}
                                    alt="{{ $entry->rightImage->alt }}">
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-8 align-self-center">
                        <div class="services">
                            <div class="row">
                                @foreach ($entry->homeAboutUs as $dataEntry)
                                    <div class="col-lg-6">
                                        <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                                            <div class="icon">
                                                <img src="{{ asset('storage/' . $dataEntry->icon) }}" alt="reporting">
                                            </div>
                                            <div class="right-text block text-left">
                                                <h4>{{ $dataEntry->header }}</h4>
                                                <p>{{ strip_tags($dataEntry->description) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
    {{-- End About Us --}}

    {{-- Services --}}
    <div id="services" class="our-services section">
        <div class="container">
            @foreach ($aboutUsBanner as $entryBanner)
                <div class="row">
                    @if ($entryBanner->bannerImage)
                        <div class="col-lg-6 align-self-center  wow fadeInLeft" data-wow-duration="1s"
                            data-wow-delay="0.2s">
                            <div class="left-image">
                                <img src="{{ asset('storage/' . $entryBanner->bannerImage->banner_image) }}"
                                    alt="">
                            </div>
                        </div>
                    @endif


                    <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="section-heading">
                            <h2>{!! $entryBanner->header !!}</h2>
                            <p>{{ strip_tags($entryBanner->description) }}</p>
                        </div>
                        <div class="row">
                            @foreach ($entryBanner->bannerBars as $bars)
                                <div class="col-lg-12">
                                    <div class="{{ $bars->bar_string }}">
                                        <h4>{{ $bars->bar_description }}</h4>
                                        <span>{{ $bars->percentage }}%</span>
                                        <div class="filled-bar"></div>
                                        <div class="full-bar"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- Portfolio --}}
    <div id="portfolio" class="our-portfolio section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading  wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
                        <h2>Our Company's <em>Core</em> Value to <span>Customers</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($portfolio as $portfolioentry)
                    <div class="col-lg-3 col-sm-6">
                        <a href="#">
                            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                                <div class="hidden-content">
                                    <h4>{{ $portfolioentry->header }}</h4>
                                    <p>{{ strip_tags($portfolioentry->description) }}</p>
                                </div>
                                <div class="showed-content">
                                    <img src="{{ asset('storage/' . $portfolioentry->icon) }}" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Portfolio --}}

    {{-- Blog --}}
    <livewire:featured-blogs-home />
    {{-- Blog --}}

    {{-- Contact Form --}}
    <x-contact_form />


</x-layouts.app>
