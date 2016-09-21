@extends('frontend.layout.chotot-default')
@section('title','Thông tin cá nhân')
@section('content')
    <!-- main -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="row">
                        <div class="thong-tin-ca-nhan-chinh-sua">
                            <ol>
                                <li><a href="#">Chottot.com </a></li>
                                <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><b> Thông tin cá nhân</b></li>
                            </ol>
                            <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div>
                                        <img style="max-height: 150px" src="{{ asset('uploads/users/'.$user->avatar) }}" alt="{{ $user->getName() }}" class="img-rounded">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="chonanh">Chọn ảnh</label>
                                    <input type="file" name="file" id="chonanh">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                                </div>
                                {!! csrf_field() !!}
                            </form>
                            <form method="post" action>
                                <div class="form-group">
                                    <label for="Hoten">Họ tên</label>
                                    <input type="text" class="form-control" id="Hoten" name="name" placeholder="Họ tên" value="{{ Request::old('name', $user->getName()) }}">
                                </div>
                                <div class="form-group">
                                    <label for="Diachi">Địa chỉ</label>
                                    <input type="text" class="form-control" id="Diachi" name="address" placeholder="Địa chỉ" value="{{ Request::old('name', $user->getAddress()) }}">
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="text" class="form-control" id="Email" placeholder="Email" value="{{ Request::old('name', $user->getEmail()) }}" disabled="">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning form-control">Lưu</button>
                                </div>
                                <div class="form-group">
                                    <a href="{!! route('profile.password') !!}" class="btn btn-link form-control">Đổi mật khẩu</a>
                                </div>
                                {!! csrf_field() !!}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main -->
@endsection