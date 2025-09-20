<section class="relative bg-cover bg-center bg-no-repeat p-8">
    <img src="/assets/images/background.png" alt="Background" class="absolute inset-0 w-full h-full object-cover z-0 opacity-50">
    <div class="bg-transparent bg-opacity-80 backdrop-blur-sm rounded-lg p-8">
        @foreach($pageData as $data)
        <div id="services" class="mb-12">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="border-4 border-yellow-600 rounded-lg overflow-hidden">
                            <img src="assets/images/services-left-image.png" alt="" class="w-full h-auto">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
                        <div class="section-heading mt-4 lg:mt-0">
                            <h2 class="text-3xl font-bold text-gray-800">{!! $data->left_header !!}</h2>
                            <p class="mt-4 text-gray-600 text-lg leading-relaxed">
                                {{ strip_tags($data->left_description) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
