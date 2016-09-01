@extends('frontend/layout/chotot-default')
@section('title','Chi tiết tin')
@section('content')
    <!-- main -->
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12 chi-tiet-tin">
                    <div class="col-md-9">
                        <div class="row">
                            <ol class="sua-ol">
                                <li><a href="#" title="chotot.com">chotot.com</a></li>
                                <li><a href="#">Hà Nội</a></li>
                                <li><a href="#">Quận Hai Bà Trưng</a></li>
                                <li><a href="#">Điện thoại di động</a></li>
                                <li class="active">Sony Z3 QT 100%</li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="row">
                            <div class="tin-tiep-theo">
                                <a href="" title="tin tiếp theo" >Tin tiếp theo</a>
                                <div class="tam-giac-phai"></div>
                            </div>
                            <div class="tro-lai-ket-qua">
                                <div class="tam-giac-trai" title=""></div>
                                <a href="" title="trở lại kết quả" class="">Trở lại kết quả</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <h1>Sony Z3 QT 100%</h1>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="image-chi-tiet">
                                <div class="prev">
                                    <a title="previous" class="prevs"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                                </div>
                               <div class="image-carousel">
                                    <div class="item-image">
                                        <img src="{!! asset('images/product/anh1.jpg') !!}" class="img-responsive" alt="anh_1">
                                    </div>
                                    <div class="item-image">
                                        <img src="{!! asset('images/product/anh2.jpg') !!}" class="img-responsive" alt="anh_2">
                                    </div>
                                    <div class="item-image">
                                        <img src="{!! asset('images/product/anh1.jpg') !!}" class="img-responsive" alt="anh_1">
                                    </div>
                               </div>
                                <div class="next">
                                    <a title="next" class="nexts"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                </div>
                                <div class="gia-chi-tiet">
                                    <div class="gia">
                                        <span>Giá:</span><span><b>1.600.000</b> đ</span>
                                    </div>
                                    <div class="loai-tin">
                                        <span>Tin công ty, đăng 31 phút trước</span>
                                    </div>
                                </div>
                            </div>
                            <div class="chi-tiet-bottom">
                                <div class="item-image-bottom" data-id-image="0">
                                    <img src="{!! asset('images/product/anh1.jpg') !!}" alt="anh_1">
                                </div>
                                <div class="item-image-bottom" data-id-image="1">
                                    <img src="{!! asset('images/product/anh2.jpg') !!}" alt="anh_2">
                                </div>
                                <div class="item-image-bottom" data-id-image="2">
                                    <img src="{!! asset('images/product/anh1.jpg') !!}" alt="anh_1">
                                </div>
                                <div class="nguoi-duyet">
                                    <a href="" title="chợ tốt duyệt tin như thế nào"><i>Tin được duyệt bởi </i>Văn Tâm</a>
                                    <img src="{!! asset('images/icon/member.png') !!}" alt="">
                                </div>
                            </div>
                            <div class="noi-dung-tin">
                                <p>Loại: <b>Xe đạp,Cần bán</b></p>
                                <p>Địa chỉ: <b>Đường láng Hà Nội</b></p>
                                <p>Tỉnh, thành, quận: <b>Quận Cầu Giấy</b></p>
                                <p>Tình trạng: <b>Đã sử dụng</b></p>
                                <p>Cu nhà không đi nữa mới 98% nay để lại cho bạn nào có nhu cầu mua cho cháu nhà. Xe đảm bảo còn mới nguyên chưa thay sửa gì. Vậy ai có nhu cầu thì gọi nhá.</p>
                                <hr>
                            </div>
                            <div class="chia-se-tin">
                                <span class="share_message">Chia sẻ tin này</span>
                                <div class="fb-like" data-href="https://chotot/chi-tiet-tin.html" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                            </div>
                            <form class="form-inline">
                                <div class="form-group">
                                    <label class="sr-only" for="tennguoiduocgui">Tên người được gửi</label>
                                    <input type="text" class="form-control" id="tennguoiduocgui" placeholder="Tên người được gửi">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="guitoiemail">Gửi tới địa chỉ Email</label>
                                    <input type="email" class="form-control" id="guitoiemail" placeholder="Gửi tới địa chỉ Email">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="guitoiemail">Lời nhắn (không bắt buộc)</label>
                                    <input type="text" class="form-control" id="guitoiemail" placeholder="Lời nhắn (không bắt buộc)">
                                </div>
                                <button type="submit" class="btn btn-warning">Gửi</button>
                            </form>
                            <div class="thong-bao">
                                <p>Chợ Tốt kiểm duyệt toàn bộ tin trước khi đăng để việc mua bán an toàn & hiệu quả hơn. Tuy nhiên, quá trình duyệt tin chỉ có thể hạn chế tối đa các trường hợp không trung thực. Hãy báo cho chúng tôi những tin xấu để chúng tôi có thể xác minh & xây dựng trang web mua bán an toàn nhất cho người Việt.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lien-he-chat">
                            <div class="arrow1"></div>
                            <div class="arrow2"></div>
                            <div class="lien-he-nguoi-ban">
                                Liên hệ <a href="" title="người đăng tin">Lê Khang</a>
                            </div>
                            <a href="" title="chat với người bán" class="chat-nguoi-ban"><i class="fa fa-comments fa-lg" aria-hidden="true"></i> Chat với người bán</a>
                            <a href="" title="bấm để hiện số" class="gui-email-sdt" id="an-sdt"><i class="fa fa-phone fa-lg" aria-hidden="true"></i> Bấm để hiện số</a>
                            <p class="gui-email-sdt sdt-an">01662870489</p>
                            <a href="" title="bấm để hiện số" class="gui-email-sdt"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i> Gửi email</a>
                        </div>
                        <div class="mua-hang-an-toan">
                            <span><b>MUA HÀNG AN TOÀN</b></span>
                            <ul>
                                <li>KHÔNG trả tiền trước khi nhận hàng.</li>
                                <li>Kiểm tra hàng cẩn thận, đặc biệt với hàng đắt tiền.</li>
                                <li>Hẹn gặp ở nơi công cộng.</li>
                                <li>Nếu bạn mua hàng hiệu, hãy gặp mặt tại cửa hàng để nhờ xác minh, tránh mua phải hàng giả.</li>
                                <li>Tìm hiểu thêm về <a href="" title="an toàn mua bán">An toàn mua bán</a>.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main -->
@endsection