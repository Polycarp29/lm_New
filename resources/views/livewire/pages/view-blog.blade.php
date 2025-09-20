<x-layouts.app>


    @section('title', $showPosts->title)
    @section('meta_title', $showPosts->title)
    @section('meta_description', Str::limit(strip_tags($showPosts->content), 250))
    @section('meta_image', $featuredImage)

    <section>
        <div class="flex flex-col md:flex-row md:mt-12 container mx-auto py-12 space-x-4">
            <!-- Main Content -->
            @if ($showPosts)
                <div class="md:w-2/3 w-full p-12 mt-10">
                    <div class="flex flex-col justify-start">
                        <h1 class="font-bold text-3xl text-gray-600 leading-tight">
                            {{ $showPosts->title }}
                        </h1>

                        <img src="{{ $showPosts->featured_image ? asset('storage/' . $showPosts->featured_image) : asset('assets/top-logo.png') }}"
                            alt="{{ $showPosts->title }}" class="md:h-[500px] w-full object-cover" />

                        <div class="flex flex-row p-6 md:justify-between items-center space-x-6">
                            <div class="flex items-center space-x-2">
                                <!-- Comment Icon -->
                                <svg class="w-6 h-6 text-gray-500" ...>...</svg>
                                <p class="text-red-600 text-sm mt-4">Comments</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <!-- Date Icon -->
                                <svg class="w-6 h-6 text-gray-500" ...>...</svg>
                                        <p class="text-red-600 text-sm mt-4">
                                        {{ $showPosts->created_at ? $showPosts->created_at->format('d M Y') : 'Date not available' }}
                                    </p>

                            </div>
                        </div>

                        <!-- Content -->
                        <div class="mt-6 text-lg text-gray-700">
                            {!! str_replace(
                                [
                                    '<blockquote>', '</blockquote>', '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>',
                                    '<p>', '<a ', '<strong>', '<em>', '<ul>', '<ol>', '<li>', '<code>', '<pre>',
                                    '<img ', '<div>', '</div>'
                                ],
                                [
                                    '<blockquote class="border-l-4 border-gray-600 bg-red-100 pl-6 italic p-6 mt-6 mb-6 text-gray-700 font-medium leading-relaxed">',
                                    '</blockquote>',
                                    '<h1 class="font-bold text-4xl text-gray-900 tracking-tight leading-tight mb-4">',
                                    '<h2 class="font-semibold text-3xl text-gray-800 tracking-wide leading-snug mb-4">',
                                    '<h3 class="font-medium text-2xl text-gray-700 leading-snug mb-3">',
                                    '<h4 class="font-medium text-xl text-gray-600 leading-snug mb-3">',
                                    '<h5 class="font-medium text-lg text-gray-500 leading-snug mb-2">',
                                    '<h6 class="font-medium text-base text-gray-400 leading-snug mb-2">',
                                    '<p class="mb-4 text-gray-600 text-lg leading-relaxed">',
                                    '<a class="text-red-600 hover:text-blue-800 underline transition duration-200 ease-in-out" ',
                                    '<strong class="font-bold text-gray-900">',
                                    '<em class="italic text-gray-700">',
                                    '<ul class="list-disc list-inside space-y-2 mb-4 px-6 py-6 bg-red-50 font-semibold rounded border-l-4 border-red-600">',
                                    '<ol class="list-decimal list-inside space-y-2 mb-4">',
                                    '<li class="ml-4 text-gray-800">',
                                    '<code class="px-1 py-0.5 bg-gray-200 rounded text-red-600 text-sm">',
                                    '<pre class="bg-gray-900 text-white p-4 rounded-lg overflow-x-auto mt-4 mb-4 text-sm font-mono">',
                                    '<img class="rounded-lg shadow-lg my-4 max-w-full h-auto" ',
                                    '<div class="bg-red-50 text-xl font-bold"',
                                    '</div>',
                                ],
                                $showPosts->content,
                            ) !!}
                        </div>

                        <!-- Related Posts -->
                        <div class="flex justify-between mt-10 space-x-4">
                            @if ($previousPost)
                                <div class="p-6 bg-gray-200 rounded-md shadow-md flex items-center space-x-4 w-full md:w-[48%]">
                                    <img src="{{ $previousPost->featured_image ? asset('storage/' . $previousPost->featured_image) : asset('assets/top-logo.png') }}"
                                        alt="{{ $previousPost->title }}" class="w-[80px] h-[80px] object-cover rounded-md" />
                                    <div class="ml-4">
                                        <a href="{{ route('post.view', $previousPost->slug) }}"
                                            class="text-red-600 hover:underline hover:text-yellow-600 font-medium text-lg">
                                            ← Previous Blog: {{ $previousPost->title }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            @if ($nextPost)
                                <div class="p-6 bg-gray-200 rounded-md shadow-md flex items-center space-x-4 w-full md:w-[48%]">
                                    <img src="{{ $nextPost->featured_image ? asset('storage/' . $nextPost->featured_image) : asset('assets/top-logo.png') }}"
                                        alt="{{ $nextPost->title }}" class="w-[80px] h-[80px] object-cover rounded-md" />
                                    <div class="ml-4">
                                        <a href="{{ route('post.view', $nextPost->slug) }}"
                                            class="text-blue-600 hover:underline font-medium text-lg hover:text-yellow-600">
                                            Next Blog: {{ $nextPost->title }} →
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Sidebar -->
            <div class="md:w-1/3 w-full p-12 mt-10 rounded-xl">
                <!-- Comments -->
                <div class="bg-gray-300 p-8 mb-5 rounded-lg">
                    <h1 class="text-xl font-semibold">Recent Comments:</h1>
                    @if ($showPosts->comments->count())
                        <ul class="mt-4 space-y-2">
                            @foreach ($showPosts->comments->take(5) as $comment)
                                <li class="text-sm text-gray-700 border-b pb-2">{{ $comment->content }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-600 text-sm mt-2">No comments yet. Be the first to comment!</p>
                    @endif
                </div>

                <!-- Tags -->
                <div class="bg-gray-300 p-8 mb-5 rounded-lg">
                    <h1 class="text-xl font-semibold">Popular Tags:</h1>
                    <ul class="text-gray-600 text-sm mt-2 space-y-1">
                        @foreach ($showTags as $tag)
                            <li><a href="" class="hover:text-red-600">#{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Categories -->
                <div class="bg-gray-300 p-8 mb-5 rounded-lg">
                    <h1 class="text-xl font-semibold">Popular Categories:</h1>
                    <ul class="text-gray-600 text-sm mt-2 space-y-1">
                        @foreach ($getCategories as $category)
                            <li><a href="" class="hover:text-red-600">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
