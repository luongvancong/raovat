@extends('frontend/layout/default')

@section('content')
	<h1 class="hide">{{ $setting->getTitle() }}</h1>

	<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
	  	{!! getBreadcrumbItem('Trang chủ', '/') !!}
	  	{!! getBreadcrumbItem('Sản phẩm', route('product.newest')) !!}
	  	{!! getBreadcrumbItem(mb_strtoupper($brandName), '', true) !!}
	</ol>

	<div class="row">

		<div class="col-sm-3">
			<div class="sidebar">

				<div class="box-site box-white box-sidebar">
					<h3 class="box-heading bg-color text-color-white title-heading-global">
						<i class="fa fa-delicious"></i>
						Hãng sản xuất
					</h3>
					<ul class="list-unstyled">
						@foreach($GLB_Brands as $brand)
						<?php
							$countProduct = $brand->getTotalProducts();
						?>
							@if($countProduct > 0)
							<li class="{{ isset($brandName) && $brandName == strtolower($brand->getName()) ? 'active' : '' }}">
								<h3><a href="{{ $brand->getUrl() }}">{{ $brand->getName() }} ({{ $countProduct }}) <i class="fa fa-angle-right pull-right"></i></a></h3>
							</li>
							@endif
						@endforeach
					</ul>
				</div>

				 <div class="box-site box-white box-sidebar">
					<h3 class="box-heading bg-color text-color-white title-heading-global">
						<i class="fa fa-th-large"></i>
						Tags
					</h3>
					<ul class="list-unstyled">
						<?php
							$tags = ['Iphone', 'Samsung', 'Oppo', 'Nokia', 'LG', 'Galaxy']
						?>
						@foreach($tags as $tag)
						<li>
							<a href="{{ route('searchon') . '?q=' . $tag }}">{{ $tag }}</a>
						</li>
						@endforeach
					</ul>
				</div>

				<div class="box-site box-white box-sidebar">
					<h3 class="box-heading bg-color text-color-white title-heading-global">
						<i class="fa fa-th-large"></i>
						Khoảng giá
					</h3>
					<ul class="list-unstyled">
						<li>
							<a href="{{ url_add_params(['price_from' => 20000000]) }}">Trên 20 triệu</a>
						</li>
						<li>
							<a href="{{ url_add_params(['price_from' => 10000000, 'price_to' => 20000000]) }}">Từ 10-20 triệu</a>
						</li>
						<li>
							<a href="{{ url_add_params(['price_from' => 5000000, 'price_to' => 10000000]) }}">5-10 triệu</a>
						</li>
						<li>
							<a href="{{ url_add_params(['price_from' => 1000000, 'price_to' => 5000000]) }}">Từ 1-5 triệu</a>
						</li>
						<li>
							<a href="{{ url_add_params(['price_from' => 0, 'price_to' => 1000000]) }}">Dưới 1 triệu</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-sm-9">
			<div class="main-primary">
				<section class="contentOuter listProducts">
					<div class="row">
						<form id="form-filter" action="" method="GET" class="mg-bt-30">
							<div class="col-sm-4 col-xs-12">
								<h3 class="product-brand brand-name">{{ $brandName }}</h3>
							</div>
							<div class="col-sm-4 col-xs-6">
								<select id="control-sort" name="sort" class="form-control control-filter btn-flat mg-bt-10">
									<option value="">Sắp xếp theo</option>
									<option value="newest" {{ Request::get('sort') == 'newest' ? 'selected="selected"' : '' }}>Mới nhất</option>
									<option value="price_asc" {{ Request::get('sort') == 'price_asc' ? 'selected="selected"' : '' }}>Giá tăng dần</option>
									<option value="name_asc" {{ Request::get('sort') == 'name_asc' ? 'selected="selected"' : '' }}>Alphabet</option>
								</select>
							</div>
							<div class="col-sm-4 col-xs-6">
								<?php
									$arrayPriceRange = [
										'20000000:1000000000000' => 'Trên 20 triệu',
										'10000000:20000000' => 'Từ 10-20 triệu',
										'5000000:10000000' => 'Từ 5-10 triệu',
										'1000000:5000000' => 'Từ 1-5 triệu',
										'0:1000000' => 'Dưới 1 triệu'
									];
								?>
								<select name="price" id="control-price" class="form-control control-filter btn-flat">
									<option value="">Khoảng giá</option>
									@foreach($arrayPriceRange as $rangePrice => $rangePriceText)
										<option value="{{ $rangePrice }}" {{ Request::get('price') == $rangePrice ? 'selected="selected"' : '' }}>{{ $rangePriceText }}</option>
									@endforeach
								</select>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
					<div class="row">
						@forelse ($products as $product)
							<div class="col-sm-12">
								<div class="row product-item product-brand">
									<div class="col-sm-3 col-xs-6">
										<a class="text-center link-img" href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">
											<img class="img-responsive" src="{{ $product->getImage() }}" alt="{{ $product->getName() }}" onerror="this.src='/images/grey.gif'">
										</a>
									</div>
									<div class="col-sm-6 col-xs-6">
										<h2 class="name">
											<a href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">
												{{ $product->getName() }}
											</a>
										</h2>

										<p class="teaser visible-xs">
											Sản phẩm {{ $product->getName() }} của {{ $product->getTotalShop() }} cửa hàng - Giá thấp nhất
										</p>

										<p class="teaser hidden-xs">
											Sản phẩm {{ $product->getName() }}, thông tin sản phẩm {{ $product->getName() }}, so sánh giá sản phẩm {{ $product->getName() }}
										</p>

										<div class="shop-list hidden-xs hidden-sm">
											@foreach($product->shops as $shop)
												<div class="crop">
													<img src="{{ $shop->getImage() }}" class="img-responsive {{ getExtension($shop->getImage()) == 'png' ? 'img-background' : '' }}" alt="{{ $shop->getName() }}">
												</div>
											@endforeach
										</div>

										<div class="price visible-xs">
											<span class="price-str">{{ $product->getPriceStr() }}đ</span>
										</div>

									</div>
									<div class="col-sm-3 hidden-xs">
										<div class="price-compare">
											<div class="heading">Giá bắt đầu từ</div>
											<div class="price">
												<span class="price-str">{{ $product->getPriceStr() }}đ</span>
											</div>
											<a class="btn btn-sm btn-flat btn-danger mg-bt-5" href="{{ $product->getUrl() }}">So sánh giá</a>
											<div class="count-store">của {{ $product->getTotalShop() }} cửa hàng</div>
										</div>
									</div>
								</div>
							</div>
						@empty
							<div class="col-sm-12">
								<div class="alert alert-info">Chưa có sản phẩm</div>
							</div>
						@endforelse
						<div class="col-sm-12">{!! pagination($products, $products->total(), $products->perPage(), Request::get('page'))  !!}</div>
					</div>
				</section>
		</div>
	</div>
@stop

@section('scripts')
<script>
	$(function() {
		$('.control-filter').change(function() {
			$('#form-filter').submit();
		});
	});
</script>
@stop