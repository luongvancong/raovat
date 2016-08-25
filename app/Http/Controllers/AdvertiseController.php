<?php

namespace Nht\Http\Controllers;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Nht\Http\Requests\AdvertiseFormRequest;
use Nht\Http\Controllers\FrontendController;

use Nht\Hocs\Advertise\AdsRepository;
use Nht\Hocs\Users\UserRepository;

class AdvertiseController extends FrontendController
{

    public function __construct(AdsRepository $ads, UserRepository $user)
    {
        parent::__construct();
        $this->ads = $ads;
        $this->user = $user;
    }

    public function getRegister()
    {
        $user = $this->user->getCurrentUser();
        return view('frontend/advertise/index', compact('user'));
    }

    public function postRegister(AdvertiseFormRequest $request)
    {
        if ($request->has('_token')) {
            $data = $request->all();
            unset($data['_token']);

            // Get current user
            $data['user_id'] = $this->user->getCurrentUser()->getId();

            $result = $this->ads->saveRegister($data);
            if ($result) {
                return redirect()->route('advertise.register')
                    ->with('success', 'Gửi thông tin thành công')
                    ->withInput();
            }
        }
    }

    public function ajaxClick(Request $request)
    {
        if($request->has('ads_id')) {
            $data['ads_id'] = $request->get('ads_id');
            $data['ip'] = $_SERVER['REMOTE_ADDR'];

            $result = $this->ads->saveAdsClick($data);
            return $result;
        }

        return 'none';
    }

    public function getManager()
    {
        $user_id = $this->user->getCurrentUser()->getId();

        $data = $this->ads->getPaginate(20, ['user_id' => $user_id]);

        return view('frontend.advertise.manager', compact('data'));
    }

    public function getStatistic(Request $request,$id)
    {
        $from = $request->get('from', date('d/m/Y',strtotime("-5 days")));
        $to = $request->get('to', date('d/m/Y'));
        $ads = $this->ads->getStatisticByAdsId($id, $from, $to);
        $data = [];
        foreach ($ads as $value) {
            $data['day'][] = date('d/m/Y', strtotime($value->getDay()));
            $data['count'][] = $value->getCount();
        }
        return view('frontend.advertise.statistic', compact('id', 'data'));
    }

}
