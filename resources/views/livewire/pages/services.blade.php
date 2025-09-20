<x-layouts.app>
    @section('title', strip_tags($pageHeader))
    @section('meta_title', strip_tags($pageHeader))
    @section('meta_description', $seoDetails->services_description)
    @section('meta_image', asset('storage/' . $seoDetails->logo))
    <section class='main-banner'>
        <div class="container mx-auto p-6">
            <div class="flex flex-col w-full md:w-1/2">
                <p class="text-xl font-semibold px-2" style="border-left: 4px solid rgb(255, 196, 0);"> Our Services</p>
                <h1 class="text-5xl font-bold py-6">
                    <span class="text-red-500"> {!! $pageHeader !!}
                </h1>
                <p class="text-xl leading-tight">{{ $headerDescription }}</p>
            </div>
        </div>
    </section>

    <section>
        <div class="container mx-auto wow fadeIn">
                @livewire('components.services')
        </div>
    </section>
</x-layouts.app>
