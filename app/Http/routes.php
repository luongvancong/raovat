<?php


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

require_once app_path() . '/Http/admin_routes.php';

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home-page', 'uses' => "HomeController@index"]);

Route::get('/search', [
	'as'   => 'searchon',
	'uses' => 'SearchController@index'
]);


// Product detail
Route::get('/san-pham/{id}-{slug}', ['as' => 'product.detail', 'uses' => 'ProductController@getDetail']);
Route::get('/lich-su-gia/san-pham/{id}-{slug}', ['as' => 'product.price_histories', 'uses' => 'ProductController@getPriceHistories']);
Route::get('/upload-anh-san-pham-{id}-{slug}', ['as' => 'product.detail.uploadPhoto', 'uses' => 'ProductController@getUploadPhoto']);
Route::post('/upload-anh-san-pham-{id}-{slug}', 'ProductController@postUploadPhoto');

// Post detail
Route::get('/tin-tuc.html', ['as' => 'post.index', 'uses' => 'PostController@getIndex']);
Route::get('/tin-tuc/{catId}-{catSlug}.html', ['as' => 'post.category', 'uses' => 'PostController@getPostCategory']);
Route::get('/tin-tuc/{catId}-{catSlug}/{id}-{slug}', ['as' => 'post.detail', 'uses' => 'PostController@getDetail']);

// Post amp version
// Route::get('/amp/post/{id}', ['as' => 'post.amp', 'uses' => 'PostController@getPostDetailAmp']);

// Post category

// Video detail
Route::get('/video.html', ['as' => 'video.index', 'uses' => 'VideoController@getIndex']);
Route::get('/video/{id}-{slug}', ['as' => 'video.detail', 'uses' => 'VideoController@getDetail']);

// Raovat
Route::get('/rao-vat.html', ['as' => 'raovat.index', 'uses' => 'RaovatController@getIndex']);
Route::get('/rao-vat/tim-kiem/{keyword}.html', ['as' => 'raovat.search', 'uses' => 'RaovatController@search']);
Route::get('/rao-vat/{id}', ['as' => 'raovat.detail', 'uses' => 'RaovatController@getDetail']);

// Hỏi đáp
Route::get('/hoi-dap.html', ['as' => 'hoidap.index', 'uses' => 'HoiDapController@getIndex']);
Route::get('/hoi-dap/tim-kiem/{keyword}.html', ['as' => 'hoidap.search', 'uses' => 'HoiDapController@search']);
Route::get('/hoi-dap/{id}', ['as' => 'hoidap.detail', 'uses' => 'HoiDapController@getDetail']);

// Cửa hàng bán
Route::get('/shop.html', ['as' => 'shop.index', 'uses' => 'ShopController@index']);
Route::get('/shop/{id}', ['as' => 'shop.detail', 'uses' => 'ShopController@show']);

Route::get('/hang-san-xuat/{brandName}', ['as' => 'product.brand', 'uses' => 'BrandController@getProducts']);

// So sánh giá
Route::get('/so-sanh', ['as' => 'compare', 'uses' => 'CompareController@getIndex']);
Route::get('/so-sanh/them-san-pham/{id}', ['as' => 'compare.addProduct', 'uses' => 'CompareController@addProduct']);
Route::get('so-sanh/xoa-sach', ['as' => 'compare.clear', 'uses' => 'CompareController@clear']);
Route::get('/so-sanh/{productId}/{opponentId}', ['as' => 'product.vs.opponent', 'uses' => 'CompareController@getProductVsOpponent']);

// Sản phẩm mới
Route::get('/san-pham-moi', ['as' => 'product.newest', 'uses' => 'ProductController@getNewest']);

// Sản phẩm hot
Route::get('/san-pham-hot', ['as' => 'product.hot', 'uses' => 'ProductController@getHot']);

// Sản phẩm giá rẻ
Route::get('/san-pham-gia-re', ['as' => 'product.cheap', 'uses' => 'ProductController@getCheap']);

// Chuyển tới nơi báns
Route::get('/redirect/product/{id}/{priceId}', ['as' => 'redirect', 'uses' => 'RedirectController@getIndex']);

// Tag
Route::get('/tag/{name}', ['as' => 'tag.index', 'uses' => 'TagController@getIndex']);

// Tag from product detail
Route::get('/tag/s/{tag}/', ['as' => 'stag.index', 'uses' => 'STagController@index']);

// Điện thoại
Route::group(['prefix' => '/dien-thoai'], function() {

	$type = 'dien-thoai';

	Route::get('/', ['as' => 'phone.index', 'uses' => function() use ($type) {
		return App::make('Nht\Http\Controllers\ProductController')->getByType($type);
	}]);

	Route::get('/hang-san-xuat/{brandSlug}', ['as' => 'phone.brand.index', 'uses' => function($brandSlug) use ($type) {
		return App::make('Nht\Http\Controllers\ProductController')->getByType($type, $brandSlug);
	}]);

});

// Laptop
Route::group(['prefix' => '/laptop'], function() {

	$type = 'laptop';

	Route::get('/', ['as' => 'laptop.index', 'uses' => function() use ($type) {
		return App::make('Nht\Http\Controllers\ProductController')->getByType($type);
	}]);

	Route::get('/hang-san-xuat/{brandSlug}', ['as' => 'laptop.brand.index', 'uses' => function($brandSlug) use ($type) {
		return App::make('Nht\Http\Controllers\ProductController')->getByType($type, $brandSlug);
	}]);
});

// Tablet
Route::group(['prefix' => '/may-tinh-bang'], function() {

	$type = 'may-tinh-bang';

	Route::get('/', ['as' => 'tablet.index', 'uses' => function() use($type) {
		return App::make('Nht\Http\Controllers\ProductController')->getByType($type);
	}]);

	Route::get('/hang-san-xuat/{brandSlug}', ['as' => 'tablet.brand.index', 'uses' => function($brandSlug) use($type) {
		return App::make('Nht\Http\Controllers\ProductController')->getByType($type, $brandSlug);
	}]);
});

// Máy ảnh
Route::group(['prefix' => '/may-anh'], function() {

	$type = 'may-anh';

	Route::get('/', ['as' => 'camera.index', 'uses' => function() use($type) {
		return App::make('Nht\Http\Controllers\ProductController')->getByType($type);
	}]);

	Route::get('/hang-san-xuat/{brandSlug}', ['as' => 'camera.brand.index', 'uses' => function($brandSlug) use($type) {
		return App::make('Nht\Http\Controllers\ProductController')->getByType($type, $brandSlug);
	}]);
});

// Sitemap
Route::get('/sitemap.xml', ['as' => 'sitemap.index', 'uses' => 'SiteMapController@getIndex']);

Route::group(['prefix' => 'sitemap'], function() {
	Route::get('/brands.xml', ['as' => 'sitemap.brand.index', 'uses' => 'SiteMapController@getBrands']);

	Route::get('/posts.xml', ['as' => 'sitemap.post.index', 'uses' => 'SiteMapController@getPosts']);
	Route::get('/posts-page-{page}.xml', ['as' => 'sitemap.post-page.index', 'uses' => 'SiteMapController@getPostPage']);

	Route::get('/post-categories.xml', ['as' => 'sitemap.post_category.index', 'uses' => 'SiteMapController@getPostCategory']);

	Route::get('/products.xml', ['as' => 'sitemap.product.index', 'uses' => 'SiteMapController@getProducts']);

	Route::get('/videos.xml', ['as' => 'sitemap.video.index', 'uses' => 'SiteMapController@videoIndex']);
	Route::get('/videos-page-{page}.xml', ['as' => 'sitemap.video.page', 'uses' => 'SiteMapController@videoPage']);

	// Rao vặt
	Route::get('/classifield.xml', ['as' => 'sitemap.classifield.index', 'uses' => 'SiteMapController@classifieldIndex']);
	Route::get('/classifield-page-{page}.xml', ['as' => 'sitemap.classifield.page', 'uses' => 'SiteMapController@classifieldPage']);

	// Hỏi đáp
	Route::get('/qa.xml', ['as' => 'sitemap.qa.index', 'uses' => 'SiteMapController@qaIndex']);
	Route::get('/qa-page-{page}.xml', ['as' => 'sitemap.qa.page', 'uses' => 'SiteMapController@qaPage']);
});

Route::get('website-register', ['as' => 'website-register', 'uses' => 'WebsiteRegisterController@getIndex']);
Route::post('website-register', 'WebsiteRegisterController@postCreate');


// Authentication
Route::get('auth/login', ['as' => 'auth.login_form', 'uses' => 'Auth\AuthController@getLoginForm']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

// Profile
Route::get('profile', ['as' => 'profile.chinhsua', 'middleware' => 'check_logged', 'uses' => 'ProfileController@getIndex']);
Route::post('profile', 'ProfileController@postIndex');
Route::post('profile/change-avatar', ['as' => 'profile.avatar', 'uses' => 'ProfileController@changeAvatar']);

Route::get('profile/doi-mat-khau',['as' => 'profile.password', 'middleware' => 'check_logged', 'uses' => 'ProfileController@changePassword']);
Route::post('profile/doi-mat-khau',['as' => 'profile.post.password', 'uses' => 'ProfileController@postChangePassword']);
// Route::get('/profile/{userId}-{slug}', ['as' => 'profile.index', 'before' => 'check_logged' ,'uses' => 'ProfileController@getIndex']);

// socical: google,facebook or github
Route::get('auth/{social}', ['as' => 'auth.socialite', 'uses' => 'Auth\AuthController@redirectToProvider']);
Route::get('auth/{social}/callback', ['as' => 'auth.socialite.callback', 'uses' => 'Auth\AuthController@handleProviderCallback']);



// Ajax
require_once app_path() . '/Http/ajax_routes.php';

// Cron routes
require_once app_path() . '/Http/cron_routes.php';


Route::group(['prefix' => 'api'], function() {
	Route::group(['prefix' => 'product'], function() {
		Route::post('{productId}/like', 'Api\ProductController@addLike');
	});
});

// Google analytics api data
Route::get('/ga/analyze', ['as' => 'ga.analyze', 'uses' => 'GaController@analyze']);


// Account
require_once app_path() . '/Http/account_routes.php';

Route::get('/test', 'TestController@getIndex');




/*Route chotot*/
Route::get('dang-nhap',['as'=>'dangnhap','uses'=>'Auth\AuthController@getLoginForm']);
Route::post('dang-nhap',['as'=>'post.dangnhap','uses' => 'Auth\AuthController@postLoginForm']);
Route::get('log-out',['as'=>'get.logout','uses' => 'Auth\AuthController@getLogout']);

Route::get('dang-ky',['as' => 'dangky', 'uses' => 'Auth\AuthController@getDangky']);
Route::post('dang-ky',['as'=>'post.dangky','uses' => 'Auth\AuthController@postDangkyForm']);

Route::get('dang-tin',['as'=>'get.dangtin', 'middleware' => 'check_logged', 'uses' => 'PostController@getDangtin']);
Route::post('dang-tin',['as'=>'post.dangtin', 'uses' => 'PostController@postDangtin']);

/*
load ajax
 */
Route::get('dang-tin/ajax-get-catechild/{cate_id}', ['as' => 'get.loadcate', 'uses' => 'PostController@getLoadCate']);
Route::get('dang-tin/ajax-get-districts/{cityId}', ['as' => 'post.loadcity', 'uses' => 'PostController@postLoadCity']);

Route::get('danh-sach-tin/{id}', ['as' => 'getDanhsachtin', 'uses' => 'PostController@getDanhsachtin']);
Route::get('danh-sach-post/{id}',['as' => 'getDanhsachpost', 'uses' => 'PostController@getDanhsachpost']);
Route::get('danh-sach-category/{city_id}/{category_id}', ['as' => 'getDanhsachcategory', 'uses' => 'PostController@getDanhsachcategory']);
Route::get('danh-sach-category-child/{city_id}/{category_id}', ['as' => 'getDanhsachcategorychild', 'uses' => 'PostController@getDanhsachcategorychild']);
Route::get('danh-sach-city-district/{city_id}/{district_id}', ['as' => 'getDanhsachCityDistrict', 'uses' => 'PostController@getDanhsachCityDistrict']);

Route::get('chi-tiet-tin/{id}', ['as' => 'getChitiettin', 'uses' => 'PostController@getChitiettin']);

/*search*/
Route::get('search-post', ['as' => 'postSearch', 'uses' => 'PostController@postSearch']);

Route::get('tin-theo-category/{id}', ['as' => 'getTinCategory', 'uses' => 'PostController@getTinCategory']);