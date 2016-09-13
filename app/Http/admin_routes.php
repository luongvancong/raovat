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

	});
});
