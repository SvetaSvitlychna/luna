<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class IndexPosts extends Component
{
    public function getPostsProperty(){

       return Post::with('category')
            ->with('user')
            ->get();
    }

    public function render()
    {
        return view('livewire.index-posts');
    }
}
