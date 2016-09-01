@extends('frontend/layout/chotot-default')
@section('title','Quản lý tin đăng')
@section('content')
    <!-- main -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <div class="quan-ly-tin-dang">
                            <ol>
                                <li><a href="#">Chottot.com </a></li>
                                <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Quản lý tin</a></li>
                                <li><i class="fa fa-angle-double-right" aria-hidden="true"></i><b> Đang bán</b></li>
                            </ol>
                            <h1>Quản lý tin đăng</h1>
                            <div class="alert alert-info tin-dang-top" role="alert">
                                <div class="xoa-tin-dang-top">
                                    <button type="button btn-default"><i class="fa fa-times" aria-hidden="true"></i></button>
                                </div>
                                Chợ Tốt giới thiệu phương thức thanh toán mới với cực nhiều ưu đãi, tiết kiệm lên đến 30% khi nạp Đồng Tốt vào tài khoản. <a href="">Trải nghiệm ngay!</a>
                            </div>
                            <div class="tin-dang-noi-dung">
                                <div class="tin-dang-noi-dung-user">
                                    <a href="" title=""><img src="{!! asset('images/icon/member1.png') !!}"></a>
                                    <a href="" title=""><span>Lê Khang</span></a>
                                    <a href="" title="">Xem trang cá nhân của bạn</a>
                                </div>
                            </div>
                            <div class="menu-tindang">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#dangban" aria-controls="dangban" role="tab" data-toggle="tab">Đang bán (0)</a></li>
                                    <li role="presentation"><a href="#doiduyet" aria-controls="doiduyet" role="tab" data-toggle="tab">Đợi duyệt (0)</a></li>
                                    <li role="presentation"><a href="#bituchoi" aria-controls="bituchoi" role="tab" data-toggle="tab">Bị từ chối (0)</a></li>
                                    <li role="presentation"><a href="#daan" aria-controls="daan" role="tab" data-toggle="tab">Đã ẩn (0)</a></li>
                                </ul>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="dangban">Bạn chưa có tin nào trong mục này</div>
                                <div role="tabpanel" class="tab-pane" id="doiduyet">Bạn chưa có tin nào trong mục này</div>
                                <div role="tabpanel" class="tab-pane" id="bituchoi">Bạn chưa có tin nào trong mục này</div>
                                <div role="tabpanel" class="tab-pane" id="daan">...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main -->
@endsection