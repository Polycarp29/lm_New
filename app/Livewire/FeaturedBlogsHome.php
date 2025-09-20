<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class FeaturedBlogsHome extends Component
{

    public $components = 'Check Out What Is <em>Trending</em> In Our Latest <span>Blogs</span>';

    public $featuredPost;
    public $nonFeaturedPosts;

    public function mount()
    {
        return $this->getBlogs();
    }


    public function getBlogs()
    {
        $this->featuredPost = Post::with(['user', 'categories', 'tags', 'comments'])
            ->where('featured_post', true)
            ->first(); // Get the first featured post

        $this->nonFeaturedPosts = Post::with(['user', 'categories', 'tags', 'comments'])
            ->where('featured_post', false)
            ->take(3) // Limit to 3 non-featured posts
            ->get();
    }

    public function render()
    {
        return view('livewire.featured-blogs-home');
    }
}
