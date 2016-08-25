<?php

namespace Nht\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Nht\Hocs\Tags\Tag;
use App;
use Auth, Cookie;
use Nht\Hocs\Advertise\AdsGenerate;

class FrontendController extends BaseController
{
    use DispatchesJobs, ValidatesRequests, AdsGenerate;

    public function __construct() {
        $this->metadata = \App::make('Nht\Hocs\Core\Metadata\Metadata');
        view()->share('setting', $this->metadata);

        $userLogged = Auth::user();
        view()->share('GLB_Login', $userLogged);

    }

}
