<div class="min-h-screen bg-gray-100 py-10">
    <div class="container mx-auto bg-white shadow-xl rounded-2xl p-10 text-gray-700 leading-relaxed min-w-96 m-6">
        {!! str_replace(
            [
                '<blockquote>', '</blockquote>',
                '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>',
                '<p>', '<a ', '<strong>', '<em>',
                '<ul>', '<ol>', '<li>',
                '<code>', '<pre>',
                '<img ', '<div>', '</div>'
            ],
            [
                '<blockquote class="border-l-4 border-red-600 bg-red-50 pl-6 italic my-6 text-gray-800 font-medium">',
                '</blockquote>',
                '<h1 class="text-4xl font-bold text-gray-900 mb-6">',
                '<h2 class="text-3xl font-semibold text-gray-800 mb-5">',
                '<h3 class="text-2xl font-medium text-gray-700 mb-4">',
                '<h4 class="text-xl font-medium text-gray-600 mb-3">',
                '<h5 class="text-lg font-medium text-gray-500 mb-2">',
                '<h6 class="text-base font-medium text-gray-400 mb-1">',
                '<p class="mb-4 text-lg text-gray-700">',
                '<a class="text-blue-600 hover:underline transition duration-200 ease-in-out" ',
                '<strong class="font-bold text-gray-900">',
                '<em class="italic text-gray-600">',
                '<ul class="list-disc list-inside space-y-2 mb-6 pl-6 bg-red-50 rounded border-l-4 border-red-500 py-4">',
                '<ol class="list-decimal list-inside space-y-2 mb-6 pl-6">',
                '<li class="ml-2 text-gray-800">',
                '<code class="bg-gray-100 text-red-600 px-2 py-1 rounded text-sm">',
                '<pre class="bg-gray-900 text-white p-4 rounded-lg overflow-x-auto my-6 text-sm font-mono">',
                '<img class="rounded-lg shadow-lg my-6 max-w-full h-auto" ',
                '<div class="bg-red-50 text-xl font-bold p-4 rounded-lg shadow-inner">',
                '</div>',
            ],
            $data->sop_content
        ) !!}
    </div>
</div>

