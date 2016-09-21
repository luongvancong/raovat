@extends('frontend.layout.chotot-default')
@section('title','Trang đăng tin')
@section('content')
    <!-- main -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-dang-tin">
                        <div class="col-md-12 dang-tin-top">
                            <div class="row">
                                <div class="circle circle_active">1</div>
                                <div class="step_des_active">Tạo tin <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                                <div class="circle circle_inactive">2</div>
                                <div class="step_des_active step_des_inactive">Kiểm tra lại <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                                <div class="circle circle_inactive">3</div>
                                <div class="step_des_active step_des_inactive">Xong <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 nhac-ban">
                            <div class="nhac-ban-title">
                                Nhắc bạn
                            </div>
                            <div class="nhac-ban-noi-dung">
                                <p>» Để đẩy tin lên trang đầu, hãy tạo tài khoản</p>
                                <p>» Miêu tả chi tiết sản phẩm: thương hiệu,tình trạng,phụ kiện đi kèm...</p>
                                <p>» Tin chỉ quảng cáo cho cửa hàng sẽ không được đăng.</p>
                                <p>» Đăng tin bằng tiếng Việt có dấu.</p>
                                <p>» Mỗi tin đăng chỉ rao bán một mặt hàng.</p>
                            </div>
                        </div>
                        <form class="form-horizontal" action="" name="frmDangtin" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            
                            <div class="col-md-12 dang-tin-header">
                                Nội dung tin <span>(Vui lòng điền đầy đủ tất cả các mục)</span>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="Chuyenmuc" class="col-sm-2 control-label">Chuyên mục:</label>
                                        <div class="col-sm-6">
                                            <select name="" id="chuyenmuc" class="form-control">
                                                <option value="" selected="selected">---Chọn danh mục---</option>
                                                {!! cate_parent($dataCate,0,"--",0) !!}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group {{ hasValidator('category_id') }}">
                                        <label for="Chuyenmuc" class="col-sm-2 control-label">Chuyên mục con:</label>
                                        <div class="col-sm-6">
                                            <select name="category_id" id="chuyenmuc-con" class="form-control">
                                                <option value="" selected="selected">---Chọn danh mục con---</option>
                                            </select>
                                            {!! alertError('category_id') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ hasValidator('city_id') }}">
                                        <label for="Vungmien" class="col-sm-2 control-label">Vùng:</label>
                                        <div class="col-sm-6">
                                            <select name="city_id" id="vungmien" class="form-control">
                                                <option value="">---Chọn vùng---</option>
                                                {!! city_parent($dataCity,0,"--",0) !!}
                                            </select>
                                            {!! alertError('city_id') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ hasValidator('district_id') }}">
                                        <label for="Vungmien" class="col-sm-2 control-label">Tỉnh, quận, huyện:</label>
                                        <div class="col-sm-6">
                                            <select id="district-id" name="district_id" class="form-control">
                                                <option value="">---Chọn tỉnh, thành, quận---</option>
                                            </select>
                                            {!! alertError('district_id') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ hasValidator('active') }}">
                                        <label for="" class="col-sm-2 control-label">Bạn đăng tin:</label>
                                        <div class="col-sm-6">
                                            <input type="radio" name="active" value="1" placeholder="" id="rd_canban" checked="">
                                            <label for="rd_canban">Cần bán</label>
                                            <input type="radio" name="active" value="2" placeholder="" id="rd_canmua">
                                            <label for="rd_canmua">Cần mua</label>
                                            {!! alertError('active') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ hasValidator('title') }}">
                                        <label for="Tuade" class="col-sm-2 control-label">Tựa đề:</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <span class="input-group-addon" id="basic-addon1">Cần bán:</span>
                                                <input type="text" class="form-control" name="title" value="{!! Request::old('title') !!}" placeholder="Dùng tiếng việt có dấu" aria-describedby="basic-addon1">
                                            </div>
                                            {!! alertError('title') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ hasValidator('content') }}">
                                        <label for="Noidungtin" class="col-sm-2 control-label">Nội dung tin:</label>
                                        <div class="col-sm-6">
                                            <textarea name="content" rows="5" class="form-control" id="Noidungtin" placeholder="Điền nội dung tin chi tiết bạn muốn rao bằng tiếng việt có dấu">{!! Request::old('content') !!}</textarea>
                                            {!! alertError('content') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ hasValidator('price') }}">
                                        <label for="Gia" class="col-sm-2 control-label">Giá:</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="price" value="{!! Request::old('price') !!}" aria-label="">
                                                <span class="input-group-addon">đ</span>
                                            </div>
                                            {!! alertError('price') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ hasValidator('post_images') }}">
                                        <label for="Hinh" class="col-sm-2 control-label">Hình:</label>
                                        <div class="col-sm-5">
                                            <div class="chon-hinh-tin">
                                                <div class="chon-hinh-top">
                                                    <p class="text-center">“Trăm nghe không bằng mắt thấy”. Tin có hình được xem nhiều gấp 7 lần.</p>
                                                    <p class="text-center"><b>Đăng hình để bán chạy hơn</b></p>
                                                </div>
                                                <div class="item-hinh-chon">
                                                    <input type="file" name="post_images[]" multiple="multiple" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div>
                                                {!! alertError('post_images') !!}
                                                {{-- <div class="item-hinh-chon">
                                                    <input type="file" name="post_images[]" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div>
                                                <div class="item-hinh-chon">
                                                    <input type="file" name="post_images[]" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div>
                                                <div class="item-hinh-chon">
                                                    <input type="file" name="post_images[]" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div>
                                                <div class="item-hinh-chon">
                                                    <input type="file" name="post_images[]" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div>
                                                <div class="item-hinh-chon">
                                                    <input type="file" name="post_images[]" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div> --}}
                                                <div class="chon-hinh-bottom">
                                                    <p class="text-center">Đăng nhiều hình thật nhanh bằng cách kéo và thả hình vào khung này hoặc nhấn nút phía trên rồi chọn nhiều hình cùng lúc</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 aiupload-right">
                                            <div class="triangle">&nbsp;</div>
                                            <span></span>
                                            <div class="aiupload-cloud">
                                                <span>Chỉ hình thật của sản phẩm mới được duyệt. Lưu ý không dùng hình có dán kèm số điện thoại hoặc địa chỉ website.</span>
                                                <img src="{!! asset('images/icon/nhacdanganh.png') !!}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Hình" class="col-sm-2 control-label">Cách thanh toán:</label>
                                        <div class="col-sm-6">
                                            Người bán và người mua tự thoả thuận
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Quytrinh" class="col-sm-2 control-label">Quy trình vận chuyển & giao nhận:</label>
                                        <div class="col-sm-6">
                                            <textarea name="van_chuyen" id="Quytrinh" class="form-control" rows="5">{!! Request::old('van_chuyen') !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 col-sm-offset-2">
                                            <button type="submit" class="btn btn-warning form-control">Tiếp tục <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! csrf_field() !!}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main -->
@endsection