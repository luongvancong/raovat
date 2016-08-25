<?php
namespace Nht\Hocs\Advertise;

use App;

trait AdsGenerate {

	public function showAdvertise()
    {
        $arr_result = [];
        $arr_cookie = [];

        $cookie_ads = isset($_COOKIE['_ads']) ? $_COOKIE['_ads'] : '';
        $arr_ads = json_decode($cookie_ads, true);

        $ads = \App::make('Nht\Hocs\Advertise\AdsRepository')->getAllActiveAds($arr_ads);

        foreach ($ads as $value) {
            $arr_result[$value->position] = $value;
            $arr_cookie[$value->position] = $value->id;
        }

        $arr_position_diff = array_diff_key(position_ads(), $arr_result);

        foreach ($arr_position_diff as $key => $value) {
            $object = new \StdClass();
            $object->id = 0;
            $object->position = $key;
            $object->link = route('advertise.register');
            $object->banner = '/images/ads.jpg';
            $object->title ='Đặt quảng cáo tại đây';
            $arr_result[$key] = $object;
        }

        view()->share('GLB_ads', $arr_result);

        return $arr_cookie;
    }

}