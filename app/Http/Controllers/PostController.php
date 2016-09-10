<?php namespace Nht\Http\Controllers;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Nht\Http\Requests\UserPostFormRequest;

use Nht\Http\Controllers\FrontendController;

use Nht\Hocs\Posts\PostRepository;
use Nht\Hocs\Posts\DbPostRepository;

use Nht\Hocs\Users\UserRepository;

use Nht\Hocs\PostCategories\PostCategoryRepository;
use Nht\Hocs\Cities\CityRepository;

use Nht\Hocs\Products\ProductRepository;
use DB;
use OpenGraph;

use App;
use Config;
use Nht\Hocs\Posts\PostImage;
use Input;
use File;
use ImageIntervention;

class PostController extends FrontendController
{
	public function __construct(DbPostRepository $post, ProductRepository $product,
	                            PostCategoryRepository $postCategory, CityRepository $postCity,UserRepository $user, PostImage $post_image) {
		parent::__construct();
		$this->post         = $post;
		$this->product      = $product;
		$this->postCategory = $postCategory;
		$this->postCity = $postCity;
		$this->user = $user;
		$this->post_image = $post_image;
		$this->image = App::make('ImageFactory');

		/**
		 * view share
		 */
		$cities = $this->postCity->getCities();
		$categories = $this->postCategory->getCategoriesParent();

		view()->share('cities', $cities);
		view()->share('categories', $categories);

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

	public function getDangtin(){
		$dataCate = $this->postCategory->getCategoriesParent();
		$dataCity = $this->postCity->getCities();
		return view('frontend/post/trang-dang-tin',compact('dataCate','dataCity'));
	}

	/*ajax load category city*/
	public function getLoadCate($categoryId){
		$catechild = $this->postCategory->getCatechildByCityId($categoryId);
		return response()->json($catechild);
	}

	public function postLoadCity($cityId){
		$districts = $this->postCity->getDistrictsByCityId($cityId);
		return response()->json($districts);
	}

	public function postDangtin(UserPostFormRequest $request){
		$data = $request->except(['_token','post_images']);
		$data['user_id'] = $this->user->getCurrentUser()->id;
		$data['catechild_id'] = $data['category_id'];
		if($id_post = $this->post->getIdCurrent($data)) {
			if (Input::hasFile('post_images')) {
					foreach (Input::file('post_images') as $images) {
					$data_image_post['image'] = $images->getClientOriginalName();
			 		$data_image_post['post_id'] = $id_post;

			 		$file_name = $images->getClientOriginalName();
					$path = public_path('uploads/posts/'.$file_name);
					ImageIntervention::make($images->getRealPath())->resize(760,480)->save($path);

			 		$this->post_image->create($data_image_post);
				}
			 }
			return redirect()->back()->with('success', trans('general.messages.create_success'));
		}
		return redirect()->back()->with('error', trans('general.messages.create_fail'));
	}

	public function getDanhsachtin($id){
		$city = $this->postCity->getById($id);

		$data_posts = $this->post->getCityCatePost($id);
		return view('frontend/shop/mua-ban', compact('city', 'data_posts'));
	}

	public function getDanhsachpost($id){

		$post_item = $this->post->getById($id);
		$city_id = $post_item->getCityId();
		$city = $this->postCity->getById($city_id);
		$category_id = $post_item->getCategoryId();

		$postsame = $this->post->getPostSame($city_id, $category_id);

		return view('frontend/post/danh-sach-tin', compact( 'city', 'post_item', 'postsame'));
	}

	public function getDanhsachcategory($city_id, $category_id){

		$city = $this->postCity->getById($city_id);
		$category_child_all_id = $this->postCategory->getCategoryId($category_id);
		$data_posts = $this->post->getCityCatePost($city_id, $category_child_all_id);
		$category_item = $this->postCategory->getById($category_id);
		return view('frontend/shop/mua-ban', compact('city','data_posts', 'category_item'));
	}
	public function getDanhsachcategorychild($city_id, $category_id){
		$city = $this->postCity->getById($city_id);

		$data_posts = $this->post->getCityPostCateChild($city_id, $category_id);
		$category_item = $this->postCategory->getById($category_id);
		return view('frontend/shop/mua-ban', compact('city','data_posts', 'category_item'));
	}
	public function getDanhsachCityDistrict($city_id, $district_id){
		$city = $this->postCity->getById($city_id);

		$data_posts = $this->post->getCityDistrictPost($city_id, $district_id);
		$category_item = $this->postCity->getById($district_id);
		return view('frontend/shop/mua-ban', compact('city','data_posts', 'category_item'));
	}

	public function getChitiettin($id){
		$post = $this->post->getById($id);
		$city = $this->postCity->getById($post->getCityId());
		$citydistrict = $this->postCity->getById($post->district_id);
		$category = $this->postCategory->getById($post->getCategoryId());
		$catechild = $this->postCategory->getById($post->catechild_id);
		return view('frontend.product.chi-tiet-tin', compact('post', 'city', 'citydistrict', 'category', 'catechild'));

	}
	public function postSearch(Request $request){
		$tukhoa = $request->tukhoa;
		$city_id = $request->city_id;
		$category_id = $request->category_id;
		$city = $this->postCity->getById($city_id);

		$data_posts = $this->post->getSearchPosts($tukhoa, $category_id, $city_id);
		return view('frontend/search/mua-ban-search', compact('city','data_posts'));
	}

	public function getTinCategory($id){
		$category_all_id = $this->postCategory->getCategoryId($id);
		$data = $this->post->getTinCategories($category_all_id);
		return response()->json($data);
	}

}
