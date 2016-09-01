@extends('frontend/layout/chotot-default')
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
                            <form method="post" action="">
                                <div class="form-group">
                                    <p>Vui lòng nhập các thông tin bên dưới để đặt lại mật khẩu</p>
                                </div>
                                <div class="form-group ">
                                    <label for="Maukhau">Mật khẩu hiện tại:</label>
                                    <input type="password" class="form-control" id="Maukhau" name="passCurrent" placeholder="Mật khẩu hiện tại:" value="">
                                </div>
                                <div class="form-group {{ hasValidator('password') }}">
                                    <label for="Maukhaumoi">Mật khẩu mới:</label>
                                    <input type="password" class="form-control" id="Maukhaumoi" name="password" placeholder="Mật khẩu mới:" value="">
                                    {!! alertError('password') !!}
                                </div>
                                <div class="form-group {{ hasValidator('rePass') }}">
                                    <label for="RePassMaukhau">Xác nhận mật khẩu:</label>
                                    <input type="password" class="form-control" id="RePassMaukhau" name="rePass" placeholder="Xác nhận mật khẩu:" value="">
                                    {!! alertError('rePass') !!}
                                </div>
                                <button type="submit" class="btn btn-warning form-control">Đổi mật khẩu</button>
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