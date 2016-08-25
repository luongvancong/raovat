<?php

namespace Nht\Http\Controllers\Admin;

use Nht\Http\Controllers\Admin\AdminController;
use Nht\Http\Requests\AdminLoginFormRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;

/**
 * Class description.
 *
 * @author	AlvinTran
 */
class AuthController extends AdminController
{
	use ThrottlesLogins;

	protected $loginPath = '/admin/login';
	protected $redirectPath = '/admin/dashboard';

	/**
	 * Get login view
	 * @return View
	 */
	public function login()
	{
		if ($this->logger->isAdmin()) {
			return redirect($this->redirectPath());
		}

        if ( !$this->auth->check() ) {
            return view('admin.login');
        }

        return redirect($this->redirectPath());
	}

	/**
	 * Get logout
	 * @return Redirect
	 */
	public function logout()
	{
		$this->auth->logout();
		return redirect($this->loginPath());
	}

	/**
	 * Authentication login admin
	 * @param  AdminLoginFormRequest $request
	 * @return Redirect
	 */
	public function authenticate(AdminLoginFormRequest $request)
	{
		// Throttles login
		if ($this->hasTooManyLoginAttempts($request)) {
         return $this->sendLockoutResponse($request);
      }

		if ($this->auth->attempt($this->getCredentials($request), $request->has('remember'))) {
			$this->clearLoginAttempts($request);
			return redirect()->intended($this->redirectPath());
		}

		$this->incrementLoginAttempts($request);
		$countLoginFails = $this->getLoginAttempts($request) - 1;
		return back()->withInput()->with(['message' => 'Sai thông tin đăng nhập!', 'countLoginFails' => $countLoginFails]);
	}

	/**
	 * View dashboard
	 * @return View
	 */
	public function dashboard()
	{
        return view('admin/dashboard');
	}

	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function loginUsername()
	{
		return 'email';
	}

	/**
    * Get the path to the login route.
    *
    * @return string
    */
   public function loginPath()
   {
      return $this->loginPath;
   }

   /**
    * Get the path to the login route.
    *
    * @return string
    */
   public function redirectPath()
   {
      return $this->redirectPath;
   }

   /**
    * Get the needed authorization credentials from the request.
    *
    * @param  AdminLoginFormRequest  $request
    * @return array
    */
   protected function getCredentials(AdminLoginFormRequest $request)
   {
      return $request->only($this->loginUsername(), 'password');
   }
}
