<?php

namespace Nht\Http\Middleware;

use Closure;
use Nht\Hocs\Users\UserRepository;

class CheckLogged
{
    /**
     * User
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new filter instance.
     *
     * @param  UserRepository  $user
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->user->isLogged()) {
            return $next($request);
        } else {
            return redirect()->route('auth.login_form');
        }
    }
}
