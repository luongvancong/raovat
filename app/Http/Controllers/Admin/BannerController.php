<?php

namespace Nht\Http\Controllers\admin;

use Illuminate\Http\Request;

use Nht\Http\Requests;

use Nht\Http\Controllers\Admin\AdminController;
use Nht\Http\Controllers\Controller;

use Nht\Http\Requests\AdminBannerFormRequest;
use Nht\Hocs\Banners\Banner;
use Nht\Hocs\Banners\BannerRepository;

use App;


class BannerController extends AdminController
{
	protected $banner;

	public function __construct(BannerRepository $banner)
	{
		parent::__construct();
		$this->banner   = $banner;
		$this->upload = App::make('Upload');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$banners      = $this->banner->getAllWithPaginate($request->all());
		$positionList = Banner::getPositionList();
		$pageList     = Banner::getPageList();
		return view('admin/banners/index', compact('banners', 'positionList', 'pageList'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin/banners/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(AdminBannerFormRequest $request)
	{
		$formData = $request->except('_token');
		if($request->hasFile('image')) {
			$formData['image'] = $this->upload->upload('image', PATH_UPLOAD_BANNER);
		}

		if($this->banner->create($formData)) {
			return redirect()->back()->with('success', trans('general.messages.create_success'));
		}

		return redirect()->back()->with('success', trans('general.messages.create_fail'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$banner = $this->banner->getById($id);
		return view('admin/banners/edit', compact('banner'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(AdminBannerFormRequest $request, $id)
	{
		$banner = $this->banner->getById($id);
		$formData = $request->except('_token');

		if($request->hasFile('image')) {
			$formData['image'] = $this->upload->upload('image', PATH_UPLOAD_BANNER);
		}

		if($this->banner->update($formData, ['id' => $id])) {
			return redirect()->back()->with('success', trans('general.messages.update_success'));
		}

		return redirect()->back()->with('success', trans('general.messages.update_fail'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$banner = $this->banner->getById($id);

		if($banner->delete()) {
			return redirect()->back()->with('success', trans('general.messages.delete_success'));
		}

		return redirect()->back()->with('success', trans('general.messages.delete_fail'));
	}


	public function active($id) {
		$banner = $this->banner->getById($id);

		$banner->status = !$banner->status;

		if($banner->save()) {
			return response()->json([
			   'code' => 1,
			   'status' => $banner->getStatus()
			]);
		}

		return response()->json([
		   'code' => 0
		]);
	}
}
