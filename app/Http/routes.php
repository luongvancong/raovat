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

// Tag
Route::get('/tag/{name}', ['as' => 'tag.index', 'uses' => 'TagController@getIndex']);







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

});



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


