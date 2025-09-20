<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tags;
use Whoops\Util\Misc;
use App\Models\Category;
use App\Models\Miscs;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //


    public function index()
    {
        $pagetitle = 'See </span><span class="text-yellow-500"> what we  </span>wrote:';

        $description = 'Explore our informative blogs we wrote concerning various topics';

        $seoDetails = Miscs::first();


        return view('livewire.pages.blog', compact('pagetitle', 'description', 'seoDetails'));
    }


    public function loadPost($slug)
    {
        $showPosts = Post::with(['user', 'categories', 'tags', 'comments'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $previousPost = Post::where('id', '<', $showPosts->id)
            ->where('status', 'published')
            ->orderBy('id', 'desc')
            ->first();

        $nextPost = Post::where('id', '>', $showPosts->id)
            ->where('status', 'published')
            ->orderBy('id', 'asc')
            ->first();

        $showTags = Tags::latest()->take(10)->get();
        $getCategories = Category::has('posts')->take(10)->get();

        $featuredImage = $showPosts->featured_image
            ? asset('storage/' . $showPosts->featured_image)
            : asset('assets/top-logo.png');

        return view('livewire.pages.view-blog', compact(
            'showPosts',
            'showTags',
            'getCategories',
            'previousPost',
            'nextPost',
            'featuredImage'
        ));
    }


}
