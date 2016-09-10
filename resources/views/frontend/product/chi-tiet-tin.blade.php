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
                                <li><a href="{{ route('home-page') }}" title="chotot.com">chotot.com</a></li>
                                <li><a href="{!! url('danh-sach-tin/'.$city->getId()) !!}">{!! $city->getName() !!}</a></li>
                                <li><a href="{!! route('getDanhsachCityDistrict', [$city->getId(), $citydistrict->getID()]) !!}">{!! $citydistrict->getName() !!}</a></li>
                                <li><a href="{!! route('getDanhsachcategory', [$city->getId(), $category->getID()]) !!}">{!! $category->getName() !!}</a></li>
                                <li><a href="{!! route('getDanhsachcategorychild', [$city->getId(), $catechild->getID()]) !!}">{!! $catechild->getName() !!}</a></li>
                                <li class="active">{!! $post->getTitle() !!}</li>
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
                                <a href="#" title="trở lại kết quả" class="">Trở lại kết quả</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <h1>{!! $post->getTitle() !!}</h1>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="image-chi-tiet">
                                <div class="prev">
                                    <a title="previous" class="prevs"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                                </div>
                               <div class="image-carousel">
                                    @foreach($post->post_image as $key => $item_image)
                                    <div class="item-image">
                                        <img src="{!! asset('uploads/posts/'.$item_image['image']) !!}" class="img-responsive" title="{!! $item_image['image'] !!}" alt="{!! $post->getTitle() !!}">
                                    </div>
                                    @endforeach
                               </div>
                                <div class="next">
                                    <a title="next" class="nexts"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                </div>
                                <div class="gia-chi-tiet">
                                    <div class="gia">
                                        <span>Giá:</span><span><b>{!! format_number($post->getPrice()) !!}</b> đ</span>
                                    </div>
                                    <div class="loai-tin">
                                        <span>{!! $post->getDoiTime() !!} phút trước</span>
                                    </div>
                                </div>
                            </div>
                            <div class="chi-tiet-bottom">
                                <?php $i = 0; ?>
                                @foreach($post->post_image as $key => $item_image)
                                <div class="item-image-bottom" data-id-image="{!! $i !!}">
                                    <img src="{!! asset('uploads/posts/'.$item_image['image']) !!}" title="{!! $item_image['image'] !!}" alt="{!! $post->getTitle() !!}">
                                </div>
                                <?php $i = $i + 1; ?>
                                @endforeach
                                <div class="nguoi-duyet">
                                    <a href="" title="chợ tốt duyệt tin như thế nào"><i>Tin được duyệt bởi </i>Lê Khang</a>
                                    <img src="{!! asset('images/icon/member.png') !!}" alt="">
                                </div>
                            </div>
                            <div class="noi-dung-tin">
                                <!-- <p>Loại: <b>Xe đạp,Cần bán</b></p>
                                <p>Địa chỉ: <b>Đường láng Hà Nội</b></p>
                                <p>Tỉnh, thành, quận: <b>Quận Cầu Giấy</b></p>
                                <p>Tình trạng: <b>Đã sử dụng</b></p> -->
                                <p>{!! $post->getContent() !!}</p>
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
                                Liên hệ <a href="" title="người đăng tin">{!! $post->getChildUser->name !!}</a>
                            </div>
                            <a href="" title="chat với người bán" class="chat-nguoi-ban"><i class="fa fa-comments fa-lg" aria-hidden="true"></i> Chat với người bán</a>
                            <a href="" title="bấm để hiện số" class="gui-email-sdt" id="an-sdt"><i class="fa fa-phone fa-lg" aria-hidden="true"></i> Bấm để hiện số</a>
                            <p class="gui-email-sdt sdt-an">{!! $post->getChildUser->phone !!}</p>
                            <a href="" title="bấm để hiện số" class="gui-email-sdt" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i> Gửi email</a>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Liên hệ: {!! $post->getChildUser->name !!}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label for="inputName" class="col-sm-2 control-label">Tên tôi là</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputName" placeholder="Họ tên">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">E-mail của tôi</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="inputEmail3" placeholder="E-mail của tôi">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputSdt" class="col-sm-2 control-label">Số điện thoại</label>
                                                    <div class="col-sm-10">
                                                        <input type="number" class="form-control" id="inputSdt" placeholder="Số điện thoại">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="noidungtin" class="col-sm-2 control-label">Nội dung tin nhắn</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="" rows="7" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <div class="checkbox">
                                                            <label>
                                                            <input type="checkbox"> Gửi bản sao email của tôi
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" class="btn btn-warning">Gửi</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- end modal body -->
                                    </div>
                                </div>
                            </div>
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