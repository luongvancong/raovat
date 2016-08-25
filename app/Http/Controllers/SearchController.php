<?php namespace Nht\Http\Controllers;

use Illuminate\Http\Request;
use Nht\Hocs\Classifields\ClassifieldRepository;
use Nht\Hocs\Posts\PostRepository;
use Nht\Hocs\ProductPrices\ProductPriceRepository;
use Nht\Hocs\ProductVideos\ProductVideoRepository;
use Nht\Hocs\Products\ProductRepository;
use Nht\Hocs\Questions\QuestionRepository;
use Nht\Http\Controllers\FrontendController;
use Nht\Http\Requests;

class SearchController extends FrontendController
{
	protected $post;
	protected $product;

	public function __construct(PostRepository $post, ProductRepository $product,
	                            ProductVideoRepository $video, ProductPriceRepository $price,
	                            QuestionRepository $question, ClassifieldRepository $classifield)
	{
		parent::__construct();
		$this->post        = $post;
		$this->product     = $product;
		$this->video       = $video;
		$this->price       = $price;
		$this->question    = $question;
		$this->classifield = $classifield;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$posts    = [];
		$products = [];
		$videos   = [];

		$query = $q  = $request->get('q', '');

		$totalResult = 0;
		$totalResultProduct = $totalResultPost = $totalResultVideo = 0;

		$posts        = $this->post->search($query, 12);
		$products     = $this->product->searchProductsPaginated($query, 12, $this->getSortParams($request), $request->all());
		$videos       = $this->video->searchVideosByKeyword($query, 12);
		$questions    = $this->question->searchByKeyword($query);
		$classifields = $this->classifield->searchByKeyword($query);


		// $videos   = $this->video->searchVideosByKeywordPaginated($query, 12);

		// Thống kê
		$totalResultProduct     = $products->total();
		$totalResultPost        = $this->post->countSearchResult($query);
		$totalResultVideo       = $this->video->countVideoByKeyword($query);
		$totalResultQuestion    = $this->question->countByKeyword($query);
		$totalResultClassifield = $this->classifield->countByKeyword($query);


		$totalResult = $totalResultPost + $totalResultProduct + $totalResultVideo;


		$arraySort = [
			1 => 'Giá tăng dần',
			2 => 'Giá giảm dần'
		];

		return view('frontend/search/index', compact('posts', 'products', 'videos',
		                                             'totalResult', 'totalResultVideo', 'totalResultPost', 'totalResultProduct',
		                                             'totalResultQuestion', 'totalResultClassifield',
		                                             'arraySort', 'q', 'questions', 'classifields'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public function getSortParams(Request $request) {
		$sortBy = $request->get('sort_by');

		switch ($sortBy) {
			case 1:
				return ['price', 'ASC'];

			case 2:
				return ['price', 'DESC'];

			default:
				return ['display_score', 'DESC'];
		}
	}


	public function ajaxPrefecthProducts(Request $request) {
		return response()->json($this->product->getAll());
	}

	public function ajaxRemoteProducts(Request $request, $name) {
		$this->product->getByName($name);
		return response()->json($this->product->getByName($name));
	}
}
