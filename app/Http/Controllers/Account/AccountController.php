<?php

namespace Nht\Http\Controllers\Account;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Nht\Http\Requests\AdvertiseFormRequest;
use Nht\Http\Controllers\FrontendController;

use Nht\Hocs\Advertise\AdsRepository;
use Nht\Hocs\Users\UserRepository;

class AccountController extends FrontendController
{
    public function __construct(UserRepository $user, AdsRepository $ads)
    {
        parent::__construct();
        $this->user = $user;
        $this->ads = $ads;
    }

    public function index()
    {
        return view('account/index');
    }


    public function ads()
    {
        $user_id = $this->user->getCurrentUser()->getId();

        $data = $this->ads->getPaginate(20, ['user_id' => $user_id]);

        return view('account/ads/index', compact('data'));
    }


    public function adsStatistic(Request $request, $id)
    {
        $from = $request->get('from', date('d/m/Y',strtotime("-5 days")));
        $to = $request->get('to', date('d/m/Y'));
        $ads = $this->ads->getStatisticByAdsId($id, $from, $to);
        $data = [];
        foreach ($ads as $value) {
            $data['day'][] = date('d/m/Y', strtotime($value->getDay()));
            $data['count'][] = $value->getCount();
        }

        return view('account.ads.statistic', compact('id', 'data'));
    }


    public function auction()
    {
        # code...
    }


    public function infomation()
    {
        # code...
    }



}
