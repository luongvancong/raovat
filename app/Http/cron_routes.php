<?php

Route::group(['prefix' => 'cron'], function() {

    Route::group(['prefix' => 'product'], function() {

        // Cập nhật cửa hàng bán
        Route::get('/update-total-shop', 'Crons\ProductController@updateTotalShop');

        // Cập nhật giá thấp nhất
        Route::get('/update-min-price', 'Crons\ProductController@updateMinPrice');

        // Cập nhật giá trung bình
        Route::get('/update-avg-price', 'Crons\ProductController@updateAvgPrice');

        // Cache total product by brand
        Route::get('/update-total-product-by-brand', 'Crons\ProductController@updateTotalProductByBrand');

        // Update oppponents
        Route::get('/update-opponents', 'Crons\ProductController@updateOpponents');

        // Update brand_id
        Route::get('/update-brand-id', 'Crons\ProductController@syncBrandIdProducts');

        // Update view end day
        Route::get('/update-view-count', 'Crons\ProductController@updateViewCount');
        Route::get('/patch-view-count', 'Crons\ProductController@pathViewCount');

        // Update comment fb count
        Route::get('/update-comment-count', 'Crons\ProductController@updateCommentCount');

        // Update rating count
        Route::get('/update-rating-count', 'Crons\ProductController@updateRatingCount');

        // Update click go to shop count
        Route::get('/update-click-shop-count', 'Crons\ProductController@updateClickShopCount');

        // Update hoi dap count
        Route::get('/update-question-count', 'Crons\ProductController@updateQuestionCount');

        // Update rao vat count
        Route::get('/update-raovat-count', 'Crons\ProductController@updateRaovatCount');

        // Update post count
        Route::get('/update-post-count', 'Crons\ProductController@updatePostCount');

        // Update display score
        Route::get('/update-display-score', 'Crons\ProductController@updateDisplayScore');

        // Update hot status
        Route::get('/update-hot-status', 'Crons\ProductController@updateHotStatus');

        // Update post by date
        Route::get('/update-posts-dates', 'Crons\ProductController@updatePostsDates');

        // Cập nhật type sản phẩm
        Route::get('/update-type-products', 'Crons\ProductController@updateTypeProducts');

        // Cập nhật trạng thái sản phẩm mới
        Route::get('/update-new-status', 'Crons\ProductController@updateNewStatus');

    });

    Route::group(['prefix' => 'tag'], function() {
        Route::get('update-slug', 'Crons\TagController@updateSlug');
    });


    Route::group(['prefix' => 'brand'], function() {
        Route::get('update-slug', 'Crons\BrandController@updateSlug');
    });

    // Thống kê quảng cáo
    Route::group(['prefix' => 'advertise'], function() {
        // Update advertise click
        Route::get('/update-advertise-click', 'Crons\AdvertiseController@updateStatistic');
    });

    // Kpi
    Route::group(['prefix' => 'kpi'], function() {
        Route::get('update-data', 'Crons\KpiController@getIndex');
        Route::get('patch-data', 'Crons\KpiController@patchData');

        // Patch data rao vat, hoi dap
        Route::get('patch-data-rvhd', 'Crons\KpiController@patchDataRvHd');

        // Manual update
        Route::get('manual-update-data', 'Crons\KpiController@manualUpdateData');
    });


    // Lượt click đấu giá
    Route::group(['prefix' => 'auction'], function() {
        // Update advertise click
        Route::get('/update-click', 'Crons\AuctionController@updateClick');
    });


    // Lịch sử giá
    Route::group(['prefix' => 'product-price-histories'], function() {
        // Update history
        Route::get('/', 'Crons\ProductPriceHistoryController@update');
    });


    //n-n products-prices
    Route::group(['prefix' => 'products-prices'], function() {
        Route::get('/sync', 'Crons\ProductController@syncPrice');
    });

    // n-n products-shops
    Route::group(['prefix' => 'products-shops'], function() {
        Route::get('/sync', 'Crons\ProductController@syncShop');
    });

    // n-n products-posts
    // update post count
    Route::group(['prefix' => 'products-posts'], function() {
        Route::get('/sync', 'Crons\ProductController@syncPost');
    });


    // Cache everything
    Route::group(['prefix' => 'site'], function() {
        Route::get('/statistics', 'Crons\SiteController@index');
    });

    // Thông tin gian hàng
    Route::group(['prefix' => 'merchant'], function() {
        // Cache số lượng đánh giá
        Route::get('/cache-rates', 'Crons\MerchantController@cacheRate');

        // Cache số lượng report
        Route::get('/cache-reports', 'Crons\MerchantController@cacheReport');
    });

});