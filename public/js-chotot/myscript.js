/*$(document).ready(function() {
	$('.form-log').click(function(event){
		event.preventDefault();
		$('.dangnhap-dangky').hide();
		$($(this).data('id')).show();
	});
});*/
/*đăng nhập đăng ký*/
/*sản phẩm mua bán*/
$(document).ready(function() {
	$(window).resize(function(){
	    var width = $(window).width();
	    console.log(width);
	    if (width <= 768){
	        $('.mua-ban-row').addClass('row');
	    }
	    else{
	        $('.mua-ban-row').removeClass('row');
	    }
	});
});
/*xem hiện hình nhỏ*/
$(document).ready(function() {
	$('.an-hinh-nho').click(function(event){
		event.preventDefault();
		 $('.mua-ban-item').addClass('mua-ban-item-an-hinh');
	});
	$('.xem-hinh-nho').click(function(event){
		event.preventDefault();
		 $('.mua-ban-item').removeClass('mua-ban-item-an-hinh');
	});
});
/*xóa tin đăng top*/
$(document).ready(function() {
	$('.xoa-tin-dang-top').click(function(){
		$('.tin-dang-top').hide();
	})
});
/*hiện số điện thoại*/
$(document).ready(function() {
	$('#an-sdt').click(function(event){
		event.preventDefault();
		$('#an-sdt').hide();
		$('.sdt-an').show();
	});
});
/*slider chi tiết tin*/
$(document).ready(function() {
	var owl = $(".image-carousel");
	owl.owlCarousel({
	    loop:true,
	    margin:10,
	    /*nav:true,*/
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	});
	$(".nexts").click(function(){
	  owl.trigger('next.owl.carousel');
	});
	$(".prevs").click(function(){
	  owl.trigger('prev.owl.carousel');
	});
});
/*hover ảnh*/
$(document).ready(function() {
	$(".item-image-bottom").hover(function() {
		$('.item-image').trigger('to.owl.carousel', $(this).data('id-image'));
	});
});