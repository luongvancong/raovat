@extends('frontend/layout/default')

@section('content')
<div class="row" id="login-form">
    <div class="col-sm-12">
        <h1>Đăng nhập</h1>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <a class="social-item block btn-facebook" href="{{ route('auth.socialite', ['facebook']) }}">
                    <i class="fa fa-facebook pull-left"></i>
                    <span>Facebook</span>
                </a>
            </div>
            <div class="col-sm-6">
                <a class="social-item block btn-google" href="{{ route('auth.socialite', ['google']) }}">
                    <i class="fa fa-google pull-left"></i>
                    <span>Google</span>
                </a>
            </div>
        </div>
    </div>
</div>


@stop