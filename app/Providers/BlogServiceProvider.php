<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\PostRepository;

class BlogServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind repository or services here
        $this->app->singleton('post.repository', function ($app) {
            return new PostRepository();
        });
    }

    public function boot()
    {
        //
    }
}
