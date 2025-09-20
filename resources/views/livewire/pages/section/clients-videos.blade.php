<div class="flex flex-col md:flex-row  md:space-x-6 mt-10 border-8 border-red-600">
    @foreach($fetchVideos as $video)
    <video class="h-full w-full md:w-1/3 rounded-lg mb-4" controls loading="lazy">
        <source src="{{'storage/' . $video->attachment}}" type="video/mp4" />
        Your browser does not support the video tag.
    </video>
    @endforeach
</div>
