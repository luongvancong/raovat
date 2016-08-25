<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-language" content="vi" />
	<link rel="alternate" href="{{ Request::url() }}" hreflang="vi-vn" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="{{ Request::server('SERVER_NAME') }}"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $setting->getTitle() }}</title>
	<meta name="keywords" content="{{ $setting->getMetaKeyword() }}">
	<meta name="description" content="{{ $setting->getMetaDescription() }}">
	<meta name="google-site-verification" content="H7U8fkE_lzzZ5LSrJ0ElH82NiFDqMA4-dck1kY4sOAw" />

	<link rel="stylesheet" href="/css/all.css">
	<link rel="shortcut icon" href="/favicon.png" />
	@if(isset($openGraph))
		{!! $openGraph !!}
	@endif
	@yield('styles')
	<script src="/js/min/all.min.js"></script>
	{!! $setting->getJsCodes() !!}
</head>
<body>
	<div id="all-container">
		{{-- HEADER FOR LAPTOP --}}
		<div align="center">
			@foreach($GLB_ads as $value)
				@if($value->position == TOP_PAGE && $value->banner != '/images/ads.jpg')
					<a class="advertise" data-id="{{ $value->id }}" href="{{ $value->link }}" title="{{ $value->title }}">
						<img style="max-height: 100px;" class="img-responsive" src="{{ ($value->banner != '/images/ads.jpg') ? PATH_IMAGE_ADVERTISE. $value->banner : $value->banner }}" alt="{{ $value->title }}">
					</a>
				@endif
			@endforeach
		</div>
		<header id="header" class="headerTop hidden-xs">
			<nav class="navbar navbar-default">
				<div class="container">
			  		<div class="navbar-header">
						<a class="navbar-brand logo" href="/">Giaca.org</a>
			  		</div>
			  		@section('search-box')
					<div id="navbar" class="navbar-collapse collapse">
						<form class="navbar-right navbar-form computer hidden-xs" action="{{ route('searchon') }}" method="get">
							<div class="input-group">
								<span class="input-group-addon suggest-tags action-click-show-tags">Gợi ý từ khóa <i class="fa fa-angle-down"></i></span>
						      	<input type="search" name="q" placeholder="Bạn cần tìm sản phẩm gì?" class="form-control input-search btn-flat" value="{{ Request::get('q', '') }}" />

						      	<span class="input-group-btn">
						        	<button type="submit" class="btn btn-search"> <i class="fa fa-search"></i> Tìm kiếm</button>
						      	</span>

						   </div>
						   <span class="hide tags-head"><small>Từ khóa hot:
						   		<?php $tagStr = ''; ?>
						   		@foreach($GLB_TagHeaders as $key => $tag)
						   			@if($key <= 10)
										<?php $tagStr .= '<a href="'. route('searchon') .'?q='. $tag->getName() .'">' . $tag->getName() . '</a>,&nbsp;' ?>
									@endif
						   		@endforeach
						   		{!! trim($tagStr, ',&nbsp;') !!}
						   		</small>
						   </span>
						</form>

						<form class="navbar-right navbar-form visible-xs" action="{{ route('searchon') }}" method="get">
						   <div class="form-group">
						   		<ul class="list-unstyled mg-t-10">
									<li class="mg-bt-5">
										<a href="{{ route('post.index') }}">Tin tức</a>
									</li>
									<li class="mg-bt-5">
										<a href="{{ route('video.index') }}">Video review</a>
									</li>
								</ul>
						   </div>
						</form>
					</div>
					@show
				</div>
			</nav>
		</header>

		<section id="page-main">
			{{-- FORM SEARCH FOR MOBILE --}}
			<form class="mg-t-10 mg-bt-10 col-sm-10 visible-xs form-search-mobile" action="{{ route('searchon') }}">
				<div class="input-group">
			      <input type="search" name="q" placeholder="Tìm sản phẩm?" class="form-control input-search" value="{{ Request::get('q', '') }}" />
			      <span class="input-group-btn">
			        	<button type="submit" class="btn btn-search"> <i class="fa fa-search"></i> Tìm kiếm</button>
			      </span>
			   </div>
			</form>

			@yield('slider')

			<div id="justin-navbar">
				<nav class="navbar navbar-default">
				    <div class="container">
				    	<div class="row">
				    		<div class="col-sm-12">
								<!-- Brand and toggle get grouped for better mobile display -->
						        <div class="navbar-header">
						            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						            <span class="sr-only">Toggle navigation</span>
						            <span class="icon-bar"></span>
						            <span class="icon-bar"></span>
						            <span class="icon-bar"></span>
						            </button>
						        </div>
						        <!-- Collect the nav links, forms, and other content for toggling -->
						        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						            <ul class="nav navbar-nav">
						            	<li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/" title="Trang chủ">Trang chủ</a></li>
						                <li class="{{ Request::is('san-pham-moi') ? 'active' : '' }}"><a href="{{ route('product.newest') }}" title="Sản phẩm">Sản phẩm <span class="badge">{{ formatCurrency($GLB_CountProduct) }}</span> <span class="sr-only">(current)</span></a></li>
						                <li class="{{ Request::is('tin-tuc.html') ? 'active' : '' }}"><a href="{{ route('post.index') }}" title="Tin tức">Tin tức <span class="badge">{{ formatCurrency($GLB_CountPost) }}</span></a></li>
						                <li class="{{ Request::is('video.html') ? 'active' : '' }}"><a href="{{ route('video.index') }}" title="Video">Video <span class="badge">{{ formatCurrency($GLB_CountVideo) }}</span></a></li>
						                <li class="{{ Request::is('rao-vat.html') ? 'active' : '' }}"><a href="{{ route('raovat.index') }}" title="Video">Rao vặt <span class="badge">{{ formatCurrency($GLB_CountClassifield) }}</span></a></li>
						                <li class="{{ Request::is('hoi-dap.html') ? 'active' : '' }}"><a href="{{ route('hoidap.index') }}" title="Video">Hỏi đáp <span class="badge">{{ formatCurrency($GLB_CountQuestion) }}</span></a></li>
						                <li class="{{ Request::is('cua-hang.html') ? 'active' : '' }}"><a href="{{ route('shop.index') }}" title="Video">Cửa hàng bán <span class="badge">{{ formatCurrency($GLB_CountShop) }}</span></a></li>
						            </ul>

						            @if(Auth::check())
							        <ul class="nav navbar-nav navbar-right">
									    <li class="dropdown">
									        <a href="{{ $GLB_Login->getUrl() }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $GLB_Login->getName() }} <span class="caret"></span></a>
									        <ul class="dropdown-menu">
					            				<li><a href="{{ route('account.settings') }}">Thiết lập tài khoản</a></li>
									            <li><a href="{{ route('auth.logout') }}">Thoát</a></li>
									        </ul>
									    </li>
									</ul>
									@endif

						        </div>

						        <!-- /.navbar-collapse -->
				    		</div>
				    	</div>

				    </div>
				    <!-- /.container-fluid -->
				</nav>
			</div>

			<div class="container" id="page-container">
				<div class="row">
					<div class="col-sm-12">@include('notifications')</div>
				</div>
				@yield('content')
			</div>
		</section>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="logo-footer">
							<a href="/"></a>
						</div>
						<h3 class="heading-title text-color-blue">
							Giới thiệu
						</h3>
						<div class="aboutUs text-description">
							<h1 class="frontpage-heading">{{ $setting->getShortDescription() }}</h1>
						</div>
					</div>

					<div class="col-sm-6">
						<h3 class="heading-title text-color-blue">Liên hệ</h3>
						<ul class="list-unstyled">
							<li>{{ $setting->getEmail_1() }}</li>
							<li>{{ $setting->getPhone_1() }}</li>
						</ul>
						<div class="network-social">
							<ul class="list-inline social-buttons">
								<li>
									<a href="{{ $setting->getFacebook() }}" class="btn btn-link" target="_blank"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="{{ $setting->getGoogleplus() }}" class="btn btn-link" target="_blank"><i class="fa fa-google"></i></a>
								</li>
								<li>
									<a href="{{ $setting->getTwitter() }}" class="btn btn-link" target="_blank"><i class="fa fa-twitter"></i></a>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-sm-12">
						<ul class="list-unstyled link-product-footer text-center">
							<li><a class="text-color-white" href="{{ route('product.hot') }}">Sản phẩm hot - </a></li>
							<li><a class="text-color-white" href="{{ route('product.newest') }}">Sản phẩm mới - </a></li>
							<!-- <li><a class="text-color-white" href="{{ route('product.cheap') }}">Sản phẩm giá rẻ - </a></li> -->
							<li><a class="text-color-white" href="{{ route('compare') }}">So sánh - </a></li>
							<li><a class="text-color-white" href="{{ route('website-register') }}">Đăng ký website - </a></li>
							<li><a class="text-color-white" href="{{ route('auth.login_form') }}">Đăng ký/Đăng nhập</a></li>
						</ul>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<?php $tagStr = ''; ?>
				   		@foreach($GLB_TagFooters as $tag)
							<?php $tagStr .= '<a href="'. route('searchon') .'?q='. $tag->getName() .'">' . $tag->getName() . '</a> | ' ?>
				   		@endforeach
				   		{!! trim($tagStr, ' | ') !!}
					</div>
				</div>
			</div>

			<div id="loading">
				<div class="text-center">
					<span><i class="fa fa-spinner fa-spin"></i> Đang tải</span>
				</div>
			</div>
		</footer>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.6.5/jquery.lazy.min.js"></script>
		<!-- <script src="/js/jquery.js"></script>
		<script src="/bs3/js/bootstrap.min.js"></script>
		<script src="/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
		<script src="/js/functions.js"></script>
		<script src="/bower_components/typeahead.js/dist/typeahead.bundle.min.js"></script>
		<script src="/bower_components/handlebars/handlebars.min.js"></script>
		<script src="/js/main.js"></script>
		<script src="/bower_components/isMobile/isMobile.min.js"></script> -->
		<script>
			$(function() {
				try {
				    $("img.lazy").lazy({
				    	// placeholder : "{{ '/images/grey.gif' }}",
				    	beforeLoad: function(element) {
			                $(element).attr('src', "{{ '/images/grey.gif' }}");
			            },
				    	onError: function(element) {
				    		var type = element.data('type');
				    		var id = element.data('id');
				    		if(type == 'post') {
				    			getImagePost(element, id);
				    		}
			            }
				    });
				} catch(e) {
					console.log(e);
				}

			    $('.action-click-show-tags').click(function() {
			    	$('.tags-head').toggleClass('hide');
			    });


			    $('.advertise').attr('target', '_blank').click(function(e) {
			    	link = $(this).attr('href');
			    	$.ajax({
			    		url: "{{ route('ajax.advertise.click') }}",
			    		type: "POST",
			    		data: {
			    			ads_id: $(this).data('id'),
		                    _token : '{{ csrf_token() }}'
			    		},
			    		success : function(response) {
		                    // window.location.replace(link);
		                }
			    	});
			    });

			});
		</script>
		@yield('scripts')
	</div>
</body>
</html>
