<?php

namespace Nht\Http\Controllers;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Nht\Http\Controllers\Controller;
use Nht\Http\Controllers\FrontendController;
use Nht\Hocs\Cities\CityRepository;

class AjaxController extends FrontendController
{
    public function __construct(CityRepository $city)
    {
        parent::__construct();
        $this->city = $city;
    }

    public function getCities() {
        return response()->json($this->city->getCities());
    }

    public function getDistricts(Request $request) {
        $cityId  = (int) $request->get('city_id');
        $distrit = $this->city->getDistrictsByCityId($cityId);
        return response()->json($distrit);
    }
}
