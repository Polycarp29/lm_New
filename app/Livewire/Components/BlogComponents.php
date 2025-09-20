<?php

namespace App\Livewire\Components;

use Log;
use App\Models\Post;
use App\Models\Tags;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class BlogComponents extends Component
{
    use WithPagination;

    public $search = "";


    public $category = null;
    public $tag = null;

    protected $queryString = ['search', 'tag', 'category'];

    public $metaTitle;

    public $getCategories = [];
    public $getTags = [];

    public function mount()
{
    $this->getCategories = Category::all()->toArray() ?? [];
    $this->getTags = Tags::all()->toArray() ?? [];
}


    public function updatingSearch()
    {

        $this->resetPage();
    }

    public function getCategory($categoryId)
    {
        $this->category = $categoryId;
        $this->resetPage();
    }

    public function getTags($tagId)
    {
        $this->tag = $tagId;
        $this->resetPage();
    }

    public function render()
    {
        $blogs = Post::query()
            ->when($this->tag, fn($query) => $query->whereHas('tags', fn($query) => $query->where('id', $this->tag)))
            ->when($this->search, fn($query) => $query->where('title', 'like', '%' . $this->search . '%'))
            ->where('status', 'published')
            ->with(['user', 'categories', 'tags', 'comments'])
            ->paginate(5);
        return view('livewire.components.blog-components', [
            'blogs' => $blogs,
            'categories' => $this->getCategories,
            'tags' => $this->getTags,
        ]);
    }




}
