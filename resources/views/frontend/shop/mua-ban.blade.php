@extends('frontend/layout/chotot-default')
@section('title','Mua bán')
@section('content')
    <!-- main -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="mua-ban">
                        <div class="mua-ban-left">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#mua" aria-controls="mua" role="tab" data-toggle="tab">Mua</a></li>
                                <li role="presentation"><a href="#ban" aria-controls="ban" role="tab" data-toggle="tab">Bán</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="mua">
                                    <a href="#"><i class="fa fa-play" aria-hidden="true"></i> Xe cộ</a>
                                    <a href="#"><i class="fa fa-play" aria-hidden="true"></i> Bất động sản - Mua bán</a>
                                    <a href="#"><i class="fa fa-play" aria-hidden="true"></i> Bất động sản - Thuê</a>
                                    <a href="#"><i class="fa fa-play" aria-hidden="true"></i> Đồ điện tử</a>
                                    <a href="#"><i class="fa fa-play" aria-hidden="true"></i> Thời trang, Đồ dùng cá nhân</a>
                                    <a href="#"><i class="fa fa-play" aria-hidden="true"></i> Nội ngoại thất, Đồ gia dụng</a>
                                    <a href="#"><i class="fa fa-play" aria-hidden="true"></i> Giải trí, Thể thao, Sở thích</a>
                                    <a href="#"><i class="fa fa-play" aria-hidden="true"></i> Đồ dùng văn phòng, Công nông nghiệp</a>
                                    <a href="#"><i class="fa fa-play" aria-hidden="true"></i> Việc làm, Dịch vụ</a>
                                    <a href="#"><i class="fa fa-play" aria-hidden="true"></i> Đồ dùng văn phòng, Công nông nghiệp</a>
                                    <a href="#"><i class="fa fa-play" aria-hidden="true"></i> Các loại khác</a>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="ban">...</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="mua-ban">
                        <div class="mua-ban-right">
                            <a href="#">chottot.com <i class="fa fa-angle-double-right" aria-hidden="true"></i></a><a href="" class="in-dam"> Hà Nội</a>
                            <div class="col-md-12 tim-kiem">
                                <div class="row">
                                    <form>
                                        <div class="form-group col-md-4">
                                            <label class="sr-only" for="Search">Tìm kiếm</label>
                                            <input type="text" class="form-control" id="Search" placeholder="Tìm kiếm">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="sr-only" for="Danhmuc">Danh mục</label>
                                            <select name="" class="form-control">
                                                <option value="">Tất cả danh mục</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="sr-only" for="Danhmucnho">Danh mục nhỏ</label>
                                            <select name="" class="form-control">
                                                <option value="">Hà Nội</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button type="submit" class="btn btn-danger">Tìm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <h3>Rao vặt tại Hà Nội</h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#tatca" aria-controls="tatca" role="tab" data-toggle="tab">Tất cả 1-20 trong 190035</a></li>
                                            <li role="presentation"><a href="#canhan" aria-controls="canhan" role="tab" data-toggle="tab">Cá nhân 1-20 trong 106996</a></li>
                                            <li role="presentation"><a href="#congty" aria-controls="congty" role="tab" data-toggle="tab">Cá nhân 1-20 trong 83061</a></li>
                                            <li>
                                                <div class="btn-group" role="group" aria-label="...">
                                                    <ul class="nav nav-pills">
                                                        <li class="active"><a href="#" title="Tin mới trước" data-toggle="tab" class="btn btn-default"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
                                                        </li>
                                                        <li><a href="#" title="Giá rẻ trước" data-toggle="tab" class="btn btn-default">VND <i class="fa fa-long-arrow-down" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="btn-group" role="group" aria-label="...">
                                                    <ul class="nav nav-pills">
                                                        <li class="active"><a href="#" title="Xem hình thu nhỏ" data-toggle="tab" class="btn btn-default xem-hinh-nho"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                                                        </li>
                                                        <li> <a href="#" title="Ẩn hình thu nhỏ" data-toggle="tab" class="btn btn-default an-hinh-nho"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="tatca">
                                                <div class="col-md-12">
                                                    <div class="row mua-ban-item">
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <p class="item-hinh-an">4 phút trước <i class="fa fa-camera-retro" aria-hidden="true"></i></p>
                                                                <a href="#" class="item-hinh-hien">
                                                                <img class="img-responsive thumbnail" src="{!! asset('images/product/sanpham2.jpg') !!}" alt="...">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="mua-ban-row">
                                                                <a href="#">Media heading</a>
                                                                <span class="nguoi-dang-tin"><sup><i class="fa fa-check" aria-hidden="true"></i></sup></span>
                                                                <p class="item-tien-hien">2.590.000 đ</p>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <p class="item-tien-an">2.590.000 đ</p>
                                                                <p class="item-thoi-gian">6 phút trước</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row mua-ban-item">
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <p class="item-hinh-an">4 phút trước <i class="fa fa-camera-retro" aria-hidden="true"></i></p>
                                                                <a href="#" class="item-hinh-hien">
                                                                <img class="img-responsive thumbnail" src="{!! asset('images/product/sanpham2.jpg') !!}" alt="...">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="mua-ban-row">
                                                                <a href="#">Media heading</a>
                                                                <span class="nguoi-dang-tin"><sup><i class="fa fa-check" aria-hidden="true"></i></sup></span>
                                                                <p class="item-tien-hien">2.590.000 đ</p>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <p class="item-tien-an">2.590.000 đ</p>
                                                                <p class="item-thoi-gian">6 phút trước</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row mua-ban-item">
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <p class="item-hinh-an">4 phút trước <i class="fa fa-camera-retro" aria-hidden="true"></i></p>
                                                                <a href="#" class="item-hinh-hien">
                                                                <img class="img-responsive thumbnail" src="{!! asset('images/product/sanpham2.jpg') !!}" alt="...">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="mua-ban-row">
                                                                <a href="#">Media heading</a>
                                                                <span class="nguoi-dang-tin"><sup><i class="fa fa-check" aria-hidden="true"></i></sup></span>
                                                                <p class="item-tien-hien">2.590.000 đ</p>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <p class="item-tien-an">2.590.000 đ</p>
                                                                <p class="item-thoi-gian">6 phút trước</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row mua-ban-item">
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <p class="item-hinh-an">4 phút trước <i class="fa fa-camera-retro" aria-hidden="true"></i></p>
                                                                <a href="#" class="item-hinh-hien">
                                                                <img class="img-responsive thumbnail" src="{!! asset('images/product/sanpham2.jpg') !!}" alt="...">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="mua-ban-row">
                                                                <a href="#">Media heading</a>
                                                                <span class="nguoi-dang-tin"><sup><i class="fa fa-check" aria-hidden="true"></i></sup></span>
                                                                <p class="item-tien-hien">2.590.000 đ</p>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="row">
                                                                <p class="item-tien-an">2.590.000 đ</p>
                                                                <p class="item-thoi-gian">6 phút trước</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- phân trang -->
                                                <nav>
                                                    <ul class="pagination">
                                                        <li>
                                                            <a href="#" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                        <li class="active"><a href="#">1</a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#">5</a></li>
                                                        <li>
                                                            <a href="#" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                            <!-- tất cả tin -->
                                            <div role="tabpanel" class="tab-pane" id="canhan">...</div>
                                            <div role="tabpanel" class="tab-pane" id="congty">...</div>
                                            <div role="tabpanel" class="tab-pane" id="settings">...</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end nội dung -->
                            <div class="col-md-12 rao-vat-cung-loai">
                                <div class="row">
                                    <h3>Tìm thêm các rao vặt khác tại Hà Nội</h3>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="item-rao-vat-cung-loai">
                                                        <p>Xe cộ</p>
                                                        <a href="">Xe máy</a>
                                                        <a href="">Ô tô</a>
                                                        <a href="">Xe đạp</a>
                                                        <a href="">Xe tải, Xe khác</a>
                                                        <a href="">Phụ tùng, Phụ kiện xe</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="item-rao-vat-cung-loai">
                                                        <p>Xe cộ</p>
                                                        <a href="">Xe máy</a>
                                                        <a href="">Ô tô</a>
                                                        <a href="">Xe đạp</a>
                                                        <a href="">Xe tải, Xe khác</a>
                                                        <a href="">Phụ tùng, Phụ kiện xe</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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