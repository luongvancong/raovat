@extends('frontend/layout/chotot-default')
@section('title','Trang chủ')
@section('content')
<!-- main -->
<div class="main">
    <div class="container">
        <div class="row">
            <div class="main-content">
                <div class="col-md-6 main-left">
                    <span><h1>Chợ rao vặt miễn phí của người Việt!</h1>Hàng ngàn món hời được rao mỗi ngày...</span>
                    <div class="show-casing-box">
                        <ul>
                            <li><a href="" title="Đồ thể thao, Dã ngoại"><img src="{!! asset('images/product/anh1.jpg') !!}" alt="Đồ thể thao, Dã ngoại"></a></li>
                            <li><a href="" title="Đồ thể thao, Dã ngoại"><img src="{!! asset('images/product/anh1.jpg') !!}" alt="Đồ thể thao, Dã ngoại"></a></li>
                            <li><a href="" title="Đồ thể thao, Dã ngoại"><img src="{!! asset('images/product/anh1.jpg') !!}" alt="Đồ thể thao, Dã ngoại"></a></li>
                            <li><a href="" title="Đồ thể thao, Dã ngoại"><img src="{!! asset('images/product/anh1.jpg') !!}" alt="Đồ thể thao, Dã ngoại"></a></li>
                            <li><a href="" title="Đồ thể thao, Dã ngoại"><img src="{!! asset('images/product/anh1.jpg') !!}" alt="Đồ thể thao, Dã ngoại"></a></li>
                            <li><a href="" title="Đồ thể thao, Dã ngoại"><img src="{!! asset('images/product/anh1.jpg') !!}" alt="Đồ thể thao, Dã ngoại"></a></li>
                            <li><a href="" title="Đồ thể thao, Dã ngoại"><img src="{!! asset('images/product/anh1.jpg') !!}" alt="Đồ thể thao, Dã ngoại"></a></li>
                            <li><a href="" title="Đồ thể thao, Dã ngoại"><img src="{!! asset('images/product/anh1.jpg') !!}" alt="Đồ thể thao, Dã ngoại"></a></li>
                            <li><a href="" title="Đồ thể thao, Dã ngoại"><img src="{!! asset('images/product/anh1.jpg') !!}" alt="Đồ thể thao, Dã ngoại"></a></li>
                            <li><a href="" title="Đồ thể thao, Dã ngoại"><img src="{!! asset('images/product/anh1.jpg') !!}" alt="Đồ thể thao, Dã ngoại"></a></li>
                        </ul>
                    </div>
                    <div class="arrow-box">
                        <i>Nhờ có Chợ Tốt mình đã nhận được nhìu hơn sự quan tậm của khánh hàng . Chúc chợ tốt ngày càng phát triển</i>
                        <br>
                        <b>- giahuy (Cửa Hàng Đồ gia dụng)</b>
                        <div class="arrow-box1"></div>
                        <div class="arrow-box2"></div>
                    </div>
                    <a href="" class="why-love">♥ Chia sẻ vì sao bạn thích Chotot.com!</a>
                    <div class="like-share">
                        
                    </div>
                </div>
                <!-- map -->
                <div class="col-md-3 hidden-xs map">
                    <div id="map-map" class="vn-map">
                        <img src="">
                        <img src="" id="area-map" usemap="#map-map-map">
                    </div>
                    <map name="map-map-map" id="map-map-map">
    
                        <area shape="poly" id="hoverregion_12" onclick="return startpage_set_default_ca(12, '.chotot.com', true);" coords="124,87,113,82,122,75,133,84,216,115,239,131,223,166,194,161,181,138" href="https://www.chotot.com/ha-noi/mua-ban/" alt="Hà Nội" title="Hà Nội">
                    
                        <area shape="poly" id="hoverregion_13" onclick="return startpage_set_default_ca(13, '.chotot.com', true);" coords="156,422,37,374,29,319,87,323,87,357" href="https://www.chotot.com/tp-ho-chi-minh/mua-ban/" alt="Tp Hồ Chí Minh" title="Tp Hồ Chí Minh">
                    
                        <area shape="poly" id="hoverregion_10" onclick="return startpage_set_default_ca(10, '.chotot.com', true);" coords="75,24,82,40,91,46,103,64,114,66,134,78,141,74,156,75,171,63,150,45,143,35,154,25,144,18,134,20,129,15,122,18,103,2,89,12,89,20" href="https://www.chotot.com/dong-bac-bo/mua-ban/" alt="Đông Bắc Bộ" title="Bắc Kạn,Bắc Giang,Cao Bằng,Hà Giang,Lạng Sơn,Thái Nguyên,Tuyên Quang,Quảng Ninh">
                    
                        <area shape="poly" id="hoverregion_11" onclick="return startpage_set_default_ca(11, '.chotot.com', true);" coords="23,59,36,58,19,74,37,95,60,96,71,85,87,94,96,91,89,74,98,56,86,44,77,35,69,20,60,29,47,21,45,28,37,23,31,36,13,25,3,35" href="https://www.chotot.com/tay-bac-bo/mua-ban/" alt="Tây Bắc Bộ" title="Điện Biên,Lai Châu,Lào Cai,Sơn La,Yên Bái">
                    
                        <area shape="poly" id="hoverregion_1" onclick="return startpage_set_default_ca(1, '.chotot.com', true);" coords="114,101,130,98,130,90,114,86,115,77,121,75,130,83,135,77,112,67,103,66,97,61,89,76,96,94" href="https://www.chotot.com/cac-tinh-lan-can-ha-noi/mua-ban/" alt="Các tỉnh lân cận Hà Nội" title="Bắc Ninh,Phú Thọ,Hà Nam,Hải Dương,Hòa Bình,Hưng Yên,Ninh Bình,Vĩnh Phúc">
                    
                        <area shape="poly" id="hoverregion_4" onclick="return startpage_set_default_ca(4, '.chotot.com', true);" coords="115,103,132,99,134,80,160,73,171,65,187,61,185,87,162,95,150,89,147,110,129,115" href="https://www.chotot.com/hai-phong-nam-dinh-thai-binh/mua-ban/" alt="Hải Phòng Nam Định Thái Bình" title="Hải Phòng,Nam Định,Thái Bình">
                    
                        <area shape="poly" id="hoverregion_8" onclick="return startpage_set_default_ca(8, '.chotot.com', true);" coords="85,97,71,97,81,106,96,110,93,118,83,121,59,125,65,137,57,138,101,162,101,174,115,184,126,179,129,186,140,183,115,149,129,112,95,95,91,93" href="https://www.chotot.com/thanh-nghe-tinh/mua-ban/" alt="Thanh Nghệ Tĩnh" title="Hà Tĩnh,Nghệ An,Thanh Hóa">
                    
                        <area shape="poly" id="hoverregion_6" onclick="return startpage_set_default_ca(6, '.chotot.com', true);" coords="115,184,121,199,140,209,149,234,155,232,168,250,180,245,185,248,195,239,149,200,142,184,131,186,124,179" href="https://www.chotot.com/binh-tri-thua-thien-hue/mua-ban/" alt="Bình Trị Thừa Thiên Huế" title="Quảng Bình,Quảng Trị,Thừa Thiên Huế">
                    
                        <area shape="poly" id="hoverregion_3" onclick="return startpage_set_default_ca(3, '.chotot.com', true);" coords="254,256,256,236,290,233,295,262,278,279,254,259,225,289,211,291,178,267,164,258,165,251,174,244,195,239,210,257,224,274,225,288" href="https://www.chotot.com/quang-nam-da-nang/mua-ban/" alt="Quảng Nam Đà Nẵng" title="Đà Nẵng,Quảng Nam">
                    
                        <area shape="poly" id="hoverregion_9" onclick="return startpage_set_default_ca(9, '.chotot.com', true);" coords="178,267,174,281,165,308,179,333,175,348,175,367,165,374,171,388,169,390,177,401,195,405,199,392,208,392,211,362,220,356,208,343,215,340,209,305,209,290,201,281,193,281" href="https://www.chotot.com/tay-nguyen/mua-ban/" alt="Tây Nguyên" title="Đắk Lắk,Đắk Nông,Gia Lai,Kon Tum,Lâm Đồng">
                    
                        <area shape="poly" id="hoverregion_7" onclick="return startpage_set_default_ca(7, '.chotot.com', true);" coords="293,383,295,417,217,457,214,429,261,400,294,385,229,293,211,293,216,340,212,344,220,357,213,362,210,392,178,403,177,429,227,401,238,352,227,290" href="https://www.chotot.com/nam-trung-bo/mua-ban/" alt="Nam Trung Bộ" title="Bình Thuận,Bình Định,Khánh Hòa,Ninh Thuận,Phú Yên,Quảng Ngãi">
                    
                        <area shape="poly" id="hoverregion_2" onclick="return startpage_set_default_ca(2, '.chotot.com', true);" coords="141,381,136,392,122,391,147,414,155,408,159,414,152,422,169,434,178,431,174,415,175,400,168,390,165,377,167,370,145,379" href="https://www.chotot.com/dong-nam-bo/mua-ban/" alt="Đông Nam Bộ" title="Bình Dương,Bình Phước,Đồng Nai,Tây Ninh,Bà Rịa Vũng Tàu">
                    
                        <area shape="poly" id="hoverregion_5" onclick="return startpage_set_default_ca(5, '.chotot.com', true);" coords="135,415,89,420,51,433,75,450,96,446,82,462,83,497,129,478,155,495,165,431" href="https://www.chotot.com/can-tho-tay-nam-bo/mua-ban/" alt="Cần Thơ - Tây Nam Bộ" title="An Giang,Bạc Liêu,Bến Tre,Cần Thơ,Cà Mau,Đồng Tháp,Hậu Giang,Kiên Giang,Long An,Sóc Trăng,Tiền Giang,Trà Vinh,Vĩnh Long">
                    
                    </map>
                </div>
                <!-- end map -->
                <div class="col-md-3 main-right">
                    <div class="right-head">
                        <span><i>Hãy chọn vùng bạn ở để</i></span><br>
                        <span><i>tìm món hời gần nhà...</i></span>
                    </div>
                    <div class="menu-right">
                        <ul>
                            <li><a id="region-12" href="#" title="Hà Nội">Hà Nội</a></li>
                            <li><a id="region-13" href="#" title="Tp Hồ Chí Minh">Tp Hồ Chí Minh</a></li>
                            <li><a id="region-10" href="#" title="Đông Bắc Bộ">Đông Bắc Bộ</a></li>
                            <li><a id="region-11" href="#" title="Tây Bắc Bộ">Tây Bắc Bộ</a></li>
                            <li><a id="region-1" href="#" title="Các tỉnh lân cận Hà Nội">Các tỉnh lân cận Hà Nội</a></li>
                            <li><a id="region-4" href="#" title="Hải Phòng Nam Định Thái Bình">Hải Phòng Nam Định Thái Bình</a></li>
                            <li><a id="region-8" href="#" title="Thanh Nghệ Tĩnh">Thanh Nghệ Tĩnh</a></li>
                            <li><a id="region-6" href="#" title="Bình Trị Thừa Thiên Huế">Bình Trị Thừa Thiên Huế</a></li>
                            <li><a id="region-3" href="#" title="Quảng Nam Đà Nẵng">Quảng Nam Đà Nẵng</a></li>
                            <li><a id="region-9" href="#" title="Tây Nguyên">Tây Nguyên</a></li>
                            <li><a id="region-7" href="#" title="Nam Trung Bộ">Nam Trung Bộ</a></li>
                            <li><a id="region-2" href="#" title="Đông Nam Bộ">Đông Nam Bộ</a></li>
                            <li><a id="region-5" href="#" title="Cần Thơ - Tây Nam Bộ">Cần Thơ - Tây Nam Bộ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 main-bottom">
                    <h2><a href="" title="mua bán rao vặt">Mua bán rao vặt</a> Chotot.com</h2>
                    <p><a href="" title="chợ tốt">Chotot.com </a>là trang web <b><a href="" title="mua bán rao vặt">mua bán rao vặt</a></b> cho phép người mua và người bán kết nối và giao dịch an toàn, dễ dàng trong một môi trường tiện lợi và rõ ràng. Ở Chotot.com, bất kỳ ai cũng có thể đăng tin rao vặt miễn phí ngay, không cần phải đăng ký tài khoản. Trang web hỗ trợ tìm kiếm nhanh các mẫu đăng tin rao vặt vô cùng nhanh chóng ở tất cả các danh mục khác nhau từ bất động sản, điện thoại, xe máy, vật nuôi và còn nhiều hơn nữa.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end main -->
@endsection