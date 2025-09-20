<section class="main-banner">
    @foreach ($pageData as $data)
        <div class="container mx-auto  wow fadeIn">
            {{-- About Us Small --}}
            <div class="flex flex-col header-text">
                <h3 class="text-xl font-semibold px-2 " style="border-left: 4px solid rgb(255, 196, 0);">
                    {{ $pageTitle }}
                </h3>
                <div class="py-6 w-full md:w-1/2">
                    <h1 class="text-5xl  block font-bold md:text-left">
                        <span class="text-red-600">Lee</span> <span class="text-yellow-500">Marketing</span>:
                    </h1>

                    <h1 class="text-3xl  block font-bold md:text-left">
                        {{ $data->top_header }}
                    </h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-100 p-8 border-l-4 border-yellow-400 shadow-sm">
                        <h2 class="text-xl font-bold mb-2 text-gray-800">
                            {{ $data->first_container_title }}
                        </h2>
                        <p class="text-gray-600 leading-relaxed">
                            {{ strip_tags($data->first_container_desc) }}
                        </p>
                    </div>

                    <div class="bg-gray-100 p-8 border-l-4 border-red-500 shadow-sm">
                        <h2 class="text-xl font-bold mb-2 text-gray-800">
                            {{ $data->second_container_title }}
                        </h2>
                        <p class="text-gray-600 leading-relaxed">
                            {{ strip_tags($data->second_container_dec) }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</section>
