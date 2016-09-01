@extends('frontend/layout/chotot-default')
@section('title','Đăng nhập')
@section('content')
    <!-- main -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="dangnhap-dangky" id="form-dangnhap">
                    <div class="form-title">
                        Đăng nhập
                    </div>
                    @if (Session::has('thongbao'))
                    <div class="alert alert-{!! Session::get('level') !!}">
                        {!! Session::get('thongbao') !!}
                    </div>
                    @endif
                    <form method="post" action="{!! route('post.dangnhap') !!}">
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="" placeholder="Nhập email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="checkbox">
                            <label>
                            <input type="checkbox"> Ghi nhớ tài khoản?
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning form-control">Đăng nhập</button>
                        </div>
                        <div class="form-group">
                            <a href="" class="btn btn-default form-control quen-mat-khau">Quên mật khẩu?</a>
                        </div>
                        <hr>
                        <div class="form-inline">
                            <a href="" class="btn btn-primary form-facebook">Đăng nhập bằng <i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                            <a href="{!! route('dangky') !!}" class="btn btn-success form-facebook margin-facebook">Đăng ký</a>
                        </div>
                    {!! csrf_field() !!}
                    </form>
                </div>
                <!-- end đăng nhập -->
            </div>
        </div>
    </div>
    <!-- end main -->
@endsection