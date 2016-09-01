@extends('frontend/layout/chotot-default')
@section('title','Thông tin cá nhân')
@section('content')
    <!-- main -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tai-khoan-dong-tot">
                        <div class="col-md-12">
                            <div class="row">
                                <ol>
                                    <li><a href="#">Chottot.com </a></li>
                                    <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><b> Tài khoản đồng tốt</b></li>
                                </ol>
                                <h1>Tài khoản Đồng Tốt</h1>
                                <hr>
                                <p><i>Trải nghiệm ngay phương thức thanh toán mới tiết kiệm hơn với chương trình khuyến mãi nhân dịp ra mắt lên đến 30%. <a href="">Xem thêm</a></i></p>
                                <div class="col-sm-1 col-xs-3">
                                    <div class="row">
                                        <span>Số dư:</span>
                                    </div>
                                </div>
                                <div class="col-sm-10 so-du col-xs-7">
                                    <div class="row">
                                        <span class="">0 <img src="{!! asset('images/icon/dongtot.png') !!}"></span>
                                    </div>
                                </div>
                                <div class="col-sm-1 col-xs-2">
                                    <div class="row">
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <p>&nbsp;</p>
                                <hr>
                                <div class="col-md-12 nap-dong-tot">
                                    <div class="row">
                                        <a href="" class="btn btn-success">Nạp đồng tốt</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main -->
@endsection