<?php

namespace Nht\Providers;

use Illuminate\Support\ServiceProvider;
use Elasticsearch\Client;
use Nht\Hocs\Posts\DbPostRepository;
use Nht\Hocs\Posts\EsPostRepository;
use Nht\Hocs\Posts\Post;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Nht\Hocs\Posts\PostRepository', 'Nht\Hocs\Posts\DbPostRepository');
        // $this->app->singleton('Nht\Hocs\Posts\PostRepository', 'Nht\Hocs\Posts\MongoPostRepository');
    }
}
