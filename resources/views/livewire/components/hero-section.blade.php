<div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @foreach($heroData as $data)
                <div class="row" wire:key="{{ $data->id }}">
                    <div class="col-lg-6 align-self-center">
                        <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s"
                            data-wow-delay="1s">
                            <h6>{{ $data->l_smallheader	}}</h6>
                            {{-- <h2>We Make <em>Digital Ideas</em> &amp; <span>SEO</span> Marketing</h2> --}}
                            <h2>{!! $data->header !!}</h2>
                            <p>{{ strip_tags($data->description)}} </p>
                            {{-- @livewire('actions.request-analysis')

                            @livewireScripts --}}
                            <livewire:actions.request-analysis
                            />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                            <img src="{{ asset('storage/' .$data->hero_image)}}" alt="team meeting">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
