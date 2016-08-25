<?php

namespace Nht\Http\Controllers;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Illuminate\Routing\Controller as BaseController;
use Nht\Hocs\Posts\PostRepository;
use Nht\Hocs\Products\ProductRepository;

use Session;

class TestController extends BaseController
{

	public function getIndex(Request $request) {
        // var_dump(bcrypt("12345678"));
	}
}