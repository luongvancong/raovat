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
                                    <a href="{{ route('profile.chinhsua') }}" title=""><img style="max-height: 100px" src="/uploads/users/lg_2016_09_19_f262823e75.jpg"></a>
                                    <a href="{{ route('profile.chinhsua') }}" title=""><span>The Vinh
                                    </span></a>
                                    <a href="{{ route('profile.chinhsua') }}" title="">Xem trang cá nhân của bạn</a>
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
                                @foreach($allPost as $rowPost)
                                <div style="background-color: #e2fbfb;width: 100%;height: 150px;margin-bottom: 5px;position: relative;" role="tabpanel" class="tab-pane active" id="dangban">
                                    
                                    <div>
                                        <img style="max-height: 100px; float: left;margin-top: 26px;margin-left: 10px;" src="{{ asset('uploads/posts/'.$rowPost->image) }}">
                                        <a href="#"><h4 style="float: left;margin: 24px 14px;">{{ $rowPost->title }}</h4></a>
                                        <div style="position: absolute;top: 85px;left: 185px;color: #6a59c1;">
                                            <p>Ngay Dang</p>
                                            <p>{{ $rowPost->created_at }}</p>
                                        </div>
                                        
                                    </div>
                                    <div style="position: absolute;top: 20px;left: 672px;" class="btn-group">
                                        <button type="button" data-toggle="dropdown">
                                          <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li style="margin-left: 25px;" ><a href="{{ route('suatin',[$rowPost->id]) }}"><i style="margin-right: 17px" class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
                                          <li style="margin-left: 25px;"><a onclick="return confirmDelete('Ban co chac chan muon xoa khong')" href="{{ route('xoatin',[$rowPost->id]) }}"><i style="margin-right: 17px" class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                                          <li style="margin-left: 25px;"><a href="{{ route('chiasetin',[$rowPost->id]) }}"><i style="margin-right: 17px" class="fa fa-share-alt-square" aria-hidden="true"></i>Share</a></li>
                                          <li style="margin-left: 25px;"><a href="{{ route('antin',[$rowPost->id]) }}"><i style="margin-right: 17px" class="fa fa-ban" aria-hidden="true"></i>Hidden</a></li>
                                        </ul>
                                    </div>
                                    <div style="position: absolute;top: 96px;left: 576px;" class="btn-group">
                                      <button style="background-color: #578e2d;" type="button" class="btn btn-default"><i style="color: #fff;"class="fa fa-arrow-up" aria-hidden="true"></i></button>
                                      <button style="background-color: #578e2d;" type="button" class="btn btn-default">Day Tin</button>
                                    </div>
                                   
                                </div>
                                @endforeach
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