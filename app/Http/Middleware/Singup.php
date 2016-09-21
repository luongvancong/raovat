<?php

namespace Nht\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Nht\Hocs\Users\UserRepository;

class Singup
{

    protected $user;

    
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    
    public function handle($request, Closure $next)
    {
        if ($this->user->isLogged()) {
         
            return redirect()->route('home-page');
           
        }

        return $next($request);
    }
}
