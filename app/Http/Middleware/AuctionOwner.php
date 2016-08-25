<?php

namespace Nht\Http\Middleware;

use Closure;
use Nht\Hocs\Auctions\AuctionRepository;
use Nht\Hocs\Users\UserRepository;

class AuctionOwner
{

    public function __construct(AuctionRepository $auction)
    {
        $this->auction = $auction;
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
        $user = \Auth::user();

        if(!$this->auction->isOwnerAuction($user->getId(), $request->id)) {
            return redirect()->back()->with('error', 'Bạn không có quyền thực hiện tác vụ này');
        }

        return $next($request);
    }
}
