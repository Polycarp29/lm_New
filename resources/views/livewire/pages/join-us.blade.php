<x-layouts.app>
    @section('title', 'Join Our Lee Marketing Team')
    @section('meta_title', 'Join Our Lee Marketing Team')
    @section('meta_description', $seoDetails->join_us_seo)
    @section('meta_image', asset('storage/' . $seoDetails->logo))

    @livewire('pages.section.upper-section-join-us')
    <section class="mx-auto container wow fadeIn border">
        <div class="mt-6">
            <h3 class="text-3xl font-bold px-4" style="border-left:4px solid rgb(238, 43, 9)">
                Here is what our clients have to say
            </h3>
        </div>
       @livewire('pages.section.clients-videos')
    </section>
    @livewire('pages.section.careers-section-join-us')
    @livewire('section.lee-marketing-partners')
</x-layouts.app>
