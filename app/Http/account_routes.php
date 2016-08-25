<?php

Route::group(['prefix' => 'account', 'namespace' => 'Account' ,'middleware' => 'check_logged'], function() {
    Route::group(['prefix' => 'settings'], function() {
        Route::get('/', ['as' => 'account.settings', 'uses' => 'AccountController@index']);

        // Ads
        Route::group(['prefix' => 'ads'], function() {
            Route::get('/', ['as' => 'account.ads', 'uses' => 'AdsController@index']);

            // Create
            Route::get('/dang-ky-quang-cao', ['as' => 'advertise.register', 'uses' => 'AdsController@getRegister']);
            Route::post('/dang-ky-quang-cao', ['as' => 'advertise.register', 'uses' => 'AdsController@postRegister']);

            Route::get('/{id}/statistic', ['as' => 'account.ads.statistic', 'uses' => 'AdsController@statistic']);
        });

        // Auction
        Route::group(['prefix' => 'auction'], function() {
            Route::get('/', ['as' => 'account.auction', 'uses' => 'AuctionController@index']);

            Route::get('/create', ['as' => 'account.auction.create', 'uses' => 'AuctionController@create']);
            Route::post('/create', 'AuctionController@store');

            Route::get('/{id}/edit', ['as' => 'account.auction.edit', 'uses' => 'AuctionController@show']);
            Route::post('/{id}/edit', 'AuctionController@update');

            Route::get('/{id}/delete', ['as' => 'account.auction.destroy', 'middleware' => 'auction_owner' ,'uses' => 'AuctionController@destroy']);

            Route::post('/max-money-per-click', ['as' => 'account.auction.getMaxMoneyPerClickToProduct', 'uses' => 'AuctionController@getMaxMoneyPerClickToProduct']);

            Route::get('/{id}/statistic', ['as' => 'account.auction.statistic', 'uses' => 'AuctionController@statistic']);

            // Loại bỏ sản phẩm khỏi danh sách đấu giá
            Route::get('/{id}/ignore-products', ['as' => 'account.auction.ignoreProducts', 'uses' => 'AuctionController@ignoreProducts']);
            Route::post('/{id}/ignore-products', 'AuctionController@updateIgnoreProduct');
        });


        // Link to shop
        Route::get('/link-to-shop', ['as' => 'account.linkToShop', 'uses' => 'LinkController@linkToShop']);
        Route::post('/link-to-shop', 'LinkController@updateLinkToShop');

        // Profile
        Route::get('/profile', ['as' => 'account.profile', 'uses' => 'ProfileController@index']);
        Route::post('profile', 'ProfileController@update');
        Route::post('profile/change-avatar', ['as' => 'profile.change_avatar', 'uses' => 'ProfileController@changeAvatar']);

        // Nạp tiền
        Route::get('/huong-dan-nap-tien', ['as' => 'account.chargeMoney.intro', 'uses' => 'ChargeMoneyController@intro']);
    });
});
