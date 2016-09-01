<?php

namespace Nht\Http\Controllers\Auth;

use Socialite;
use Illuminate\Routing\Controller;

use Nht\Http\Requests;
use Illuminate\Http\Request;
use Nht\Http\Requests\UserRegisterFormRequest;

use Nht\Http\Controllers\FrontendController;
use Nht\Hocs\Users\UserRepository;
use App;
use Auth;
use Config;

class AuthController extends FrontendController
{

    public function __construct(UserRepository $user)
    {
        parent::__construct();
        $this->user  = $user;
        $this->image = App::make('ImageFactory');
    }

    public function getLoginForm()
    {
        if($this->user->isLogged()) {
            if($url = \Session::get('redirect')) {
                \Session::forget('redirect');
                return redirect()->to($url);
            }

            return redirect()->to('/');
        }

        $this->metadata->setTitle('Đăng ký/Đăng nhập | Giaca.org | So sánh giá');
        $this->metadata->setMetaKeyword('đăng ký, đăng nhập, so sánh giá, so sánh giá hot nhất, điện thoại mới, đồ công nghệ, giá rẻ, iphone6, iphone6s...');
        $this->metadata->setDescription('Giá máy tính, giá điện thoại di dộng, giá rẻ, so sánh gía, hot nhất, đăng ký, đăng nhập');

        return view('frontend/auth/dangnhap');
    }

    public function postLoginForm(Request $request){
        $data = $request->except('_token');
        if ($this->user->isLoginUser($data))
        {
            return redirect()->route('home-page');
        }
        else
        {
            return redirect()->back()->with(['thongbao' => 'Sai tài khoản hoặc mật khẩu', 'level' => 'danger']);
        }
    }
    public function getDangky(){
        return view('frontend/auth/dangky');
    }
    public function postDangkyForm(UserRegisterFormRequest $request){
        $data = $request->except('_token');
        $data['password'] = bcrypt($request->password);
        $data['avatar'] = "avatar.jpg";
        if ($this->user->create($data)) {
            return redirect()->route('dangnhap')->with('success', trans('general.messages.create_success'));
        }
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }


    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($social)
    {
        $user      = Socialite::driver($social)->user();
        $userExist = $this->user->getByEmail($user->getEmail());

        if($userExist) {
            Auth::login($userExist);

            if($url = \Session::get('redirect')) {
                \Session::forget('redirect');
                return redirect()->to($url);
            }

            return redirect()->to('/');
        } else {
            if($userCreated = $this->user->createUserFromSocialite($user)) {

                // Upload ảnh
                $config = Config::get('image');
                $thumbs = $config['array_crop_image'];
                $resUpload = $this->image->download($user->getAvatar(), PATH_UPLOAD_USER_AVATAR, $thumbs, 'crop');
                if($resUpload['status'] > 0) {
                    $userCreated->avatar = $resUpload['filename'];
                    $userCreated->save();
                }

                Auth::login($userCreated);
                return redirect()->to('/');
            }
        }
    }


    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('dangnhap');
    }
}
