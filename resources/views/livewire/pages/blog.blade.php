<x-layouts.app>
    @section('title', strip_tags($pagetitle))
    @section('meta_title', strip_tags($pagetitle))
    @section('meta_description', $seoDetails->blog_seo)
    @section('meta_image', asset('storage/' . $seoDetails->logo))
    <section class="main-banner">
        <div class="container mx-auto p-6">
            <div class="flex flex-col w-full md:w-1/2">
                <p class="text-xl font-semibold px-2" style="border-left: 4px solid rgb(255, 196, 0);"> Blog</p>
                <h1 class="text-5xl font-bold py-6">
                    <span class="text-red-500">{!! $pagetitle !!}
                </h1>
                <p class="text-xl leading-tight"> {{ $description }}</p>
            </div>
        </div>
    </section>

   @livewire('components.blog-components')
   @livewireScripts

</x-layouts.app>
