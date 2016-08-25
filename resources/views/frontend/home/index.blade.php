@extends('frontend/layout/default')

@section('styles')
	<style>
		.bx-wrapper {
			max-width: 100% !important;
			width: 100% !important;
			border: 0 !important;
		}
		.bx-wrapper .item-container {
			/*width: inherit !important;*/
		}
	</style>
@stop

@section('content')

	{{-- Nav tabs products --}}
	@include('frontend/home/partials/product')

	{{-- TIN TUC & DANH GIA --}}
	@include('frontend/home/partials/news')

	<div class="row mg-t-30">
		{{-- RAO VAT --}}
		@include('frontend/home/partials/classifield')
		{{-- HOI DAP --}}
		@include('frontend/home/partials/question')
	</div>
	{{-- PHONE BLOCK --}}
	@include('frontend/home/partials/phone')

	{{-- Tablet BLOCK --}}
	@include('frontend/home/partials/tablet')

	{{-- Laptop BLOCK --}}
	@include('frontend/home/partials/laptop')

	{{-- Camera BLOCK --}}
	@include('frontend/home/partials/camera')

	{{-- VIDEO --}}
	@include('frontend/home/partials/video')

	{{-- CUA HANG MUA NHIEU --}}
	@include('frontend/home/partials/shop_hot')

	{{-- CUA HANG MOI NHAT --}}
	@include('frontend/home/partials/shop_newest')


@stop

@section('scripts')
	<script type="text/javascript">
		$(function() {

			var ProductSlider = function() {
				var __class = this;

				var windowWidth = $(window).width();
				var slideWidth = windowWidth; // Default for lg screen

				if(windowWidth >= 320) {
					slideWidth = windowWidth/1;
				}

				if(windowWidth >= 768) {
					slideWidth = 750/3
				}

				if(windowWidth >= 992) {
					slideWidth = 970/3;
				}

				if(windowWidth >= 1224) {
					slideWidth = 1170/4;
				}

				this.defaultOptionSlider = {
					slideWidth: slideWidth,
				    minSlides: 1,
				    maxSlides: 4,
				    slideMargin: 0,
				    pager: false,
				    controls: false,
				}

				this.hotProductSlider = null;
				this.newestProductSlider = null;

				this.initHotProductSlider = function() {
					var hotProductOwl = $(".hot.product-tab-carousel").bxSlider(this.defaultOptionSlider);

					__class.hotProductSlider = hotProductOwl;

					$(document).on('click', '.custom-control-slider-product.prev.hot', function() {
						hotProductOwl.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider-product.next.hot', function() {
						hotProductOwl.goToNextSlide();
					});

					return hotProductOwl;
				}

				this.reloadHotProductSlider = function() {
					__class.hotProductSlider.reloadSlider(__class.defaultOptionSlider);
				}

				this.initNewestProductSlider = function() {
					var newestProductOwl = $(".newest.product-tab-carousel").bxSlider(this.defaultOptionSlider);

					__class.newestProductSlider = newestProductOwl;

					$(document).on('click', '.custom-control-slider-product.prev.newest', function() {
						newestProductOwl.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider-product.next.newest', function() {
						newestProductOwl.goToNextSlide();
					});

					return newestProductOwl;
				}

				this.reloadNewestProductSlider = function() {
					__class.newestProductSlider.reloadSlider(__class.defaultOptionSlider);
				}

				this.initProductsHaveMoreShopSlider = function() {
					var newestProductOwl = $(".have-more-shop.product-tab-carousel").bxSlider(this.defaultOptionSlider);

					__class.productsHaveMoreShopSlider = newestProductOwl;

					$(document).on('click', '.custom-control-slider-product.prev.have-more-shop', function() {
						newestProductOwl.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider-product.next.have-more-shop', function() {
						newestProductOwl.goToNextSlide();
					});

					return newestProductOwl;
				}

				this.reloadProductsHaveMoreShopSlider = function() {
					__class.productsHaveMoreShopSlider.reloadSlider(__class.defaultOptionSlider);
				}


				this.initProductsHaveMostQuestionSlider = function() {
					var slider = $(".care.product-tab-carousel").bxSlider(this.defaultOptionSlider);

					__class.productsHaveMostQuestionSlider = slider;

					$(document).on('click', '.custom-control-slider-product.prev.care', function() {
						slider.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider-product.next.care', function() {
						slider.goToNextSlide();
					});

					return slider;
				}

				this.reloadProductsHaveMostQuestionSlider = function() {
					__class.productsHaveMostQuestionSlider.reloadSlider(__class.defaultOptionSlider);
				}


				this.initProductsHaveChangePriceSlider = function() {
					var slider = $(".have-change-price.product-tab-carousel").bxSlider(this.defaultOptionSlider);

					__class.ProductsHaveChangePriceSlider = slider;

					$(document).on('click', '.custom-control-slider-product.prev.have-change-price', function() {
						slider.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider-product.next.have-change-price', function() {
						slider.goToNextSlide();
					});

					return slider;
				}

				this.reloadProductsHaveChangePriceSlider = function() {
					__class.ProductsHaveChangePriceSlider.reloadSlider(__class.defaultOptionSlider);
				}

				this.initPhoneSlider = function() {
					var slider = $("#phone-slider").bxSlider(this.defaultOptionSlider);

					$(document).on('click', '.custom-control-slider-product.prev.phone', function() {
						slider.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider-product.next.phone', function() {
						slider.goToNextSlide();
					});
				}

				this.initTabletSlider = function() {
					var slider = $("#tablet-slider").bxSlider(this.defaultOptionSlider);

					$(document).on('click', '.custom-control-slider-product.prev.tablet', function() {
						slider.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider-product.next.tablet', function() {
						slider.goToNextSlide();
					});
				}

				this.initLaptopSlider = function() {
					var slider = $("#laptop-slider").bxSlider(this.defaultOptionSlider);

					$(document).on('click', '.custom-control-slider-product.prev.laptop', function() {
						slider.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider-product.next.laptop', function() {
						slider.goToNextSlide();
					});
				}

				this.initCameraSlider = function() {
					var slider = $("#camera-slider").bxSlider(this.defaultOptionSlider);

					$(document).on('click', '.custom-control-slider-product.prev.camera', function() {
						slider.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider-product.next.camera', function() {
						slider.goToNextSlide();
					});
				}

				this.init = function() {
					this.initHotProductSlider();
					this.initNewestProductSlider();
					this.initProductsHaveMoreShopSlider();
					this.initProductsHaveChangePriceSlider();
					this.initProductsHaveMostQuestionSlider();
					// this.initPhoneSlider();
					// this.initTabletSlider();
					// this.initLaptopSlider();
					// this.initCameraSlider();
				}
			}

			var TopSlider = function() {

				this.init = function() {
					this.initSlider();
				}

				this.initSlider = function() {
					$('#home-slider').owlCarousel({
						items : 1,
						nav : true,
						navText : ["&larr;","&rarr;"],
						// autoplay: true,
						loop : true,
						center : true
					});
				}

			}

			var ShopSlider = function() {
				var __class = this;

				var windowWidth = $(window).width();
				var slideWidth = windowWidth; // Default for lg screen

				if(windowWidth >= 320) {
					slideWidth = windowWidth/3;
				}

				if(windowWidth >= 768) {
					slideWidth = 750/6
				}

				if(windowWidth >= 992) {
					slideWidth = 970/6;
				}

				if(windowWidth >= 1224) {
					slideWidth = 1170/6;
				}

				this.defaultOptionSlider = {
					slideWidth: slideWidth,
				    minSlides: 4,
				    maxSlides: 6,
				    slideMargin: 0,
				    pager: false,
				    controls: false,
				    onSliderLoad : function() {
				    	$('#shop-hot-slider').parents('.bx-viewport').css('height', 'auto');
				    	$('#shop-newest-slider').parents('.bx-viewport').css('height', 'auto');
				    }
				}

				this.hotShopSlider = null;
				this.newestShopSlider = null;

				this.initHotShopSlider = function() {
					var slider = $("#shop-hot-slider").bxSlider(__class.defaultOptionSlider);

					__class.hotShopSlider = slider;

					$(document).on('click', '.custom-control-slider.shop.prev.hot', function() {
						slider.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider.shop.next.hot', function() {
						slider.goToNextSlide();
					});
				}

				this.initNewestShopSlider = function() {
					var slider = $("#shop-newest-slider").bxSlider(__class.defaultOptionSlider);

					__class.newestShopSlider = slider;

					$(document).on('click', '.custom-control-slider.shop.prev.newest', function() {
						slider.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider.shop.next.newest', function() {
						slider.goToNextSlide();
					});
				}

				this.reloadHotShopSlider = function() {
					__class.hotShopSlider.reloadSlider(__class.defaultOptionSlider);
				}

				this.reloadNewestShopSlider = function() {
					__class.newestShopSlider.reloadSlider(__class.defaultOptionSlider);
				}

				this.init = function() {
					__class.initHotShopSlider();
					__class.initNewestShopSlider();
				}
			}


			var topSlider = new TopSlider();
			topSlider.init();

			var productSlider = new ProductSlider();
			productSlider.init();

			var shopSlider = new ShopSlider();
			shopSlider.init();

			var DeviceSlider = function() {
				var __class = this;

				var windowWidth = $(window).width();
				var slideWidth = windowWidth; // Default for lg screen

				if(windowWidth >= 320) {
					slideWidth = windowWidth/1;
				}

				if(windowWidth >= 768) {
					slideWidth = 750/3
				}

				if(windowWidth >= 992) {
					slideWidth = 970/3;
				}

				if(windowWidth >= 1224) {
					slideWidth = 1170/4;
				}

				this.defaultOptionSlider = {
					slideWidth: slideWidth,
				    minSlides: 1,
				    maxSlides: 4,
				    slideMargin: 0,
				    pager: false,
				    controls: false,
				}

				// Cache slider
				this.cache = {
					slider : {}
				};

			}

			DeviceSlider.prototype = {
				init : function(type, device) {
					var slider = $(".device-carousel." + type + '.' + device).bxSlider(this.defaultOptionSlider);
					// console.log(".device-carousel." + type + '.' + device);
					this.cache.slider[type + '_' + device] = slider;

					$(document).on('click', '.custom-control-slider-product.' + device + '.prev.' + type, function() {
						slider.goToPrevSlide();
					});

					$(document).on('click', '.custom-control-slider-product.' + device + '.next.' + type, function() {
						slider.goToNextSlide();
					});
				},

				reload : function(type, device) {
					this.cache.slider[type + '_' + device].reloadSlider(this.defaultOptionSlider);
				}
			}



			// Tab product
			$('.navtab-head').click(function(e) {
				e.preventDefault();
				var $this = $(this);
				$this.tab('show');

				productSlider.reloadNewestProductSlider();
				productSlider.reloadHotProductSlider();
				productSlider.reloadProductsHaveMoreShopSlider();
				productSlider.reloadProductsHaveChangePriceSlider();
				productSlider.reloadProductsHaveMostQuestionSlider();

				// Danh dau control cua tab nao
				$('#homepage-navtab-ul').find('.custom-control-slider-product').removeClass('hot newest have-more-shop have-change-price').addClass($this.data('type'));
			});

			var deviceSlider = new DeviceSlider();

			$('.navtab-item').each(function() {
				deviceSlider.init($(this).data('type'), $(this).data('device'));
			});

			$('.navtab-item').click(function(e) {
				e.preventDefault();
				var $this = $(this);
				$this.tab('show');

				var device = $this.data('device');
				var type   = $this.data('type');

				deviceSlider.reload(type, device);

				// Danh dau control cua tab nao
				$('.custom-control-slider-product.' + device).removeClass('hot newest care have-more-shop have-change-price').addClass(type);
			});


			$('.shop-tab').click(function(e) {
				e.preventDefault();
				var $this = $(this);
				$this.tab('show');
				shopSlider.reloadNewestShopSlider();

				// Danh dau control cua tab nao
				$('#shop-navtab-ul').find('.custom-control-slider').removeClass('hot newest').addClass($this.data('type'));
			});


			// Video slider
			$('#video-slider-flex').flexslider({
		      	animation: "slide",
			    animationLoop: false,
			    itemWidth: 210,
			    itemMargin: 5,
			    minItems: 3,
			    maxItems: 4
		    });

		});
	</script>
@stop