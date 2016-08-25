<?php

namespace Nht\Http\Controllers\Account;

use App;
use Config;
use Illuminate\Http\Request;
use Nht\Hocs\Users\UserRepository;
use Nht\Http\Controllers\FrontendController;
use Nht\Http\Requests;

class ProfileController extends FrontendController
{

    public function __construct(UserRepository $user)
    {
        parent::__construct();
        $this->user = $user;
        $this->image = App::make('ImageFactory');
    }

    public function index()
    {
        $user = \Auth::user();
        return view('account/infomation/index', compact('user'));
    }


    public function update(Request $request)
    {
        $user = $this->user->getCurrentUser();
        $dataUser = $request->except(['_token']);
        if($this->user->update($dataUser, ['id' => $user->getId()])) {
            return redirect()->route('account.profile')->with('success', 'Cập nhật thành công');
        }

        return redirect()->route('account.profile')->with('error', 'Cập nhật thất bại');
    }

    public function changeAvatar(Request $request)
    {
        $user = $this->user->getCurrentUser();
        $config = Config::get('image');
        $thumbs = $config['array_crop_image'];
        $resultUpload = $this->image->upload('file', PATH_UPLOAD_USER_AVATAR, $thumbs, 'crop');
        if($resultUpload['status'] > 0) {
            if($this->user->update(['avatar' => $resultUpload['filename']], ['id' => $user->getId()])) {
                return redirect()->route('account.profile')->with('success', 'Cập nhật thành công');
            } else {
                return redirect()->route('account.profile')->with('error', 'Cập nhật thất bại');
            }
        }

        return redirect()->route('account.profile')->with('error', 'Cập nhật thất bại');
    }
}