<?php

namespace Nht\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Nht\Http\Requests\AdminAdvertiserFromRequest;
use Nht\Http\Controllers\BackendController;

use Nht\Hocs\Advertise\AdsRepository;
use Nht\Hocs\Users\UserRepository;

use App, Input, File;

class AdvertiseController extends BackendController
{

	public function __construct(AdsRepository $ads, UserRepository $user)
	{
		$this->ads = $ads;
		$this->user = $user;
		$this->upload = App::make('Upload');
	}

	public function getRegister(Request $request)
	{
		$data = $this->ads->getRegisterPaginate(20, $request->all());
		return view('admin/advertise/register', compact('data'));
	}

	public function getRegisterDelete($id)
	{
		$result = $this->ads->deleteRegister($id);
		if ($result) {
			return redirect()->route('admin.advertise.register')
				->with('success', 'Xóa thành công');
		}
	}

	public function getIndex(Request $request)
	{
		$data = $this->ads->getPaginate(20, $request->all());
		return view('admin/advertise/index', compact('data'));
	}

	public function getCreate()
	{
		$user = $this->user->getAllUser();
		return view('admin/advertise/create', compact('user'));
	}

	public function postCreate(AdminAdvertiserFromRequest $request)
	{
		$data = $this->executeData($request);

		if ( !empty($data) ) {
			$result = $this->ads->saveAds($data);

			if ($result) {
				return redirect()->route('admin.advertise.index')
					->with('success', 'Tạo thành công');
			}
		}
	}

	public function getActive($id)
	{
		$ads = $this->ads->updateActive($id);

		if ($ads)
			return response()->json(['code' => 1, 'status' => $ads->getActive() ]);
		else
			return response()->json(['code' => 0]);
	}

	public function getEdit($id)
	{
		$data = $this->ads->getAdsById($id);
		$user = $this->user->getAllUser();
		return view('admin/advertise/edit', compact('data', 'user'));
	}

	public function postEdit(AdminAdvertiserFromRequest $request, $id)
	{
		$data = $this->executeData($request);

		if ( !empty($data) ) {
			$result = $this->ads->updateAds($data, $id);

			if ($result) {
				return redirect()->route('admin.advertise.index')
					->with('success', 'Cập nhật thành công');
			}
		}
	}

	public function getDelete($id)
	{
		$result = $this->ads->deleteAds($id);
		if ($result) {
			return redirect()->route('admin.advertise.index')
				->with('success', 'Xóa thành công');
		}
	}

	public function getStatistic(Request $request, $id)
	{
		// dd($request->all());
		$from = $request->get('from', date('d/m/Y',strtotime("-5 days")));
		$to = $request->get('to', date('d/m/Y'));
		$ads = $this->ads->getStatisticByAdsId($id, $from, $to);
		$data = [];
		foreach ($ads as $value) {
			$data['day'][] = date('d/m/Y', strtotime($value->getDay()));
			$data['count'][] = (int) $value->getCount();
		}
		return view('admin.advertise.statistic', compact('id', 'data'));
	}

	public function getStatisticUpdate($id)
	{
		$this->ads->insertStatisticWithAdsId($id);
		return redirect()->route('admin.advertise.statistic', $id);
	}

	private function executeData($request)
	{
		if ($request->has('_token')) {
			$data = $request->all();
			unset($data['_token']);
			if (Input::hasFile('banner')) {
                if (!File::exists(PATH_UPLOAD_IMAGE_ADVERTISE))
                    File::makeDirectory(PATH_UPLOAD_IMAGE_ADVERTISE);

                $data['banner'] = $this->upload->upload('banner', PATH_UPLOAD_IMAGE_ADVERTISE);
            }

            $user_id = $this->user->getUserById($data['user_id'])->getId();
            $data['user_id'] = $user_id;
            $data['created_at'] = change_date($data['created_at']);
            $data['expired'] = change_date($data['expired']);

			return $data;
		}
	}

}
