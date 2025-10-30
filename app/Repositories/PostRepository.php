<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    public function recent($count = 10)
    {
        return Post::with('author')->latest()->take($count)->get();
    }
}
