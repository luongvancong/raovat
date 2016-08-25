<?php

Route::group(['prefix' => 'ajax'], function() {
    Route::post('/eventTracking', 'EventController@listener');
    Route::get('/getPricesTable', 'ProductController@ajaxGetPricesTable');

    // Lấy ảnh đại diện của post
    Route::get('/post/getImage', 'PostController@ajaxGetImagePost');

    // Suggest keyword
    Route::get('/products.json', 'SearchController@ajaxPrefecthProducts');
    Route::get('/search-products.json/{name}', 'SearchController@ajaxRemoteProducts');

    // Cities & Districts
    Route::get('/cities', ['as' => 'ajax.cities', 'uses' => 'AjaxController@getCities']);
    Route::get('/getDistricts', ['as' => 'ajax.districts', 'uses' => 'AjaxController@getDistricts']);

    // Load viewmore price items
    Route::get('/loadPricesViewMore', ['as' => 'ajax.loadPricesViewMore', 'uses' => 'ProductController@ajaxLoadPricesViewMore']);

    Route::post('/wrong-prices', ['as' => 'ajax.wrongPrices', 'uses' => 'WrongPriceController@wrongPrice']);
    Route::post('/report/fail-link', ['as' => 'ajax.failLink', 'uses' => 'WrongPriceController@failLink']);

    // Get min price product
    // params: product_id int
    Route::get('/getMinPrice', ['as' => 'ajax.getMinPrice', 'uses' => 'ProductController@ajaxGetMinPrice']);

    // Get total shop
    Route::get('/getTotalShop', ['as' => 'ajax.getTotalShop', 'uses' => 'ProductController@ajaxGetTotalShop']);


    // View more question
    Route::get('/viewmoreQuestion', ['as' => 'ajax.viewmoreQuestion', 'uses' => 'ProductController@ajaxViewmoreQuestion']);


    // Action rating
    Route::post('/rating', ['as' => 'ajax.action.rating', 'uses' => 'ProductController@ajaxRating']);

    // Get brands
    Route::get('/find-brands', ['as' => 'ajax.find.brand', 'uses' => 'ProductController@ajaxFindBrands']);

    // Advertise count click
    Route::post('/ads-click', ['as' => 'ajax.advertise.click', 'uses' => 'AdvertiseController@ajaxClick']);

    // Shop ads click
    Route::post('/shop-ads-click', ['as' => 'ajax.shopAds.click', 'uses' => 'ProductController@ajaxShopAdsClick']);

    // Lấy bảng giá các shop lần đầu tiên
    // Chi tiết sản phẩm
    Route::group(['prefix' => 'product'], function() {
        // Load thêm danh sách cửa hàng so sánh giá
        Route::get('/load-price-table', ['as' => 'ajax.product.loadPriceTable', 'uses' => 'ProductController@ajaxLoadPriceTable']);

        // User đánh giá gian hàng trên từng sản phẩm
        Route::post('/user-rating-merchant', ['as' => 'ajax.product.user_rating_merchant', 'middleware' => 'ajax.checkLogin','uses' => 'ProductController@ajaxUserRatingMerchant']);

        // User báo sai giá, sai thông tin, link hỏng...
        Route::post('/user-report-merchant', ['as' => 'ajax.product.user_report_merchant', 'middleware' => 'ajax.checkLogin', 'uses' => 'ProductController@ajaxUserReportMerchant']);
    });


});