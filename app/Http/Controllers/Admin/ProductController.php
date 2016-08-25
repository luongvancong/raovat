<?php

namespace Nht\Http\Controllers\Admin;

use App;
use Config;
use Event;
use Illuminate\Http\Request;
use Nht\Events\DeleteProductEvent;
use Nht\Events\UpdateProductEvent;
use Nht\Hocs\Products\ProductRepository;
use Nht\Hocs\Tags\TagRepository;
use Nht\Http\Controllers\Admin\AdminController;
use Nht\Http\Requests;
use Nht\Http\Requests\AdminProductFormRequest;

class ProductController extends AdminController
{
	protected $product;

	public function __construct(ProductRepository $product, TagRepository $tag)
	{
		parent::__construct();
		$this->product = $product;
		$this->image = App::make('ImageFactory');
		$this->tag = $tag;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$products = $this->product->getProductsPaginated(20, $request->all());
		return view('admin/products/index', compact('products'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin/products/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(AdminProductFormRequest $request)
	{
		$data            = $request->all();
		$data['keyword'] = removeTitle($request->get('keyword'));

		if ($this->product->create($data))
		{
			return redirect()->route('admin.product.create')->with('success', trans('general.messages.create_success'));
		}
		return redirect()->back()->withInputs()->with('error', trans('general.messages.create_fail'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$product = $this->product->getById($id);

		$products = $this->product->getByIds(explode(',', $product->opponent));

		$oldOpponents = [];

		foreach($products as $p) {
			$oldOpponents[] = [
				'id' => $p->getId(),
				'name' => $p->getName()
			];
		}

		$oldOpponents = json_encode($oldOpponents, JSON_UNESCAPED_UNICODE);

		return view('admin/products/edit', compact('product', 'oldOpponents'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, AdminProductFormRequest $request)
	{
		$data = $request->except('_token');

		if ($this->product->update($data, ['id' => $id]))
		{
			$product = $this->product->getById($id);
			Event::fire(new UpdateProductEvent($product));

			return redirect()->route('admin.product.edit', $id)->with('success', trans('general.messages.update_success'));
		}

		return redirect()->back()->withInputs()->with('error', trans('general.messages.update_fail'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$product = $this->product->getById($id);

		if ($this->product->delete($id))
		{
			Event::fire(new DeleteProductEvent($product));

			return redirect()->route('admin.product.index')->with('success', trans('general.messages.delete_success'));
		}
		return redirect()->route('admin.product.index')->with('error', trans('general.messages.delete_fail'));
	}

	public function toggleHot($id) {
		$product = $this->product->getById($id);

		$product->hot = ! $product->hot;
		$product->save();

		return response()->json([
		   'code' => 1,
		   'status' => $product->hot,
		]);
	}

	public function toggleBanner($id) {
		$product = $this->product->getById($id);

		$product->is_banner = ! $product->is_banner;
		$product->is_banner_time = date('Y-m-d H:i:s');
		$product->save();

		return response()->json([
		   'code' => 1,
		   'status' => $product->is_banner,
		]);
	}


	public function toggleNewest($id) {
		$product = $this->product->getById($id);

		$product->newest = ! $product->newest;
		$product->save();

		return response()->json([
		   'code' => 1,
		   'status' => $product->newest,
		]);
	}


	public function ajaxEditable(Request $request)
	{
		$id    = $request->get('product_id');
		$field = $request->get('field');
		$value = $request->get('value');

		return $this->product->update([$field => $value], ['id' => $id]);
	}


	public function changeAvatar(Request $request)
	{
		$id      = $request->get('product_id');
		$product = $this->product->getById($id);

		$config = Config::get('image');
		$configThumbs = $config['array_crop_image'];

		$rsUpload = $this->image->upload('file', PATH_UPLOAD_IMAGE_PRODUCT, $configThumbs, 'crop');
		if($rsUpload['status'] > 0) {
			if($this->product->update(['image' => $rsUpload['filename'], 'is_crawl' => 0], ['id' => $id])) {
				return redirect()->back()->with('success', 'Cập nhật ảnh thành công');
			}
		}

		return redirect()->back()->with('error', 'Cập nhật ảnh không thành công');
	}


	public function autocomplete(Request $request)
	{
		$name = $request->get('q');
		$products = $this->product->getByName($name);
		$jsons = [];
		foreach($products as $product) {
			$jsons[] = [
				'id' => $product->getId(),
				'name' => $product->getName()
			];
		}
		return $jsons;
	}


	public function tagIndex($productId, Request $request)
	{
		$product = $this->product->getById($productId);
		$tags = $this->tag->getAllTagsByProduct($product);

		return view('admin/products/tag/index', compact('product', 'tags'));
	}


	public function tagDelete($productId, $tagId)
	{
		\DB::table('products_tags')->where('product_id', $productId)->where('tag_id', $tagId)->delete();
		return redirect()->back()->with('success', 'Xóa thành công');
	}


	public function tagCreate($productId, Request $request)
	{
		$product = $this->product->getById($productId);
		return view('admin/products/tag/create', compact('product'));
	}


	public function tagCreateStore($productId, Request $request)
	{
		$product = $this->product->getById($productId);
		$tags = explode(',', $request->get('tags'));
		$product->tags()->attach($tags);
		return redirect()->route('admin.product.tag.index', [$product->getId()])->with('success', 'Thêm tag thành công');
	}

}
