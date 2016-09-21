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

/*load ajax category*/
$(document).ready(function() {
	$("#chuyenmuc").change(function(){
		var category_id = $(this).val();
		var url = "http://localhost:8080/dang-tin/ajax-get-catechild/" + category_id;
		var _token = $("form[name='frmDangtin']").find("input[name='_token']").val();
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			data: {"_token":_token,"category_id":category_id},
			success: function(result){
				$('#chuyenmuc-con').empty();
				for(var i = 0; i < result.length; i ++) {
					$('#chuyenmuc-con').append('<option value="'+ result[i].id +'">'+ result[i].name +'</option>')
				}
			}
		});
		//alert("dddd");
	});
});

/*load ajax city*/
$(document).ready(function() {
	$("#vungmien").change(function() {
		var city_id = $(this).val();
		var url = "http://localhost:8080/dang-tin/ajax-get-districts/" + city_id;
		var _token = $("form[name='frmDangtin']").find("input[name='_token']").val();
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			data: {"_token":_token,"city_id":city_id},
			success: function(result){
				$('#district-id').empty();
				for(var i = 0; i < result.length; i ++) {
					$('#district-id').append('<option value="'+ result[i].cit_id +'">'+ result[i].cit_name +'</option>')
				}
			}
		});
	});
});
/*load ajax city dang ky user*/
$(document).ready(function() {
	$("#vungmiens").change(function() {
		var city_id = $(this).val();
		var url = "http://localhost:8080/dang-ky/ajax-get-districts/" + city_id;
		//var _token = $("form[name='frmDangtin']").find("input[name='_token']").val();
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			//data: {"_token":_token,"city_id":city_id},
			success: function(result){
				$('#quanhuyen').empty();
				for(var i = 0; i < result.length; i ++) {
					$('#quanhuyen').append('<option value="'+ result[i].cit_id +'">'+ result[i].cit_name +'</option>')
				}
			}
		});
		//alert("dddd");
	});
});
/*category con ẩn hiện*/
$(document).ready(function() {
	$(".ctrl-cate").click(function(){
		$(this).next().next().toggle(500);
	});
});