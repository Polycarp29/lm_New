<section class="main-banner">
    @foreach($getData as $data )
    <div class="mx-auto container p-6">
        <div class="w-full md:w-1/2">
            <p class="text-xl font-semibold px-2" style="border-left: 4px solid rgb(255, 196, 0);">Customer Success
            </p>
            <h2 class="text-5xl font-bold">{!! $data->header  !!}</h2>
            <p class="text-xl leading-tight text-gray-500 mt-6">
               {{ strip_tags($data->description) }}
            </p>
        </div>
    </div>
    @endforeach
</section>
