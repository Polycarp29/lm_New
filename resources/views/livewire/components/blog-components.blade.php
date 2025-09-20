    <div class="container mx-auto wow fadeIn">
        <div class="flex flex-col-reverse md:flex-row md:space-x-5">
            <div class="lg:w-2/3 w-full md:w-full flex-col  md:grid md:grid-cols-2 gap-4">
                @foreach ($blogs as $blog)
                    <div class="flex flex-col overflow-hidden">
                        <a href="{{ route('post.view', ['slug' => $blog->slug]) }}">
                            <img src="{{ asset('storage/' . $blog->featured_image) }}"></img>
                        </a>
                        <a href="{{ route('post.view', ['slug' => $blog->slug]) }}" class="text-gray-600 hover:text-red-600">
                            <h1 class="text-xl font-bold py-4">
                                {{ $blog->title }}
                            </h1>
                        </a>
                        <p class="text-base">
                            {{ strip_tags(Str::limit($blog->content, 100)) }}
                        </p>
                    </div>
                @endforeach
            </div>
            <div class="space-y-8">
                <!-- Search -->
                <div class="space-y-4 p-4 border rounded-md shadow-sm">
                    <h3 class="text-xl font-bold text-gray-800">Search Blogs</h3>
                    <form>
                        <input type="text" wire:model.live="search"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                               placeholder="Search...">
                    </form>
                </div>

                <!-- Recent Posts -->
                <div class="space-y-4 p-4 border rounded-md shadow-sm">
                    <h3 class="text-xl font-bold text-gray-800">Recent Topics</h3>
                    @foreach ($blogs->take(5) as $recent)
                        <div class="flex gap-4">
                            <a href="{{ route('post.view', ['slug' => $recent->slug]) }}" class="w-1/3">
                                <img src="{{ asset('storage/' . $recent->featured_image) }}" alt="{{ $recent->title }}"
                                     class="rounded-md object-cover h-[80px] w-full">
                            </a>
                            <div class="flex-1">
                                <a href="{{ route('post.view', ['slug' => $recent->slug]) }}">
                                    <h4 class="text-md font-semibold text-gray-700 hover:text-red-600 transition">
                                        {{ Str::limit($recent->title, 40) }}
                                    </h4>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Tags -->
                <div class="p-4 border rounded-md shadow-sm">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($tags as $getTag)
                            <button wire:click="getTags({{ $getTag['id'] }})"
                                    class="px-3 py-1 bg-red-600 text-white text-xs rounded-full hover:bg-red-700 transition">
                                {{ $getTag['name'] }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        {{-- Paginate --}}
        <div class="flex space-x-1 justify-center py-6">
            @if ($blogs->onFirstPage())
                <button
                    class="rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm text-slate-400 cursor-not-allowed disabled:pointer-events-none disabled:opacity-50 ml-2">
                    Prev
                </button>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled"
                    class="rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 ml-2">
                    Prev
                </button>
            @endif

            @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                @if ($page == $blogs->currentPage())
                    <button
                        class="min-w-9 rounded-md bg-slate-800 py-2 px-3 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 active:bg-slate-700 ml-2">
                        {{ $page }}
                    </button>
                @else
                    <button wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled"
                        class="min-w-9 rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 ml-2">
                        {{ $page }}
                    </button>
                @endif
            @endforeach

            @if ($blogs->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled"
                    class="rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 ml-2">
                    Next
                </button>
            @else
                <button
                    class="rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm text-slate-400 cursor-not-allowed disabled:pointer-events-none disabled:opacity-50 ml-2">
                    Next
                </button>
            @endif
        </div>
    </div>
