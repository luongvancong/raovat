<?php

namespace Nht\Http\Controllers;

use App, URL;
use Illuminate\Http\Request;
use Nht\Hocs\Brands\BrandRepository;
use Nht\Hocs\Classifields\ClassifieldRepository;
use Nht\Hocs\PostCategories\PostCategoryRepository;
use Nht\Hocs\Posts\DbPostRepository;
use Nht\Hocs\ProductVideos\ProductVideoRepository;
use Nht\Hocs\Products\ProductRepository;
use Nht\Hocs\Questions\QuestionRepository;
use Nht\Http\Controllers\FrontendController;
use Nht\Http\Requests;

class SiteMapController extends FrontendController
{

	protected $postPerPage = 2000;

	public function __construct(ProductRepository $product, DbPostRepository $post, BrandRepository $brand, PostCategoryRepository $postCategory, ProductVideoRepository $video, ClassifieldRepository $classifield, QuestionRepository $qa) {
		ini_set('memory_limit', '-1');
		parent::__construct();
		$this->product = $product;
		$this->post    = $post;
		$this->brand   = $brand;
		$this->postCategory = $postCategory;
		$this->sitemap = App::make('sitemap');
		$this->video = $video;
		$this->classifield = $classifield;
		$this->qa = $qa;
	}

	public function getIndex() {

		// set cache
		// $this->sitemap->setCache('timhang.sitemap-index', 3600);

		// add sitemaps (loc, lastmod (optional))
		$this->sitemap->addSitemap(route('sitemap.post.index'));
		$this->sitemap->addSitemap(route('sitemap.product.index'));
		$this->sitemap->addSitemap(route('sitemap.brand.index'));
		$this->sitemap->addSitemap(route('sitemap.post_category.index'));
		$this->sitemap->addSitemap(route('sitemap.video.index'));

		// show sitemap
		return $this->sitemap->render('sitemapindex');
	}

	public function getProducts() {
		$products = $this->product->getNewProductsPaginated(40000);

		foreach($products as $product) {
			$this->sitemap->add($product->getUrl(), $product->updated_at, 0.8, 'daily');
		}

		return $this->sitemap->render('xml');
	}

	public function getPosts() {

		$totalPosts = $this->post->count();
		$perPage = $this->postPerPage;

		$part = ceil($totalPosts / $perPage);
		if($part == 0) $part = 1;

		for($i = 1; $i <= $part; $i ++) {
			$this->sitemap->addSitemap(route('sitemap.post-page.index', [$i]));
		}

		return $this->sitemap->render('sitemapindex');
	}


	public function getPostPage(Request $request, $page) {
		$totalPosts = $this->post->count();
		$perPage = $this->postPerPage;
		$part = ceil($totalPosts / $perPage);
		if($part == 0) $part = 1;

		$posts = $this->post->getPostsByPage($perPage, $page);

		foreach ($posts as $post)
    	{
        	$this->sitemap->add($post->getUrl(), $post->updated_at, 0.7, 'daily');
    	}

    	// show sitemap
    	return $this->sitemap->render('xml');
	}

	public function getPostCategory() {
		$postCategories = $this->postCategory->getAllCategories();

		foreach($postCategories as $postCategory) {
			$this->sitemap->add($postCategory->getUrl(), $postCategory->updated_at, 0.7, 'daily');
		}

		return $this->sitemap->render('xml');
	}

	public function getBrands() {
		$brands = $this->brand->getAllBrands();

		foreach($brands as $brand) {
			$this->sitemap->add($brand->getUrl(), $brand->updated_at, 0.9, 'daily');
		}

		return $this->sitemap->render('xml');
	}


	public function videoIndex()
	{
		$totalPosts = $this->video->count();
		$perPage = $this->postPerPage;

		$part = ceil($totalPosts / $perPage);
		if($part == 0) $part = 1;

		for($i = 1; $i <= $part; $i ++) {
			$this->sitemap->addSitemap(route('sitemap.video.page', [$i]));
		}

		return $this->sitemap->render('sitemapindex');
	}


	public function videoPage($page)
	{
		$totalPosts = $this->video->count();
		$perPage = $this->postPerPage;
		// $perPage = 10;
		$part = ceil($totalPosts / $perPage);
		if($part == 0) $part = 1;

		$videos = $this->video->getVideosByPage($perPage, $page);

		$content = view('frontend/sitemap/video/index', compact('videos'));

		return response()->view('frontend/sitemap/video/index', compact('videos'))->header('Content-Type', 'text/xml');
	}


	public function classifieldIndex()
	{
		$totalPosts = $this->classifield->count();
		$perPage = $this->postPerPage;

		$part = ceil($totalPosts / $perPage);
		if($part == 0) $part = 1;

		for($i = 1; $i <= $part; $i ++) {
			$this->sitemap->addSitemap(route('sitemap.classifield.page', [$i]));
		}

		return $this->sitemap->render('sitemapindex');
	}


	public function classifieldPage($page)
	{
		$totalPosts = $this->classifield->count();
		$perPage = $this->postPerPage;
		// $perPage = 10;
		$part = ceil($totalPosts / $perPage);
		if($part == 0) $part = 1;

		$posts = $this->classifield->getByPage($perPage, $page);

		foreach ($posts as $post)
    	{
        	$this->sitemap->add($post->getUrl(), $post->updated_at, 0.7, 'daily');
    	}

    	// show sitemap
    	return $this->sitemap->render('xml');
	}


	public function qaIndex()
	{
		$totalPosts = $this->qa->count();
		$perPage = $this->postPerPage;

		$part = ceil($totalPosts / $perPage);
		if($part == 0) $part = 1;

		for($i = 1; $i <= $part; $i ++) {
			$this->sitemap->addSitemap(route('sitemap.qa.page', [$i]));
		}

		return $this->sitemap->render('sitemapindex');
	}


	public function qaPage($page)
	{
		$totalPosts = $this->qa->count();
		$perPage = $this->postPerPage;
		// $perPage = 10;
		$part = ceil($totalPosts / $perPage);
		if($part == 0) $part = 1;

		$posts = $this->qa->getByPage($perPage, $page);

		foreach ($posts as $post)
    	{
        	$this->sitemap->add($post->getUrl(), $post->updated_at, 0.7, 'daily');
    	}

    	// show sitemap
    	return $this->sitemap->render('xml');
	}
}