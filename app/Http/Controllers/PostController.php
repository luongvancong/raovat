<?php namespace Nht\Http\Controllers;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Nht\Http\Controllers\FrontendController;

use Nht\Hocs\Posts\PostRepository;
use Nht\Hocs\Posts\DbPostRepository;

use Nht\Hocs\PostCategories\PostCategoryRepository;

use Nht\Hocs\Products\ProductRepository;

use OpenGraph;

class PostController extends FrontendController
{
	public function __construct(DbPostRepository $post, ProductRepository $product,
	                            PostCategoryRepository $postCategory) {
		parent::__construct();
		$this->post         = $post;
		$this->product      = $product;
		$this->postCategory = $postCategory;
	}

	public function getIndex(Request $request) {
		$postType = $request->get('type', 'post');
		$productId = (int) $request->get("product_id");
		$filterParamsSearch = $request->all();
		if($q = $request->get('q')) {
			// Nếu tìm kiếm đánh giá của sản phẩm
			if($productId > 0) {
				$product = $this->product->getById($productId);
				if($postType == 'review') {
					$posts = $this->post->searchReviewPostsRelateWithProduct($product);
				} else {
					$posts = $this->post->searchPostsRelateWithProduct($product);
				}
			} else {
				$posts = $this->post->searchWithPaginate($q, 20, $filterParamsSearch);
			}

		} else {
			$posts = $this->post->getPosts();
		}

		// _debug($posts->total());die;

		$categories = $this->postCategory->getAllCategories();

		// Metadata
		$this->metadata->setTitle(firstLetterUpperCase($request->server('SERVER_NAME')) . '|Tin tức công nghệ nóng hổi cập nhật từng giây - trang ' . $request->get('page', 1));
		$this->metadata->setMetaDescription('Tin tức công nghệ, cập nhật so sánh giá iphone6s, glaxy s6, blackberry...');

		return view('frontend/post/index', compact('posts', 'categories'));
	}

	public function getDetail(Request $request,$catId, $catSlug, $id, $slug) {

		$post = $this->post->getById($id);

		if($slug != $post->getSlug()) {
			return redirect()->to(route('post.detail', [$catId, $catSlug, $id, $post->getSlug()]), 301);
		}

		$this->post->incrementViews($post);

		$category = $this->postCategory->find($catId);

		if(!$category) {
			// $category = $this->postCategory->getInstance();
			// $category->setId(0);
			// $category->setName($post->getCategory());

			$category = $this->postCategory->find($post->getCategoryId());
			return redirect()->to(route('post.detail', [$category->getId(), $category->getSlug(), $id, $post->getSlug()]), 301);
		}

		$products          = $this->product->search($post->getTitle(), 5);
		$relatedPosts      = $this->post->getRelatePosts($post, 10);
		$mostViewPosts     = $this->post->getMostViewPosts();
		$newestPosts       = $this->post->getNewestPosts();
		$sameCategoryPosts = $this->post->getPostsInCategoryStr($post->category);

		// Metadata
		$this->metadata->setTitle($post->getTitle());
		$this->metadata->setMetaKeyword(generateKeywords($post->getTitle()));
		$this->metadata->setMetaDescription(cutString(strip_tags($post->getContent())), 160);

		//Image User
		$openGraph = OpenGraph::setTitle($this->metadata->getTitle())
						->setType("article")
						->setUrl($request->url())
						->setImage( asset($post->getImage()) )
						->setDescription($this->metadata->getMetaDescription())
						->facebook(function($facebook) {
							$facebook->setAdmins(100001247771720);
						})
						->google(function($google) {
							$google->setName($this->metadata->getTitle());
							$google->setDescription($this->metadata->getMetaDescription());
							$google->setImage( asset('/img/'. $this->metadata->getLogo()) );
						})
						->twitter(function($twitter) use($request, $post) {
							$twitter->setCard('article');
						    $twitter->setSite($request->url());
						    $twitter->setTitle($this->metadata->getTitle());
						    $twitter->setDescription($this->metadata->getMetaDescription());
						    $twitter->setImage( asset($post->getImage()) );
						})
						->generate();
		// dd($openGraph);


		return view('frontend/post/detail', compact('post', 'category' ,'relatedPosts',
			'products', 'mostViewPosts', 'newestPosts', 'sameCategoryPosts', 'openGraph'));
	}

	public function getPostCategory(Request $request, $catId, $categorySlug) {
		$category = $this->postCategory->find($catId);

		if(!$category) {
			$category = $this->postCategory->getInstance();
			$category->setName($categorySlug);
		}

		$posts = $this->post->searchByCategoryPaginated($category->getName(), 20);
		$categories = $this->postCategory->getAllCategories();
		return view('frontend/post/category', compact('posts', 'categories', 'category'));
	}


	public function ajaxGetImagePost(Request $request) {
		$postId = (int) $request->get('post_id');
		$post = $this->post->getById($postId);
		$image = $post->getImageFromContent();
		return response()->json([
		    'code' => 1,
		    'image' => $image ? $image : PATH_STATIC . 'images/grey.gif'
		]);
	}


	public function getPostDetailAmp(Request $request, $id)
	{
		$post = $this->post->getById($id);

		$catId = $post->getCategoryId();

		$this->post->incrementViews($post);

		$category = $this->postCategory->find($catId);

		if(!$category) {
			// $category = $this->postCategory->getInstance();
			// $category->setId(0);
			// $category->setName($post->getCategory());

			$category = $this->postCategory->find($post->getCategoryId());
			return redirect()->to(route('post.detail', [$category->getId(), $category->getSlug(), $id, $post->getSlug()]), 301);
		}

		$products          = $this->product->search($post->getTitle(), 5);
		$relatedPosts      = $this->post->getRelatePosts($post, 10);
		$mostViewPosts     = $this->post->getMostViewPosts();
		$newestPosts       = $this->post->getNewestPosts();
		$sameCategoryPosts = $this->post->getPostsInCategoryStr($post->category);

		// Metadata
		$this->metadata->setTitle($post->getTitle());
		$this->metadata->setMetaKeyword(generateKeywords($post->getTitle()));
		$this->metadata->setMetaDescription(cutString(strip_tags($post->getContent())), 160);

		return view('frontend/post/amp', compact('post', 'category' ,'relatedPosts', 'products', 'mostViewPosts', 'newestPosts', 'sameCategoryPosts'));
	}
}
