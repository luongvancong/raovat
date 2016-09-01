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
use Nht\Http\Controllers\FrontendController;
use Nht\Http\Requests;
use OpenGraph;

class HomeController extends FrontendController
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		return view('frontend.home.chotot-index');
	}


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
