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
                        <form class="form-horizontal" action method="post" accept-charset="utf-8">
                            <!-- <div class="col-md-12 dang-tin-header">
                                Thông tin liên hệ <span>(Vui lòng điền đầy đủ tất cả các mục)</span>
                            </div>
                            <div class="col-md-12 dang-tin-title">
                                Bạn đã từng bán với Chợ Tốt? <b>Dùng thông tin trước đây để điền nhanh hơn.</b>
                                <a href="" class="btn btn-success">Điền nhanh</a>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group ">
                                        <label for="Ten" class="col-sm-2 control-label">Tên:</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="Ten" name="name" placeholder="Tên" value="{{ Request::old('name') }}">

                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="Email" class="col-sm-2 control-label">E-mail:</label>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control" id="Email" name="email" placeholder="E-mail" value="{{ Request::old('email') }}">

                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="Sodienthoai" class="col-sm-2 control-label">Số điện thoại:</label>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control" id="Sodienthoai" name="phone" value="{{ Request::old('phone') }}" placeholder="Số điện thoại">

                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="Diachi" class="col-sm-2 control-label">Địa chỉ:</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="Diachi" name="address" value="{{ Request::old('address') }}" placeholder="Địa chỉ">

                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-12 dang-tin-header">
                                Nội dung tin <span>(Vui lòng điền đầy đủ tất cả các mục)</span>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group {{ hasValidator('category_id') }}">
                                        <label for="Chuyenmuc" class="col-sm-2 control-label">Chuyên mục:</label>
                                        <div class="col-sm-6">
                                            <select name="category_id" id="Chuyenmuc" class="form-control">
                                                <option value="0" selected="selected">---Chọn danh mục---</option>
                                                {!! cate_parent($dataCate,0,"--",0) !!}
                                            </select>
                                            {!! alertError('category_id') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ hasValidator('city_id') }}">
                                        <label for="Vungmien" class="col-sm-2 control-label">Vùng:</label>
                                        <div class="col-sm-6">
                                            <select name="city_id" id="Vungmien" class="form-control">
                                                <option value="0" selected="selected">---Chọn tỉnh thành---</option>
                                                {!! city_parent($dataCity,0,"--",0) !!}
                                            </select>
                                            {!! alertError('city_id') !!}
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
                                            <label for="">Bộ gõ:</label>
                                            <input type="radio" name="" value="" placeholder="" checked=""> Tự động
                                            <input type="radio" name="" value="" placeholder=""> TELEX
                                            <input type="radio" name="" value="" placeholder=""> VNI
                                            <input type="radio" name="" value="" placeholder=""> VIQR
                                            <input type="radio" name="" value="" placeholder=""> Tắt
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
                                    <div class="form-group">
                                        <label for="Hinh" class="col-sm-2 control-label">Hình:</label>
                                        <div class="col-sm-5">
                                            <div class="chon-hinh-tin">
                                                <div class="chon-hinh-top">
                                                    <p class="text-center">“Trăm nghe không bằng mắt thấy”. Tin có hình được xem nhiều gấp 7 lần.</p>
                                                    <p class="text-center"><b>Đăng hình để bán chạy hơn</b></p>
                                                </div>
                                                <div class="item-hinh-chon">
                                                    <input type="file" name="" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div>
                                                <div class="item-hinh-chon">
                                                    <input type="file" name="" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div>
                                                <div class="item-hinh-chon">
                                                    <input type="file" name="" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div>
                                                <div class="item-hinh-chon">
                                                    <input type="file" name="" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div>
                                                <div class="item-hinh-chon">
                                                    <input type="file" name="" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div>
                                                <div class="item-hinh-chon">
                                                    <input type="file" name="" value="" placeholder="">
                                                    <div class="item-hinh">
                                                        <div class="ai_camera">
                                                            <img src="{!! asset('images/icon/ai.png') !!}">
                                                        </div>
                                                        <span>Đăng hình</span>
                                                    </div>
                                                </div>
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
                                    <div class="form-group {{ hasValidator('van_chuyen') }}">
                                        <label for="Quytrinh" class="col-sm-2 control-label">Quy trình vận chuyển & giao nhận:</label>
                                        <div class="col-sm-6">
                                            <textarea name="van_chuyen" id="Quytrinh" class="form-control" rows="5">{!! Request::old('van_chuyen') !!}</textarea>
                                            {!! alertError('van_chuyen') !!}
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