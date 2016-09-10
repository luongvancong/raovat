<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

	/**
	 * Admin auth page
	 */
	Route::get('login', [
		'as' => 'admin.login',
		'uses' => 'AuthController@login'
	]);

	Route::post('login', [
		'as' => 'admin.doLogin',
		'uses' => 'AuthController@authenticate'
	]);

	Route::get('logout', [
		'as' => 'admin.logout',
		'uses' => 'AuthController@logout'
	]);

	Route::group(['middleware' => ['admin', 'acl']], function() {
		/**
		 * Dashboard
		 */
		Route::get('dashboard', [
			'as'          => 'dashboard',
			'uses'        => 'AuthController@dashboard',
			'permissions' => 'dashboard.view'
		]);

		/**
		 * Users module
		 */
		Route::group(['prefix' => 'users'], function() {
			Route::get('/', [
				'as' => 'user.index',
				'uses' => 'UserController@index',
				'permissions' => 'user.view',
			]);

			Route::get('create', [
				'as' => 'user.create',
				'uses' => 'UserController@create',
				'permissions' => 'user.create',
			]);

			Route::post('/', [
				'as' => 'user.store',
				'uses' => 'UserController@store',
				'permissions' => 'user.store',
			]);

			Route::get('{users}/edit', [
				'as' => 'user.edit',
				'uses' => 'UserController@edit',
				'permissions' => 'user.edit',
			]);

			Route::post('{user}', [
				'as' => 'user.update',
				'uses' => 'UserController@update',
				'permissions' => 'user.update',
			]);

			Route::get('{user}', [
				'as' => 'user.destroy',
				'uses' => 'UserController@destroy',
				'permissions' => 'user.destroy',
			]);
		});

		/**
		 * Roles module
		 */
		Route::group(['prefix' => 'roles'], function() {
			Route::get('/', [
				'as'          => 'role.index',
				'uses'        => 'RoleController@index',
				'permissions' => 'role.view',
			]);

			Route::get('create', [
				'as'          => 'role.create',
				'uses'        => 'RoleController@create',
				'permissions' => 'role.create',
			]);

			Route::post('/', [
				'as'          => 'role.store',
				'uses'        => 'RoleController@store',
				'permissions' => 'role.store',
			]);

			Route::get('{role}/edit', [
				'as'          => 'role.edit',
				'uses'        => 'RoleController@edit',
				'permissions' => 'role.edit',
			]);

			Route::post('{role}', [
				'as'          => 'role.update',
				'uses'        => 'RoleController@update',
				'permissions' => 'role.update',
			]);

			Route::get('{role}', [
				'as'          => 'role.destroy',
				'uses'        => 'RoleController@destroy',
				'permissions' => 'role.destroy',
			]);
		});

		/**
		 * Permissions module
		 */
		Route::group(['prefix' => 'permissions'], function() {
			Route::get('/', [
				'as'          => 'permission.index',
				'uses'        => 'PermissionController@index',
				'permissions' => 'permission.view',
			]);

			Route::get('create', [
				'as'          => 'permission.create',
				'uses'        => 'PermissionController@create',
				'permissions' => 'permission.create',
			]);

			Route::post('/', [
				'as'          => 'permission.store',
				'uses'        => 'PermissionController@store',
				'permissions' => 'permission.store',
			]);

			Route::get('{permission}/edit', [
				'as'          => 'permission.edit',
				'uses'        => 'PermissionController@edit',
				'permissions' => 'permission.edit',
			]);

			Route::post('{permission}', [
				'as'          => 'permission.update',
				'uses'        => 'PermissionController@update',
				'permissions' => 'permission.update',
			]);

			Route::get('{permission}', [
				'as'          => 'permission.destroy',
				'uses'        => 'PermissionController@destroy',
				'permissions' => 'permission.destroy',
			]);
		});

		/**
		 * Settings Moduler
		 */
		Route::group(['prefix' => 'settings'], function() {
			Route::get('website', [
				'as'          => 'website.edit',
				'uses'        => 'SettingController@edit',
				'permissions' => 'setting.view',
			]);

			Route::post('website', [
				'as'          => 'website.update',
				'uses'        => 'SettingController@update',
				'permissions' => 'setting.edit',
			]);

			Route::get('metadata', [
				'as'   => 'metadata.show',
				'uses' => 'SettingController@metadata',
				'permissions' => 'setting.view',
			]);

			Route::post('metadata', [
				'as'   => 'metadata.post.edit',
				'uses' => 'SettingController@postMetadata',
				'permissions' => 'setting.edit',
			]);

			Route::get('social', [
				'as'   => 'social.show',
				'uses' => 'SettingController@social',
				'permissions' => 'setting.view',
			]);

			Route::post('social', [
				'as'   => 'social.post.edit',
				'uses' => 'SettingController@postSocial',
				'permissions' => 'setting.edit',
			]);
		});

		/**
		 * Products Moduler
		 */

		Route::group(['prefix' => 'products'], function() {
			Route::get('/', [
				'as'          => 'admin.product.index',
				'uses'        => 'ProductController@index',
				'permissions' => 'product.view'
        	]);

        	Route::get('/create',  [
				'as'          => 'admin.product.create',
				'uses'        => 'ProductController@create',
				'permissions' => 'product.create'
			]);

			Route::post('/create', [
				'as'          => 'admin.product.store',
				'uses'        =>'ProductController@store',
				'permissions' => 'product.create'
			]);

        	Route::get('{id}/edit',  [
				'as'          => 'admin.product.edit',
				'uses'        => 'ProductController@edit',
				'permissions' => 'product.edit'
			]);

			Route::post('{id}/edit', [
				'as'          => 'admin.product.update',
				'uses'        => 'ProductController@update',
				'permissions' => 'product.edit'
			]);

			Route::get('{id}/delete', [
				'as'          => 'admin.product.destroy',
				'uses'        => 'ProductController@destroy',
				'permissions' => 'product.delete'
			]);

			// Tích chọn sp hot nhất
			Route::get('/{id}/toggleHot', ['as' => 'admin.product.hot', 'permissions' => 'product.edit' ,'uses' => 'ProductController@toggleHot']);

			// Tích chọn sp mới nhất
			Route::get('/{id}/toggleNewest', ['as' => 'admin.product.newest', 'permissions' => 'product.edit' ,'uses' => 'ProductController@toggleNewest']);

			Route::get('/{id}/toggleBanner', ['as' => 'admin.product.is_banner', 'permissions' => 'product.edit' ,'uses' => 'ProductController@toggleBanner']);

			// Editable
			Route::put('/ajax/editable', ['as' => 'admin.product.editable', 'permissions' => 'product.edit' ,'uses' => 'ProductController@ajaxEditable']);

			// Change avatar
			Route::post('/changeAvatar', ['as' => 'admin.product.changeAvatar', 'permissions' => 'product.edit' ,'uses' => 'ProductController@changeAvatar']);

			// Tags autocomplete
			Route::get('autocomplete', ['as' => 'admin.product.tagAutoComplete', 'permissions' => 'product.edit' ,'uses' => 'ProductController@autocomplete']);

			Route::get('/{productId}/tags', ['as' => 'admin.product.tag.index', 'permissions' => 'product.edit' ,'uses' => 'ProductController@tagIndex']);
			Route::get('/{productId}/tags/{tagId}/delete', ['as' => 'admin.product.tag.delete', 'permissions' => 'product.edit' ,'uses' => 'ProductController@tagDelete']);

			Route::get('/{productId}/tags/create', ['as' => 'admin.product.tag.create', 'permissions' => 'product.edit' ,'uses' => 'ProductController@tagCreate']);
			Route::post('/{productId}/tags/create', ['permissions' => 'product.edit', 'uses' => 'ProductController@tagCreateStore']);
		});

		Route::group(['prefix' => 'picture'], function() {
			Route::get('/index', ['as' => 'admin.picture.index' , 'uses' => 'PictureController@getIndex']);

			Route::get('/{id}/delete', ['as' => 'admin.picture.delete', 'uses' => 'PictureController@getDelete']);

			Route::get('/{id}/active', ['as' => 'admin.picture.active', 'uses' => 'PictureController@getActive']);
		});


		// Product videos
		Route::group(['prefix' => 'product-video'], function() {
			Route::get('/p{productId}', ['as' => 'admin.product_video.index', 'permissions' => 'video.view', 'uses' => 'ProductVideoController@getIndex']);
			Route::get('/create/p{productId}', ['as' => 'admin.product_video.create', 'permissions' => 'video.create' ,'uses' => 'ProductVideoController@getCreate']);
			Route::post('/create/p{productId}', ['permissions' => 'video.view', 'as' => 'ProductVideoController@postCreate']);
			Route::get('/{id}/delete', ['as' => 'admin.product_video.delete', 'permissions' => 'video.delete' ,'uses' => 'ProductVideoController@getDelete']);
		});

		Route::group(['prefix' => 'video'], function() {
			Route::get('/', ['as' => 'admin.video.index', 'permissions' => 'video.view', 'uses' => 'VideoController@getIndex']);
			Route::get('/create', ['as' => 'admin.video.create', 'permissions' => 'video.create' ,'uses' => 'VideoController@getCreate']);
			Route::post('/create', ['permissions' => 'video.view', 'uses' => 'VideoController@postCreate']);
			Route::get('/{id}/delete', ['permissions' => 'video.delete', 'as' => 'admin.video.delete' ,'uses' => 'VideoController@getDelete']);

			Route::get('find-from-youtube', ['as' => 'admin.video.findFromYoutube', 'permissions' => 'video.edit' ,'uses' => 'VideoController@getFindFormYoutube']);
			Route::post('find-from-youtube', ['permissions' => 'video.edit', 'uses'=> 'VideoController@findFromYoutube']);

			Route::get('/{videoId}/tag', ['as' => 'admin.video.tag.index', 'permissions' => 'video.edit' ,'uses' => 'VideoController@tagIndex']);

			Route::get('/{videoId}/tag/create', ['as' => 'admin.video.tag.create', 'permissions' => 'video.edit' ,'uses' => 'VideoController@tagCreate']);
			Route::post('/{videoId}/tag/create', ['permissions' => 'video.edit', 'uses' => 'VideoController@tagCreateStore']);

			Route::get('/{videoId}/tag/{tagId}/delete', ['as' => 'admin.video.tag.delete', 'permissions' => 'video.edit' ,'uses' => 'VideoController@tagDelete']);
		});


		// Brands
		Route::group(['prefix' => 'brand'], function() {
			Route::get('/index', ['as' => 'admin.brand.index', 'permissions' => 'brand.view' ,'uses' => 'BrandController@getIndex']);
			Route::get('/create', ['as' => 'admin.brand.create', 'permissions' => 'brand.create' ,'uses' => 'BrandController@getCreate']);
			Route::post('/create', ['permissions' => 'brand.create', 'uses' => 'BrandController@postCreate']);

			Route::get('/{brandId}/edit', ['as' => 'admin.brand.edit', 'permissions' => 'brand.edit' ,'uses' => 'BrandController@getEdit']);
			Route::post('/{brandId}/edit', ['permissions' => 'brand.edit', 'uses' => 'BrandController@postEdit']);

			Route::get('/{brandId}/delete', ['as' => 'admin.brand.delete', 'permissions' => 'brand.delete' ,'uses' => 'BrandController@getDelete']);

			// Quick edit
			Route::put('/{brandId}/quickedit', ['as' => 'admin.brand.quickedit', 'permissions' => 'brand.delete', 'uses' => 'BrandController@quickEdit']);
		});


		// Posts
		Route::group(['prefix' => 'post'], function() {
			Route::get('/index', ['as' => 'admin.post.index', 'permissions' => 'post.view' ,'uses' => 'PostController@getIndex']);

			Route::get('/{postId}/edit', ['as' => 'admin.post.edit', 'permissions' => 'post.view' ,'uses' => 'PostController@getEdit']);
			Route::post('/{postId}/edit', ['permissions' => 'post.edit', 'uses' => 'PostController@postEdit']);

			Route::get('/{postId}/delete', ['as' => 'admin.post.delete', 'permissions' => 'post.delete' ,'uses' => 'PostController@getDelete']);

			Route::get('/{postId}/tag', ['as' => 'admin.post.tag.index', 'permissions' => 'post.edit' ,'uses' => 'PostController@tagIndex']);

			Route::get('/{postId}/tag/create', ['as' => 'admin.post.tag.create', 'permissions' => 'post.edit' ,'uses' => 'PostController@tagCreate']);
			Route::post('/{postId}/tag/create', ['permissions' => 'post.edit', 'uses' => 'PostController@tagCreateStore']);

			Route::get('/{postId}/tag/{tagId}/delete', ['as' => 'admin.post.tag.delete', 'permissions' => 'post.edit' ,'uses' => 'PostController@tagDelete']);

			Route::get('{id}/active', [
				'as'          => 'admin.post.active',
				'uses'        => 'PostController@active',
				'permissions' => 'post.edit'
			]);
		});

		// Post Categories
		Route::group(['prefix' => 'post-category'], function() {
			Route::get('/index', ['as' => 'admin.post_category.index', 'permissions' => 'post_category.view' ,'uses' => 'PostCategoryController@getIndex']);
			Route::get('/create', ['as' => 'admin.post_category.create', 'permissions' => 'post_category.view' ,'uses' => 'PostCategoryController@getCreate']);
			Route::post('/create', ['permissions' => 'post_category.create', 'uses' => 'PostCategoryController@postCreate']);

			Route::get('/{id}/edit', ['as' => 'admin.post_category.edit', 'permissions' => 'post_category.view' ,'uses' => 'PostCategoryController@getEdit']);
			Route::post('/{id}/edit', ['permissions' => 'post_category.edit', 'uses' => 'PostCategoryController@postEdit']);

			Route::get('/{id}/delete', ['as' => 'admin.post_category.delete', 'permissions' => 'post_category.delete' ,'uses' => 'PostCategoryController@getDelete']);
		});

		//Cities
		Route::group(['prefix' => 'cities'],function(){
			Route::get('/index',['as' => 'admin.city.index', 'permissions' => 'city.view', 'uses' => 'CitiesController@getIndex']);
			Route::get('/create', ['as' => 'admin.city.create', 'permissions' => 'city.view' ,'uses' => 'CitiesController@getCreate']);
			Route::post('/create', ['permissions' => 'city.create', 'uses' => 'CitiesController@postCreate']);

			Route::get('/{id}/edit', ['as' => 'admin.city.edit', 'permissions' => 'city.view' ,'uses' => 'CitiesController@getEdit']);
			Route::post('/{id}/edit', ['permissions' => 'city.edit', 'uses' => 'CitiesController@postEdit']);

			Route::get('/{id}/delete', ['as' => 'admin.city.delete', 'permissions' => 'city.delete' ,'uses' => 'CitiesController@getDelete']);
		});

		// Banners
		Route::group(['prefix' => 'banners'], function() {

			Route::get('/', [
				'as'          => 'admin.banner.index',
				'uses'        => 'BannerController@index',
				'permissions' => 'banner.view'
			]);

			Route::get('/create',  [
				'as'          => 'admin.banner.create',
				'uses'        => 'BannerController@create',
				'permissions' => 'banner.create'
			]);

			Route::post('/create', [
				'as'          => 'admin.banner.store',
				'uses'        =>'BannerController@store',
				'permissions' => 'banner.create'
			]);

			Route::get('{id}/edit',  [
				'as'          => 'admin.banner.edit',
				'uses'        => 'BannerController@edit',
				'permissions' => 'banner.edit'
			]);

			Route::post('{id}/edit', [
				'as'          => 'admin.banner.update',
				'uses'        =>'BannerController@update',
				'permissions' => 'banner.edit'
			]);

			Route::get('{id}/active', [
				'as'          => 'admin.banner.active',
				'uses'        => 'BannerController@active',
				'permissions' => 'banner.edit'
			]);

			Route::get('{id}/delete', [
				'as'          => 'admin.banner.destroy',
				'uses'        => 'BannerController@destroy',
				'permissions' => 'banner.destroy'
			]);
		});

		// Event groups
		Route::group(['prefix' => 'event-groups'], function() {
			Route::get('/index', ['as' => 'admin.event_group.index', 'uses' => 'EventGroupController@getIndex']);
			Route::get('/create', ['as' => 'admin.event_group.create', 'uses' => 'EventGroupController@getCreate']);
			Route::post('/create', 'EventGroupController@postCreate');
			Route::get('/{id}/edit', ['as' => 'admin.event_group.edit', 'uses' => 'EventGroupController@getEdit']);
			Route::post('/{id}/edit', 'EventGroupController@postEdit');
			Route::get('/{id}/delete', ['as' => 'admin.event_group.delete', 'uses' => 'EventGroupController@getDelete']);
		});

		// Events
		Route::group(['prefix' => 'event'], function() {
			Route::get('/index', ['as' => 'admin.event.index', 'uses' => 'EventController@getIndex']);
			Route::get('/detail-key/{key}', ['as' => 'admin.event.detail_key', 'uses' => 'EventController@getDetailKey']);
		});

		// Sites
		Route::group(['prefix' => 'site'], function() {
			Route::get('/index', ['as' => 'admin.site.index', 'permissions' => 'site.view' ,'uses' => 'SiteController@getIndex']);
			Route::get('/create', ['as' => 'admin.site.create', 'permissions' => 'site.create' ,'uses' => 'SiteController@getCreate']);
			Route::post('/create', ['permissions' => 'site.create', 'uses' => 'SiteController@postCreate']);
			Route::post('/importXpath', ['as' => 'admin.site.import' ,'uses' => 'SiteController@postImportXpath']);
			Route::get('/{id}/edit', ['as' => 'admin.site.edit', 'permissions' => 'site.edit' ,'uses' => 'SiteController@getEdit']);
			Route::post('/{id}/edit', ['permissions' => 'site.edit', 'uses' => 'SiteController@postEdit']);
			Route::get('/{id}/delete', ['as' => 'admin.site.delete', 'permissions' => 'site.delete' ,'uses' => 'SiteController@getDelete']);

			Route::get('/{id}/hot', ['as' => 'admin.site.hot', 'uses' => 'SiteController@getHot']);

			Route::get('/get-rank', ['as' => 'admin.site.getRankAlexa', 'uses' => 'SiteController@getRank']);

			Route::get('/sync', ['as' => 'admin.site.sync', 'uses' => 'SiteController@getSync']);

			// Xpath listing
			Route::get('/{siteId}/xpath/index', ['as' => 'admin.site.xpath', 'uses' => 'SiteController@getXpath']);

			// Tạo xpath
			Route::get('/{siteId}/xpath/create', ['as' => 'admin.site.xpath.create', 'uses' => 'SiteController@getCreateXpath']);
			Route::post('/{siteId}/xpath/create', 'SiteController@postXpath');

			// Edit xpath
			Route::get('/xpath/{xpathId}', ['as' => 'admin.site.xpath.edit', 'uses' => 'SiteController@getEditXpath']);
			Route::post('/xpath/{xpathId}', 'SiteController@postEditXpath');

			// Delete xpath
			Route::get('xpath/{xpathId}/delete', ['as' => 'admin.site.xpath.delete', 'uses' => 'SiteController@getDeleteXpath']);

			// Link listing
			Route::get('/{siteId}/links/index', ['as' => 'admin.site.links.index', 'uses' => 'SiteController@getLinksIndex']);

			// Thêm link
			Route::get('/{siteId}/links/add', ['as' => 'admin.site.links.create', 'uses' => 'SiteController@getLinks']);
			Route::post('/{siteId}/links/add', 'SiteController@postLinks');
			Route::post('/{siteId}/links/import', ['as' => 'admin.links.import' ,'uses' => 'SiteController@postImportLink']);

			// Chi tiet link & Cập nhật link & Quick edit
			Route::get('/{siteId}/links/{linkId}', ['as' => 'admin.site.links.edit', 'uses' => 'SiteController@getEditLink']);
			Route::post('/{siteId}/links/{linkId}', 'SiteController@postEditLink');
			Route::put('links/quick-edit', ['as' => 'admin.link.quickedit', 'uses' => 'SiteController@putQuickEditLink']);

			// Thời gian Cronjob
			Route::get('{siteId}/cronjob', ['as' => 'admin.site.cronjob', 'uses' => 'SiteController@getSiteCronjob']);
			Route::post('{siteId}/cronjob', 'SiteController@postSiteCronjob');

			// Env testing xpath
			Route::get('/{siteId}/toggleEnvTesting', [
			    'permissions' => 'site.edit',
			    'as' => 'admin.site.toggleEnvTesting',
			    'uses' => 'SiteController@toggleEnvTesting'
			]);

			// Xoa link
			Route::get('/{siteId}/links/{linkId}/delete', ['as' => 'admin.site.links.delete', 'uses' => 'SiteController@getDeleteLink']);

			// Update total links
			Route::get('/update-total-links', ['as' => 'admin.site.updateTotalLinks', 'uses' => 'SiteController@updateTotalLinks']);

			// Env quick run
			Route::get('/{siteId}/toggleEnvQuick', [
			    'permissions' => 'site.edit',
			    'as' => 'admin.site.toggleEnvQuick',
			    'uses' => 'SiteController@toggleEnvQuick'
			]);

			// Allow crawl
			Route::get('/{siteId}/toggleAllowCrawl', [
			    'permissions' => 'site.edit',
			    'as' => 'admin.site.toggleAllowCrawl',
			    'uses' => 'SiteController@toggleAllowCrawl'
			]);

			// Tạo chi nhánh
			Route::get('/{siteId}/branch/create', ['as' => 'admin.site.branch.create', 'uses' => 'SiteController@getBranchCreate']);
			Route::post('/{siteId}/branch/create', 'SiteController@postBranchCreate');

		});


		// Tags
		Route::group(['prefix' => 'tag'], function() {
			Route::get('/index', ['as' => 'admin.tag.index', 'permissions' => 'tag.view' ,'uses' => 'TagController@index']);
			Route::get('/create', ['as' => 'admin.tag.create', 'permissions' => 'tag.create' ,'uses' => 'TagController@create']);
			Route::post('/create', ['permissions' => 'tag.create', 'uses' => 'TagController@store']);
			Route::get('/{id}/edit', ['as' => 'admin.tag.edit', 'permissions' => 'tag.edit' ,'uses' => 'TagController@edit']);
			Route::post('/{id}/edit', ['permissions' => 'tag.edit', 'uses' => 'TagController@update']);
			Route::get('/{id}/delete', ['as' => 'admin.tag.delete', 'permissions' => 'tag.delete' ,'uses' => 'TagController@destroy']);

			Route::get('/ajaxSearchTag', ['as' => 'admin.tag.ajax.search', 'permissions' => 'tag.edit' ,'uses' => 'TagController@ajaxTag']);
		});


		// WrongPrices
		Route::group(['prefix' => 'wrong-prices'], function() {
			Route::get('/index', ['as' => 'admin.wrongPrice.index', 'permissions' => 'wrong_price.view' ,'uses' => 'WrongPriceController@getIndex']);
			Route::get('/{id}/{reportId}/edit', ['as' => 'admin.wrongPrice.edit', 'permissions' => 'wrong_price.edit' ,'uses' => 'WrongPriceController@getEdit']);
			Route::post('/{id}/{reportId}/edit', ['permissions' => 'wrong_price.edit', 'uses' => 'WrongPriceController@postEdit']);

			Route::get('/{id}/{reportId}/delete', ['as' => 'admin.wrongPrice.delete', 'uses' => 'WrongPriceController@getDelete']);
		});


		// Ratings
		Route::group(['prefix' => 'rate'], function() {
			Route::get('/index', ['as' => 'admin.rate.index', 'permissions' => 'rate.view', 'uses' => 'RateController@getIndex']);
		});


		// Cronjob
		Route::group(['prefix' => 'cronjob'], function() {
			Route::get('/index', ['as' => 'admin.cronjob.index', 'permissions' => 'cronjob.view' ,'uses' => 'CronjobController@getIndex']);
			Route::get('/get-cron-by-day/{dayOfWeek}', ['as' => 'admin.cronjob.getByDay', 'permissions' => 'cronjob.view', 'uses' => 'CronjobController@getByDay']);
			Route::post('/ajax/change-day', ['as' => 'admin.cronjob.ajaxChangeDay', 'permissions' => 'cronjob.edit', 'uses' => 'CronjobController@ajaxChangeDay']);
		});

		// KPI
		Route::group(['prefix' => 'kpi'], function() {
			Route::get('/index', ['as' => 'admin.kpi.index', 'uses' => 'KpiController@getIndex']);
			Route::get('/create', ['as' => 'admin.kpi.create', 'uses' => 'KpiController@getCreate']);
			Route::post('/create', ['as' => 'admin.kpi.create', 'uses' => 'KpiController@postCreate']);
		});


		// Product rules
		Route::group(['prefix' => 'product-rules'], function() {
			Route::get('/', ['as' => 'admin.productRule.index', 'uses' => 'ProductRuleController@index']);
		});


		// ProductXpath
		Route::group(['prefix' => 'product-xpaths'], function() {
			Route::get('/', ['as' => 'admin.productXpath.index', 'uses' => 'ProductXpathController@index']);
			// Create
			Route::get('/create', ['as' => 'admin.productXpath.create', 'uses' => 'ProductXpathController@create']);
			Route::post('/create', 'ProductXpathController@store');

			// Create via ajax
			Route::post('/createViaAjax', ['as' => 'admin.productXpath.createViaAjax', 'uses' => 'ProductXpathController@createViaAjax']);

			// Edit
			Route::get('/{id}/edit', ['as' => 'admin.productXpath.edit', 'uses' => 'ProductXpathController@show']);
			Route::post('/{id}/edit', 'ProductXpathController@update');

			// Delete
			Route::get('/{id}/delete', ['as' => 'admin.productXpath.delete', 'uses' => 'ProductXpathController@destroy']);
		});


		// ProductLink
		Route::group(['prefix' => 'product-links'], function() {
			Route::get('/', ['as' => 'admin.productLink.index', 'uses' => 'ProductLinkController@index']);
			// Create
			Route::get('/create', ['as' => 'admin.productLink.create', 'uses' => 'ProductLinkController@create']);
			Route::post('/create', 'ProductLinkController@store');

			// Edit
			Route::get('/{id}/edit', ['as' => 'admin.productLink.edit', 'uses' => 'ProductLinkController@show']);
			Route::post('/{id}/edit', 'ProductLinkController@update');

			// Delete
			Route::get("/{id}/delete", ['as' => 'admin.productLink.delete', 'uses' => 'ProductLinkController@destroy']);
		});

		// Adv
		Route::group(['prefix' => 'advertise'], function() {
			Route::get('/register', ['as' => 'admin.advertise.register', 'uses' => 'AdvertiseController@getRegister']);
			Route::get('/register/{id}/delete', ['as' => 'admin.advertise.register.delete', 'uses' => 'AdvertiseController@getRegisterDelete']);
			Route::get('/index', ['as' => 'admin.advertise.index', 'uses' => 'AdvertiseController@getIndex']);
			Route::get('/create', ['as' => 'admin.advertise.create', 'uses' => 'AdvertiseController@getCreate']);
			Route::post('/create', 'AdvertiseController@postCreate');
			Route::get('/{id}/active', ['as' => 'admin.advertise.active', 'uses' => 'AdvertiseController@getActive']);
			Route::get('/{id}/edit', ['as' => 'admin.advertise.edit', 'uses' => 'AdvertiseController@getEdit']);
			Route::post('/{id}/edit', 'AdvertiseController@postEdit');
			Route::get('/{id}/delete', ['as' => 'admin.advertise.delete', 'uses' => 'AdvertiseController@getDelete']);
			Route::get('/{id}/statistic', ['as' => 'admin.advertise.statistic', 'uses' => 'AdvertiseController@getStatistic']);
			Route::get('/{id}/update-statistic', ['as' => 'admin.advertise.statistic.update', 'uses' => 'AdvertiseController@getStatisticUpdate']);
		});


		Route::group(['prefix' => 'charge-money'], function() {
			Route::get('/', ['as' => 'admin.chargeMoney', 'uses' => 'ChargeMoneyController@index']);
			Route::post('/', 'ChargeMoneyController@store');
		});

	});
});
