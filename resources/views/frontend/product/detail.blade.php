@extends('frontend/layout/default')

@section('styles')
	<!-- Add fancyBox -->
	<link rel="stylesheet" href="/js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
	<style>
		.img-responsive.opponent-crop > img {
			width: auto !important;
		}
		#map {
			height: 400px;
		}
		#header {
			position: relative !important;
		}
		.other-info .count-shop {
			cursor: pointer;
		}
	</style>
	<link rel="stylesheet" href="/bower_components/flexslider/flexslider.css">
@stop

@section('content')

<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "{{ $product->getName() }}",
  "image": "http://{{ getServerName() . $product->getImage() }}",
  "description": "Đây là thông tin chi tiết về sản phẩm {{ $product->getName() }}",
  "mpn": "{{ $product->getId() }}",
  "brand": {
    "@type": "Thing",
    "name": "{{ $product->brand()->first() ? $product->brand()->first()->getName() : $product->getBrand() }}"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "{{ $product->fakeRatingValue() }}",
    "reviewCount": "{{ $product->fakeTotalRating() }}"
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "VND",
    "price": "{{ $product->getPriceStr() }}",
    "priceValidUntil": "{{ date('Y-m-d', strtotime($product->updated_at)) }}",
    "itemCondition": "http://schema.org/UsedCondition",
    "availability": "http://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "Giaca.org"
    }
  },
  "review": {
    "@type": "Review",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "{{ $product->fakeRatingValue() }}"
    },
    "name": "{{ $product->getName() }}",
    "author": {
      "@type": "Organization",
      "name": "Giaca.org"
    },
    "datePublished": "{{ date('Y-m-d', strtotime($product->updated_at)) }}",
    "reviewBody": "Tôi thực sự hài lòng khi sử dụng website để so sánh giá sản phẩm {{ $product->getName() }}",
    "publisher": {
      "@type": "Organization",
      "name": "Giaca.org"
    }
  }
}
</script>

<div id="product-detail-page">

	<div id="breadcrumb">
		<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
			{!! getBreadcrumbItem('Trang chủ', '/') !!}
			@if(is_object($product->brand()->first()))
			{!! getBreadcrumbItem($product->brand()->first()->getName(), route('product.brand', [$product->getBrand()])) !!}
			@else
			{!! getBreadcrumbItem($product->getBrand(), route('product.brand', [$product->getBrand()])) !!}
			@endif
			{!! getBreadcrumbItem($product->getName(), '/', true) !!}
		</ol>
	</div>

	<section id="infomations-main" class="box-product box-product-topOuter pd-bt-20">
		<div class="row">
			<div class="col-sm-12">
				@include('frontend/product/includes/functions')
			</div>
			<div class="col-sm-5 text-center">
				<div class="product-img">
					<span style="background: url({{ $product->getImage() }}) center center no-repeat; display: block; overflow: hidden; height: 350px; margin: auto;"></span>
				</div>
				<div class="pdt-small-img">
					<ul class="list-unstyled text-center">
						@foreach($productImagesSmall as $key => $img)
							<li style="display: inline-block">
								<a href="{{ isset($productImagesFull[$key]) ? $productImagesFull[$key] : '#' }}" class="simg-link fancybox" rel="gallery1">
									<img src="{{ $img }}" class="simg-img" alt="{{ $product->getName() }} - Ảnh số {{ $key }}">
								</a>
							</li>
						@endforeach
						<li class="clearfix"></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-7 pdt-infomation">
				{!! $product->presenter()->getItemInformation(['hide_btn_detail' => true, 'tag_title' => 'h1', 'page_is' => 'product_detail']) !!}
			</div>
		</div>
	</section>


	<section id="prices" class="box-product">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-head">
					<span class="page-head-block">So sánh giá</span>
					<div class="clearfix"></div>
				</h3>
			</div>
		</div>
		<div class="metadata-desc viewmore">
			<div class="sort-container pd-t-10 mg-bt-20">
				<div class="pull-left">
					<select class="btn-action-sort sort-control input-sm produc-detail form-control btn-flat">
						<option value="">Sắp xếp theo:</option>
						<option value="1">Mới nhất</option>
						<option value="2">Cũ nhất</option>
						<option value="5">Giá tăng dần</option>
						<option value="6">Giá giảm dần</option>
					</select>
				</div>
				<div class="clearfix"></div>
			</div>

			{{-- DISPLAY SHOP ADS --}}
			@include('frontend/product/includes/shop_ads')

			<div id="info-prices-table">
				{{-- BẢNG SO SANH GIÁ --}}
				{{-- @include('frontend/product/includes/prices_table') --}}
			</div>
		</div>
		<div class="row">
			<div id="table-prices-pagination" class="col-sm-12">

			</div>
			<div class="col-sm-12 text-center">
				<div id="table-prices-loading" class="hide">Đang tải <i class="fa fa-spin fa-spinner"></i></div>
				<button id="table-prices-viewmore-button" data-page="2" class="btn btn-default"><i class="fa fa-angle-double-right"></i> Xem thêm</button>
			</div>
		</div>
	</section>


	<!-- Ảnh người dùng up lên -->
	@if($picture->count() >= 4)
	<section id="images-user" class="box-product">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-head">
					<span class="page-head-block">Ảnh người dùng</span>
				</h3>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="flexslider">
					<ul class="slides gallery">
						@foreach($picture as $value)
							<li>
								<a href="{{ PATH_IMAGE_PRODUCT . $value->getImage() }}" rel="gallery" class="fancybox">
									<img class="thumbnail" class="img-thumbnail" src="{{ PATH_IMAGE_PRODUCT . 'md_' . $value->getImage() }}" />
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</section>
	@endif

	@if($videos->count() > 0)
	<section id="video" class="box-product box-product-news">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-head">
					<a href="{{ route('video.index') . '?q=' . $product->getKeyword() }}" class="page-head-block">Video ({{ $countVideos }})</a>
					<div class="pull-right">
						<a href="{{ route('video.index') . '?q=' . $product->getKeyword() }}" class="pdt-video-viewmore">Xem tất cả</a>
					</div>
					<div class="clearfix"></div>
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<ul id="product-news" class="list-unstyled row pd-t-10 pd-bt-10">
					@forelse ($videos as $video)
						<li class="col-sm-3">
							<div class="pdt-post-item">
								<a href="{{ $video->getUrl() }}" title="{{ $video->getTitle() }}">
									<img src="{{ $video->getImage() }}" alt="{{ $video->getTitle() }}">
									<i class="fa fa-youtube-play video-icon"></i>
								</a>
								<h4><a href="{{ $video->getUrl() }}" target="_blank">{{ $video->getTitle() }}</a></h4>
								<i class="teaser">{{ $video->getTeaser() }}</i>
							</div>
						</li>
					 @empty
						<li class="col-sm-12">Đang cập nhật...</li>
					@endforelse
				</ul>
			</div>
		</div>
	</section>
	@endif

	@if($posts->total() > 0)
	<section id="news" class="box-product box-product-news">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-head">
					<a href="{{ route('post.index') . '?q=' . $product->getPostKeyword() . '&product_id=' . $product->getId()  }}" class="page-head-block">Tin tức ({{ $countPosts }})</a>
					<a href="{{ route('post.index') . '?q=' . $product->getPostKeyword() . '&product_id=' . $product->getId() }}" class="pull-right pdt-post-viewmore">Xem tất cả</a>
					<div class="clearfix"></div>
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<ul id="product-news" class="list-unstyled row pd-t-10 pd-bt-10">
					@forelse ($posts as $post)
						<li class="col-sm-3">
							<div class="pdt-post-item">
								<a href="{{ $post->getUrl() }}" title="{{ $post->getTitle() }}">
									<img src="{{ $post->getImage() }}" onerror="getImagePost(this, {{ $post->getId() }})" title="{{ $post->getTitle() }}" alt="{{ $post->getTitle() }}">
								</a>
								<h3><a href="{{ $post->getUrl() }}">{{ $post->title }}</a></h3>
								<i class="teaser">{{ $post->teaser }}</i>
							</div>
						</li>
					@empty
						<li class="col-sm-12">Đang cập nhật...</li>
					@endforelse
				</ul>
			</div>
		</div>
	</section>
	@endif

	@if($reviewPosts->total() > 0)
	<section id="review" class="box-product box-product-news">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-head">
					<a href="{{ route('post.index') . '?q=' . $product->getRateKeyword() . '&type=review&product_id=' . $product->getId() }}" class="page-head-block">Đánh giá ({{ $countReviewPosts }})</a>
					<a href="{{ route('post.index') . '?q=' . $product->getRateKeyword() . '&type=review&product_id=' . $product->getId() }}" class="pull-right pdt-post-viewmore">Xem tất cả</a>
					<div class="clearfix"></div>
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<ul class="list-unstyled row pd-t-10 pd-bt-10">
					@forelse ($reviewPosts as $post)
						<li class="col-sm-3">
							<div class="pdt-post-item">
								<a href="{{ $post->getUrl() }}" title="{{ $post->getTitle() }}">
									<img src="{{ $post->getImage() }}" onerror="getImagePost(this, {{ $post->getId() }})" title="{{ $post->getTitle() }}" alt="{{ $post->getTitle() }}">
								</a>
								<h3><a href="{{ $post->getUrl() }}">{{ $post->title }}</a></h3>
								<i class="teaser">{{ $post->teaser }}</i>
							</div>
						</li>
					@empty
						<li class="col-sm-12">Đang cập nhật...</li>
					@endforelse
				</ul>
			</div>
		</div>
	</section>
	@endif

	@if($opponents->count() > 0)
	<section id="opponents" class="box-product box-product-news">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-head">
					<a href="javascript:;" class="page-head-block">Đối thủ</a>
					<div class="clearfix"></div>
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div id="opponent-slider">
					<ul class="list-unstyled row slides">
						@foreach($opponents as $opponent)

							<li class="col-sm-3 col-xs-12 item">
								<a class="row opponent-vs-action-click" href="{{ route('product.vs.opponent', [$product->getId(), $opponent->getId()]) }}">
									<div class="col-sm-6 col-xs-6">
										<div class="img-responsive opponent-crop">
											<img src="{{ $opponent->getImage('thumbs/big') }}" class="img-thumbnail" alt="{{ $opponent->getName() }}">
										</div>
									</div>
									<div class="col-sm-6 col-xs-6">
										<!-- <div class="opponent-a">{{ $product->getName() }}</div>
										<div class="opponent-vs">Vs</div> -->
										<div class="opponent-b">{{ $opponent->getName() }}</div>
									</div>
								</a>
							</li>

						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</section>
	@endif

	<section id="product-spec" class="box-product box-product-digital mg-t-40">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-head mg-bt-10">
					<span class="page-head-block">Thông số kỹ thuật</span>
				</h3>
				<div class="product-spec {{ strpos($product->link, 'nama.com.vn') ? 'table-nama' : 'normal' }}">
					{!! $product->getSpec() !!}
					<a href="javascript:;" id="btnReview" class="btn btn-danger btn-sm">Xem thêm</a>
				</div>
			</div>

		</div>
	</section>

	<section id="box-comments" class="box-product box-product-comments">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-head">
					<span class="page-head-block">Bình luận</span>
				</h3>
			</div>
			<div class="col-sm-12">
				<div class="fb-comments" data-href="{{ Request::url() }}" data-width="100%" data-numposts="5"></div>
			</div>
		</div>
	</section>

	@if($questions->total())
	<section id="answer-question" class="listComments">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-head mg-bt-10">
					<span class="page-head-block">Hỏi đáp liên quan</span>
				</h3>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					@include('frontend/product/includes/loadmoreQuestion')
					<div id="load-more-question-place" class="mg-t-5"></div>
					@if($questions->total() > 10)
						<div class="pdt-btn-qevmore-container text-center">
							<span class="pdt-btn-question-viewmore" data-perpage="{{ $questions->perPage() }}" data-total="{{ $questions->total() }}" data-page="1">Xem thêm hỏi đáp</span>
						</div>
					@endif
				</div>
			</div>

		</div>
	</section>
	@endif

	@if($classifields->total())
	<section id="raovat">
		<div class="row mg-bt-15">
			<div class="col-sm-12">
				<h3 class="page-head">
					<span class="page-head-block">Rao vặt</span>
				</h3>
			</div>
		</div>

		<ul class="list-unstyled row">
			@foreach($classifields as $key => $cif)
			<li class="col-sm-12">
				<div class="raovat-item {{ $key == 0 ? 'first' : '' }}">
					<div class="row">
						<div class="col-sm-10">
							<h5 class="link"><a href="{{ $cif->getUrl() }}" title="{{ $cif->getTitle() }}">{{ $cif->getTitle() }}</a></h5>
							<h6 class="teaser">{{ $cif->getTeaser() }}</h6>
							<div class="user"><span>Đăng bởi:</span> {{ $cif->getUserName() }}</div>
						</div>
						<div class="col-sm-2 text-right">
							@if($cif->getPrice() > 0)
							<div class="price text-danger">{{ $cif->presenter()->getPrice() }}</div>
							@endif
						</div>
					</div>
				</div>
			</li>
			@endforeach
		</ul>

	</section>
	@endif

	<section id="lt-products" class="box-product box-product-related listProducts">
		<div class="row mg-bt-15">
			<div class="col-sm-12">
				<h2 class="page-head">
					<span class="page-head-block">Sản phẩm liên quan</span>
				</h2>
			</div>
		</div>
		<div class="row">
			@foreach($relatedProducts as $p)
				{!! $p->presenter()->getItem() !!}
			@endforeach
		</div>
	</section>

	<section class="pdt-block-hsx pd-bt-30">
		<div class="row mg-bt-15">
			<div class="col-sm-12">
				<h2 class="page-head">
					<span class="page-head-block">Hãng sản xuất</span>
				</h2>
			</div>
		</div>
		<div class="row">
			@foreach($GLB_Brands as $brand)
				<a class="col-sm-2 link-item" href="{{ $brand->getUrl() }}" title="{{ $brand->getName() }}">{{ $brand->getName() }}</a>
			@endforeach
		</div>
	</section>

	{{--
	<section id="pdt-auto-tags" class="pd-bt-30">
		<div class="row mg-bt-15">
			<div class="col-sm-12">
				<h2 class="page-head">
					<span class="page-head-block">Từ khóa</span>
				</h2>
			</div>
		</div>

		@foreach($arrayPrependTags as $tag)
			<a class="auto-tag-item" href="{{ route('tag.index', [removeTitle($tag)]) }}">{{ $tag }}</a>
		@endforeach

		@foreach($dbProductPrices as $p)
			<a class="auto-tag-item" href="{{ route('tag.index', [removeTitle($p->title)]) }}">{{ $p->title }}</a>
		@endforeach

		@foreach($arrayAppendTags as $tag)
			<a class="auto-tag-item" href="{{ route('tag.index', [removeTitle($tag)]) }}">{{ $tag }}</a>
		@endforeach

		@foreach($relatedProducts as $p)
			<a class="auto-tag-item" href="{{ route('tag.index', [removeTitle($p->getName())]) }}">{{ $p->getName() }}</a>
		@endforeach

	</section>
	--}}

	@if($product->tags()->count())
	<div id="product-tags" class="tag-container mg-bt-20">
		@foreach($product->tags()->get() as $tag)
			<a href="{{ route('tag.index', $tag->getSlug()) }}" class="tag-item">{{ $tag->getName() }}</a>
		@endforeach
	</div>
	@endif

	<div id="modal-wrong-prices" class="modal fade" tabindex="-1" role="dialog">
	    <div class="modal-dialog modal-sm">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title">Báo lỗi</h4>
	            </div>
	            <div class="modal-body">
	                <p class="text-center">Sản phẩm <span class="price-name">Xyz</span> có giá <span class="price-price">999.999 đ</span></p>
	                <select name="error_type" id="sl-error-type" class="form-control btn-flat">
	                	<option value="">Chọn một lỗi</option>
	                	<option value="{{ \Nht\Hocs\MerchantReports\MerchantReport::WRONG_PRICE }}">Sai giá</option>
	                	<option value="{{ \Nht\Hocs\MerchantReports\MerchantReport::WRONG_INFO }}">Sai thông tin sản phẩm</option>
	                	<option value="{{ \Nht\Hocs\MerchantReports\MerchantReport::LINK_DIE }}">Link tới nơi bán lỗi</option>
	                </select>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Đóng</button>
	                <button type="button" data-priceId="" class="btn btn-primary btn-flat btn-action-submit-wrong-price">Báo lỗi</button>
	            </div>
	        </div>
	        <!-- /.modal-content -->
	    </div>
	    <!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	{{-- MODAL DANH GIA --}}
	@include('frontend/product/includes/modal_rate')

	{{-- Functions fixed --}}

	{{-- End functions fixed --}}

	<div id="modal-map" class="modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        			<h4 class="modal-title">Bản đồ nơi bán</h4>
				</div>
				<div class="modal-body">
					<div id="map"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div>
		</div>
	</div>

</div>{{-- END PRODUCT DETAIL PAGE --}}
@stop


@section('scripts')

	<script type="text/javascript" src="/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<script type="text/javascript" src="/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
	<script type="text/javascript" src="/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<script src="http://botmonster.com/jquery-bootpag/jquery.bootpag.js"></script>

	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5674cf635e4c5b26"></script>

	<script src="/bower_components/flexslider/jquery.flexslider-min.js"></script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgw7JoSOV_VqSLZBWP40kHd8la0tRP8EU"></script>


	<script type="text/javascript">
	$(function() {

		// Can also be used with $(document).ready()
		$(window).load(function() {
			$('.flexslider').flexslider({
				animation: "slide",
				animationLoop: false,
				itemWidth: 210,
				itemMargin: 5,
				minItems: 2,
				maxItems: 4
			});
		});

		$(".fancybox").fancybox({
			openEffect: "none",
        	closeEffect: "none"
		});

		$('#btnReview').click(function() {
			var _box = $('.box-product-digital .product-spec ul');
			if (_box.hasClass('expanded')) {
				_box.css('height', '300px').removeClass('expanded');
			} else {
				_box.css('height', 'auto').addClass('expanded');
			}
		});
		$('#menu-product').find('a[href*=#]:not([href=#])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: (target.offset().top - 80) + 'px'
				}, 1000);
					return false;
				}
			}
		});

		$('#price-compare-viewmore').click(function() {
			$('.metadata-desc').removeClass('viewmore');
		});

		$('.product-spec table:nth-child(1)').addClass('table')
											.removeAttr('style');

	});
	</script>


	<div id="fb-root"></div>
	<script>

		window.fbAsyncInit = function() {
		    FB.init({
		      	appId      : '552091071613449',
		      	xfbml      : true,
		      	version    : 'v2.5'
		    });
	  	};

	  	(function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     js.async = true;
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));


	</script>


	<script>
		$(function() {


			var $btnSortByUpdate = $('#btn-sort-by-update');
			var $btnSortByRank   = $('#btn-sort-by-rank');

        	$('.btn-action-sort').change(function() {
        		var $this = $(this);
        		$.ajax({
        			url : '/ajax/getPricesTable',
        			type : 'GET',
        			data : {
        				product_id : {{ $productDetail->getId() }},
        				page : currentPage,
        				take : 10,
        				sort : $this.val()
        			},
        			beforeSend : function() {
        				console.log('loading');
        			},
        			success : function(response) {
        				$('#info-prices-table').html(response);
        			}
        		});

        		return false;

        	});


        	$('.product-like .icon-action').click(function() {
        		var productId = $(this).data('pid');
        		$.ajax({
        			url : '/api/product/' + productId + '/like',
        			type : 'POST',
        			dataType : 'json',
        			data : {
        				_token : '{{ csrf_token() }}',
        				product_id : productId
        			},
        			success : function(response) {
        				var currentLike = $('.like-number').text();
        				if(response.code === 1) {
        					$('.like-number').text(parseInt(currentLike)+1);
        				} else if(response.code === 2) {
        					$('.like-number').text(parseInt(currentLike)-1);
        				}
        			}
        		});
        	});
		});
	</script>

	<script>

		$(function() {
			$(document).on('click', '.item-viewmore', function() {
				var $this = $(this);
				var shopId = $this.data('shop');

				var $viewMoreText = $this.find('.viewmore-text');
				var cacheViewMoreText = $viewMoreText.html();
				var totalProductViewmore = $this.data('total_product_viewmore');

				if(!$this.hasClass('clicked')) {
					$this.addClass('clicked');
					$viewMoreText.html('Thu gọn <i class="fa fa-angle-up"></i>');
				} else {
					var text = $viewMoreText.attr('data-text-old');
					$viewMoreText.html(totalProductViewmore + ' sản phẩm <i class="fa fa-angle-down"></i>');
					$this.removeClass('clicked');
				}

				$('#viewmore-placement-' + shopId).toggleClass('hide');

				$.ajax({
					url : '/ajax/loadPricesViewMore',
					type: 'GET',
					data: {
						product_id : $this.data('productid'),
						price_id : $this.data('price_id'),
						sort : $('.btn-action-sort').val() | null,
						source : $this.data('source'),
						source_id : $this.data('sourceid')
					},
					success : function(response) {
						$('#viewmore-placement-' + shopId).html(response);
					}
				});
			});


			$(document).on('click', '.btn-action-wrong-price', function() {
				var $this = $(this);
				var $modal = $('#modal-wrong-prices');
				$modal.find('.price-name').text($this.data('pricename'));
				$modal.find('.price-price').text($this.data('price'));

				// Set priceId to button submit wrong price
				$modal.find('.btn-action-submit-wrong-price').data('priceid', $this.data('priceid'));
				$modal.find('.btn-action-submit-wrong-price').attr('data-merchant', $this.data('merchant'));
				$('#modal-wrong-prices').modal('toggle');
			});

			$('.btn-action-submit-wrong-price').click(function(e) {
				e.preventDefault();
				var $this = $(this);
				$.ajax({
					url : '{{ route('ajax.product.user_report_merchant') }}',
					type: 'POST',
					dataType : 'json',
					data : {
						price_id : $this.data('priceid'),
						product_id : {{ $product->getId() }},
						type : $('#sl-error-type').val(),
						merchant_id : $this.data('merchant'),
						_token : "{{ csrf_token() }}"
					},
					success : function(response) {
						$('#modal-wrong-prices').modal('toggle');
						alert(response.message);
					}
				})
			});

			// Scroll to price table
			$('.pdt-count-shop').click(function() {
				var $this = $(this);
				var $target = $($this.data('target'));

				$('html,body').animate({
		            scrollTop: $target.offset().top - 150
		        }, 700);
			});

			// Get min prices
			$.ajax({
				url : '{{ route("ajax.getMinPrice") }}',
				type : 'GET',
				dataType : 'json',
				data : {
					product_id : {{ $product->getId() }}
				},
				beforeSend : function() {
					$('#pdt-min-price').text('Đang cập nhật');
				},
				success : function(response) {
					$('#pdt-min-price').text(response.price_str);
				}
			});

			// Get total shop
			$.ajax({
				url : '{{ route("ajax.getTotalShop") }}',
				type : 'GET',
				dataType : 'json',
				data : {
					product_id : {{ $product->getId() }}
				},
				beforeSend : function() {
					$('#ajax-total-shop').text('...');
				},
				success : function(response) {
					$('#ajax-total-shop').text(response.total_shop);
				}
			});

			// View more questions
			$('.pdt-btn-question-viewmore').click(function() {
				var $this = $(this);
				var page = parseInt($this.data('page')) + 1;
				$.ajax({
					url : '{{ route('ajax.viewmoreQuestion') }}',
					data : {
						product_id : {{ $product->getId() }},
						page : page,
						per_page : $this.data('perpage')
					},
					type : 'GET',
					success : function(response) {
						if(response) {
							$this.data('page', page);
							$('#load-more-question-place').append(response);
						} else {
							$this.hide();
						}
					}
				});
			});

			// Hover rate star
			$('.rate-star').hover(function() {
				var $this = $(this);
				var index = $this.index();

				for(var i = 1; i <= (index+1); i++) {
					$('.rate-star-' + i).removeClass('text-danger').addClass('text-danger');
				}

				for(var i = (index+2); i <= 5; i ++) {
					$('.rate-star-' + i).removeClass('text-danger');
				}
			}, function() {
				var $this = $(this);
				for(var i = 1; i <= $this.data('avg'); i++) {
					$('.rate-star-' + i).removeClass('text-danger').addClass('text-danger');
				}

				for(var i = $this.data('avg')+1; i <= 5; i ++) {
					$('.rate-star-' + i).removeClass('text-danger');
				}
			})
			.click(function() {
				var $this = $(this);
				$.ajax({
					url : '/ajax/rating',
					type : 'POST',
					dataType : 'json',
					data : {
						product_id : '{{ $product->getId() }}',
						value : $this.data('value'),
						_token : '{{ csrf_token() }}',
						ip : '{{ Request::server('REMOTE_ADDR') }}'
					},
					success : function(response) {
						if(response.code == 2) {
							window.location.href = response.url_login;
						}
					}
				});
			});

			$("#opponent-slider").flexslider({
			    animation: "slide",
			    animationLoop: false,
			    itemWidth: 210,
			    itemMargin: 5,
			    minItems: 1,
			    maxItems: 4
			});

			// Clear style
			$('.product-spec.table-nama').find('table, tr, td, span').removeAttr('style');

			// Rotate functions
			// $('#functions .main-item.action').click(function() {
			// 	$('#functions').toggleClass("open");
			// });

			// $('body').scrollspy({ target: '#functions', offset: 100});

			$('.item').click('activate.bs.scrollspy', function () {
				var selector = $(this).data('id');
				$('#functions').find('li').removeClass('active');
				$(this).parent().addClass('active');
				scrollToSelector(selector);
			});

			// Click go to shop
			$('.shop-ads-go-to-link').click(function() {
				var $this = $(this);
				$.ajax({
					url : "{{ route('ajax.shopAds.click') }}",
					data : {
						product_id : '{{ $product->getId() }}',
						shop_id : $this.data('shopid'),
						auc : $this.data('auc'),
						_token : '{{ csrf_token() }}'
					},
					type : 'POST',
					success : function(response) {
						console.log(response);
					}
				});
			});


			// Show map
			$('#action-show-map').click(function() {
				$('#modal-map').modal({
					show : true,
					// backdrop: false
				});
			});

			if (navigator.geolocation) {
		        navigator.geolocation.getCurrentPosition(function(position) {
		        	console.log(position);
		        });
		    } else {
		    	console.log('Geolocation is not supported for this Browser/OS version yet.');
		    }

		    var shopOverlay = function(data, key, map) {
		    	this.data = data;
		    	this.map = map;
		    	this.key = key;

		    	this.setMap(map);
		    }

		    shopOverlay.prototype = new google.maps.OverlayView();

		    shopOverlay.prototype.onAdd = function() {
		    	var div = $('<div>');

		    	div.attr('id', 'map-shop-' + this.key);

		    	var data = this.data;
		    	div.html(data.title);

		    	this.getPanes().overlayMouseTarget.appendChild($(div).get(0));
		    }

		    shopOverlay.prototype.draw = function() {
		    	var gPoint = new google.maps.LatLng(this.data.lat, this.data.long);

		        // Convert tọa độ lat, lng sang pixel
		        var bubblePosition = this.getProjection().fromLatLngToDivPixel(gPoint);
		        console.log(this.data);

		    	$('#map-shop-' + this.key).css({
		    		'position' : 'absolute',
		    		'top'   : (bubblePosition.y) + 'px',
           			'left'  : (bubblePosition.x) + 'px',
           			'width' : '200px',
           			'background' : '#fff',
           			'box-shadow' : '0px 0px 5px rgba(0,0,0,.2)'
		    	});
		    }

			$('#modal-map').on('shown.bs.modal', function() {

				var map = new google.maps.Map(document.getElementById('map'), {
				    zoom: 12,
				    center: {lat: 21.013788, lng: 105.924382}
				});

				@foreach($geos as $k => $geo)
					new google.maps.Marker({
					    position: {
					    	lat: {{ $geo['lat'] }},
					    	lng: {{ $geo['long'] }}
					    },
					    map: map,
					    title : '{!! $geo['title'] !!}'
					});

					// new shopOverlay(JSON.parse('<?php echo json_encode($geo, JSON_UNESCAPED_UNICODE) ?>'), {{ $k }}, map);
				@endforeach
			});

		});



	$(function() {
		// Scroll fixed functions navbar
		$(window).scroll(function() {
			var that = $(this);
			var $func = $('#functions');

			if(that.scrollTop() >= 400) {
				$func.addClass('visible');
			} else {
				$func.removeClass('visible');
			}
		});
	});


	$(function() {
		// Scroll functions click action
		$('.action-scroll-function').click(function() {
			var that = $(this);
			scrollToSelector(that.attr('href'));
		});
	});

	$(function() {
		// Ajax load prices table
		$.ajax({
			url : '{{ route('ajax.product.loadPriceTable') }}',
			type : 'GET',
			data : {
				product_id : {{ $product->getId() }}
			},
			success : function(response) {
				$('#info-prices-table').html(response);
			}
		});
	});

	// Click to total shop scroll to price table
	$(function() {
		$('.pdt-infomation .count-shop').click(function() {
			scrollToSelector('#prices');
		});
	});

	// Scrollpy functions
	$(function() {
		var scrollpyItems = ['#prices', '#news', '#review', '#opponents', '#product-spec', '#box-comments', '#answer-question',
			'#raovat', '#lt-products'
		];

		$(window).scroll(function() {
			var that = $(this);

			var scrollTop = $(window).scrollTop();
			// Reset all li to default
			$('#functions').find('li').removeClass('active');

			// Loop to check active
			for(var i in scrollpyItems) {

				var item = scrollpyItems[i];

				var elementOffsetTop = $(item).position().top;
				var elementOffsetBottom = $(item).position().top + $(item).height();

				if(scrollTop >= elementOffsetTop && scrollTop <= elementOffsetBottom) {
					$('#functions').find('li').removeClass('active');
					$('.item[data-id="'+ item +'"]').parent().addClass('active');
				}
			}
		});
	});


	$(function() {
		// Show modal rate merchant
		$(document).on('click', '.btn-action-user-rating-merchant', function(e) {
			e.preventDefault();
			var $this = $(this);
			$('#modal-rate').modal('show');
			$('#modal-rate').find('.merchant-name').text($this.data('merchant_name'));
			$('#form-rate').attr('data-merchant', $this.data('merchant'));
		});
	});


	$(function() {
		// Hover rate star
	    $('#product-detail-page').find('.rate-icon').hover(function() {
	        var $this = $(this);
	        var index = $this.index();

	        for(var i = 1; i <= (index+1); i++) {
	            $('.rate-star-icon-' + i).removeClass('hover').addClass('hover');
	        }

	        for(var i = (index+2); i <= 5; i ++) {
	            $('.rate-star-icon-' + i).removeClass('hover');
	        }
	    }, function() {
	        var $this = $(this);
	        $('.rate-icon').removeClass('hover');
	    })
	    .click(function() {
	    	var $this = $(this);
			var rateValue = $this.data('value');
			$.ajax({
				url : '{{ route("ajax.product.user_rating_merchant") }}',
				type : "POST",
				dataType : "json",
				data : {
					product_id : {{ $product->getId() }},
					merchant_id : $('#form-rate').data('merchant'),
					value : rateValue,
					_token : '{{ csrf_token() }}'
				},
				success : function(response) {
					if(response.code == 1) {
						alert('Bạn đã đánh giá thành công')
					} else {
						alert(response.message);
					}
				}
			})
	    });
	});



	$(function() {
		/**
		 * Biến xác định có load thêm không
		 * @type {Boolean}
		 */
		var continueLoadItemTablePrice = true;

		/**
		 * Click nút xem thêm item bảng so sánh giá
		 * @selector: #table-prices-viewmore-button
		 * @action: click
		 * @page : ProductDetail
		 * @author Justin Luong
		 */
		$('#table-prices-viewmore-button').click(function() {
			var $this = $(this);
			var currentPage = $this.data('page');

			if(continueLoadItemTablePrice) {
				$.ajax({
	    			url : '/ajax/getPricesTable',
	    			type : 'GET',
	    			dataType: 'json',
	    			data : {
	    				product_id : {{ $product->getId() }},
	    				page : $this.data('page'),
	    				take : 10,
	    				sort : $('.btn-action-sort').val()
	    			},
	    			beforeSend : function() {
	    				$('#table-prices-loading').removeClass('hide');
	    			}
	    		}).done(function(response) {
	    			$('#table-prices-loading').addClass('hide');

	    			if(response.code === 1) {
	    				$this.html('<i class="fa fa-angle-double-right"></i> Xem thêm');
	                	$('#info-prices-table').append(response.html);
	                	currentPage ++;
	                	$this.data('page', currentPage);
	                } else {
	                	$this.html('<i class="fa fa-angle-double-up"></i> Thu gọn');
	                	continueLoadItemTablePrice = false;
	                }
	            });
	        } else {
	        	$this.addClass('collspan');
	        }
		});

		/**
		 * Click vào nút để thu gọn lại
		 * @selector: #table-prices-viewmore-button.collspan
		 */
		$(document).on('click', '#table-prices-viewmore-button.collspan', function() {
			var $this = $(this);

			$('#info-prices-table').css({
        		height: '350px',
				overflow: 'hidden'
        	});

        	$this.html('<i class="fa fa-angle-double-right"></i> Xem thêm');

        	$this.removeClass('collspan').addClass('expand');

        	// Cuộn ngược lại bảng so sánh giá
        	scrollToSelector('#prices');
		});


		/**
		 * Click vào để mở rộng ra
		 * @selector: #table-prices-viewmore-button.collspan
		 */
		$(document).on('click', '#table-prices-viewmore-button.expand', function() {
			var $this = $(this);

			$('#info-prices-table').removeAttr('style');

        	$this.html('<i class="fa fa-angle-double-right"></i> Thu gọn');

        	$this.removeClass('expand').addClass('collspan');
		});
	});
	</script>

@stop
