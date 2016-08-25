<?php

namespace Nht\Console\Commands;

use Illuminate\Console\Command;
use Nht\Hocs\Posts\Post;
use Nht\Hocs\Products\Product;
use Nht\Hocs\ProductPrices\ProductPrice;
use Elasticsearch\Client;

use Nht\Hocs\ProductVideos\ProductVideo;

class IndexPostsToESCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:es-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all posts to Elastic Search.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $es = new Client();
        $posts = Post::all();
        foreach ($posts as $model)
        {
            $es->index([
                'index' => 'nht-test',
                'type' => 'posts',
                'id' => $model->id,
                'body' => $model->toArray()
            ]);
        }

        $products = Product::all();
        foreach ($products as $model)
        {
            $data = $model->toArray();
            $data['price'] = (int) $data['price'];
            $es->index([
                'index' => 'nht-test',
                'type' => 'products',
                'id' => $model->id,
                'body' => $data
            ]);
        }

        $videos = ProductVideo::all();
        foreach ($videos as $model)
        {
            $es->index([
                'index' => 'nht-test',
                'type' => 'videos',
                'id' => $model->id,
                'body' => $model->toArray()
            ]);
        }

        $prices = ProductPrice::all();
        foreach ($prices as $model)
        {
            $es->index([
                'index' => 'nht-test',
                'type' => 'prices',
                'id' => $model->id,
                'body' => $model->toArray()
            ]);
        }

        $productImages = \DB::table('product_images')->get();
        foreach($productImages as $image) {
            $es->index([
                'index' => 'nht-test',
                'type'  => 'images',
                'id'    => $image->id,
                'body'  => (array) $image
            ]);
        }
    }
}
