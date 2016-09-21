@extends('frontend/layout/chotot-default')
@section('title','Đăng ký')
@section('content')
    <!-- main -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="dangnhap-dangky" id="form-dangky">
                    <div class="form-title">
                        Đăng ký
                    </div>
                    <form method="post" action="{!! route('post.dangky') !!}">
                        <div class="form-group {{ hasValidator('name') }}">
                            <input type="text" class="form-control" id="" name="name" value="{{ Request::old('name') }}" placeholder="Họ tên">
                            {!! alertError('name') !!}
                        </div>
                        <div class="form-group {{ hasValidator('email') }}">
                            <input type="email" class="form-control" id="" name="email" value="{{ Request::old('email') }}" placeholder="Nhập email">
                            {!! alertError('email') !!}
                        </div>
                        <div class="form-group {{ hasValidator('password') }}">
                            <input type="password" class="form-control" id="" name="password" placeholder="Nhập mật khẩu">
                            {!! alertError('password') !!}
                        </div>
                        <div class="form-group">
                            <select name="cit_id" id="vungmiens" class="form-control">
                                <option>---Chọn vùng---</option>
                                @foreach($dataCity as $city) 
                                    <option value="{{ $city->cit_id }}">{{ $city->cit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="cit_parent" id="quanhuyen" class="form-control">
                                <option value="">---Chọn Tinh, Quan, Huyen---</option> 
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="" name="address" placeholder="Địa chỉ">
                        </div>
                        <div class="form-group {{ hasValidator('phone') }}">
                            <input type="number" class="form-control" id="" name="phone" value="{{ Request::old('phone') }}" placeholder="Số điện thoại">
                            {!! alertError('phone') !!}
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning form-control">Đăng ký</button>
                        </div>
                        <div class="form-group">
                            <p>Bấm vào đăng ký nghĩa là bạn đã đọc và đồng ý với <a href="#">Điều khoản sử dụng</a> của ChợTốt.com</p>
                            <p>Ở bước tiếp theo bạn sẽ nhận được mã xác nhận số điện thoại gửi qua SMS</p>
                        </div>
                        <hr>
                        <div class="form-inline">
                            <p class="text-center">Bạn đã có tài khoản? <a href="{!! route('dangnhap') !!}" class="" data-id="#form-dangnhap">Đăng nhập</a></p>
                        </div>
                    {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end main -->
@endsection