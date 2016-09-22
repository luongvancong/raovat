<?php

namespace Nht\Http\Controllers;

use Illuminate\Http\Request;
use Nht\Hocs\Banners\Banner;
use Nht\Hocs\Banners\BannerRepository;
use Nht\Hocs\Core\Metadata\Metadata;
use Nht\Hocs\Posts\PostRepository;
use Nht\Hocs\Products\Product;
use Nht\Hocs\Products\ProductRepository;
use Nht\Hocs\Sites\SiteRepository;
use Nht\Hocs\Tags\TagRepository;

use Nht\Hocs\Cities\CityRepository;

use Nht\Http\Controllers\FrontendController;
use Nht\Http\Requests;
use OpenGraph;
use Auth;

class HomeController extends FrontendController
{

	public function __construct(CityRepository $city, PostRepository $post)
	{
		parent::__construct();
		$this->city = $city;
		$this->post = $post;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//Auth::user()->id;
		//_debug(Auth::user()->id);die;
		$cities = $this->city->getCities();
		$post_item = $this->post->getAll();

		if($post_item->count() > 10) {
			$post_item = $post_item->random(10);
		}
		return view('frontend.home.chotot-index', compact('cities','post_item'));

	}
	/** lay ra id cua user da dang nhap*/
	// public function getUserId(){	
	// 	$userId = Auth::user()->id;var_dump($userId);die;
	// 	return view('frontend.layout.chotot-default', compact('userId'));
	// }


	/**
	 * Dữ liệu open graph
	 * @return html
	 */
	private function openGraph() {
		$request = $this->request;
		$openGraph = OpenGraph::setTitle($this->metadata->getMetaTitle())
						->setType("summary")
						->setUrl($this->request->url())
						->setImage( asset('/uploads/settings/'. $this->metadata->getLogo()) )
						->setDescription($this->metadata->getMetaDescription())
						->facebook(function($facebook) {
							$facebook->setAdmins(100001247771720);
						})
						->google(function($google) {
							$google->setName($this->metadata->getMetaTitle());
							$google->setDescription($this->metadata->getMetaDescription());
							$google->setImage( asset('/img/'. $this->metadata->getLogo()) );
						})
						->twitter(function($twitter) use($request) {
							$twitter->setCard('summary');
						    $twitter->setSite($request->url());
						    $twitter->setTitle($this->metadata->getMetaTitle());
						    $twitter->setDescription($this->metadata->getMetaDescription());
						    $twitter->setImage( asset('/img/'. $this->metadata->getLogo()) );
						})
						->generate();

		return $openGraph;
	}
}
