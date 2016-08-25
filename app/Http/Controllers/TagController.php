<?php namespace Nht\Http\Controllers;

use Illuminate\Http\Request;
use Nht\Hocs\Posts\PostRepository;
use Nht\Hocs\ProductPrices\ProductPriceRepository;
use Nht\Hocs\ProductVideos\ProductVideoRepository;
use Nht\Hocs\Products\ProductRepository;
use Nht\Hocs\Tags\TagRepository;
use Nht\Http\Controllers\FrontendController;
use Nht\Http\Requests;

class TagController extends FrontendController
{
    protected $post;
    protected $product;

    public function __construct(ProductRepository $product, TagRepository $tag)
    {
        parent::__construct();
        $this->product = $product;
        $this->tag = $tag;
    }

    public function getIndex(Request $request, $tag)
    {

        $products = [];

        $tagObject = $this->tag->getBySlug($tag);

        $products = $this->product->searchProductsPaginated($tag, 12, $this->getSortParams($request), $request->all());

        // Posts by tags
        $posts = $tagObject ? $tagObject->posts()->paginate(20) : collect([]);

        // Videos by tags
        $videos = $tagObject ? $tagObject->videos()->paginate(20) : collect([]);

        $arraySort = [
            1 => 'Giá tăng dần',
            2 => 'Giá giảm dần'
        ];

        if($tagObject) {
            $metaTitle = $tagObject->getMeta('title') ? $tagObject->getMeta('title') : 'Thông tin liên quan với từ khóa ' . $tag;
            $metaKeyword = $tagObject->getMeta('keywords') ? $tagObject->getMeta('keywords') : $tag;
            $metaDescription = $tagObject->getMeta('description') ? $tagObject->getMeta('description') : "Sản phẩm với từ khóa {$tag}, Tin tức với từ khóa {$tag}, Video với từ khóa {$tag}, So sánh giá {$tag}";
            $this->metadata->setMetaTitle($metaTitle);
            $this->metadata->setMetaKeyword($metaKeyword);
            $this->metadata->setMetaDescription($metaDescription);
        }

        return view('frontend/tags/index', compact('products', 'arraySort', 'tag', 'posts', 'videos'));
    }


    public function getSortParams(Request $request) {
        $sortBy = $request->get('sort_by');

        switch ($sortBy) {
            case 1:
                return ['price', 'ASC'];

            case 2:
                return ['price', 'DESC'];

            default:
                return ['price', 'ASC'];
        }
    }
}