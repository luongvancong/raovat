@extends('frontend/layout/default')

@section('content')
<div class="row">

    @yield('account_breadcrumb')

    <div class="col-sm-3">
        <div id="account-area-nav-left">
            <div class="list-group">
                <a class="list-group-item {{ Request::is('account/settings/ads*') ? 'active' : '' }}" href="{{ route('account.ads') }}">Quảng cáo</a>
                <a class="list-group-item {{ Request::is('account/settings/auction*') ? 'active' : '' }}" href="{{ route('account.auction') }}">Đấu giá click</a>
                <a class="list-group-item {{ Request::is('account/settings/link-to-shop*') ? 'active' : '' }}" href="{{ route('account.linkToShop') }}">Liên kết cửa hàng</a>
                <a class="list-group-item {{ Request::is('account/settings/huong-dan-nap-tien*') ? 'active' : '' }}" href="{{ route('account.chargeMoney.intro') }}">Nạp tiền</a>
                <a class="list-group-item {{ Request::is('account/settings/profile*') ? 'active' : '' }}" href="{{ route('account.profile') }}">Thay đổi thông tin</a>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        @yield('account_content')
    </div>
</div>
@stop