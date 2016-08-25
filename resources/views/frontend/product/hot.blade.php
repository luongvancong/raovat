@extends('frontend/layout/default')

@section('content')
	<div class="row">

		<div class="col-sm-3">
			<div class="sidebar">
				<div class="box-site box-white box-sidebar">
					<h3 class="box-heading bg-color text-color-white title-heading-global">
						<i class="fa fa-search"></i>
						Lọc sản phẩm
					</h3>
					<ul class="list-unstyled">
						<li>
							<a href="{{ url_add_params(['sort' => 'newest']) }}">Mới nhất</a>
						</li>
						{{-- <li>
							<a href="{{ url_add_params(['sort' => 'price_asc']) }}">Giá tăng dần</a>
						</li> --}}
						<li>
							<a href="{{ url_add_params(['sort' => 'name_asc']) }}">Sắp xếp theo Alphabet</a>
						</li>
					</ul>
				</div>

				<div class="box-site box-white box-sidebar">
					<h3 class="box-heading bg-color text-color-white title-heading-global">
						<i class="fa fa-delicious"></i>
						Hãng sản xuất
					</h3>
					<ul class="list-unstyled">
						@foreach($GLB_Brands as $brand)
						<li class="{{ isset($brandName) && $brandName == strtolower($brand->getName()) ? 'active' : '' }}">
							<a href="{{ url_add_params(['brand' => strtolower($brand->getName())]) }}">{{ $brand->getName() }} ({{ \App::make('Nht\Hocs\Products\ProductRepository')->countProductsByBrand($brand) }}) <i class="fa fa-angle-right pull-right"></i></a>
						</li>
						@endforeach
					</ul>
				</div>

			</div>
		</div>

		<div class="col-sm-9">
			<div class="main-primary">
				<section class="contentOuter listProducts">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="bg-heading text-color-blue bg-color title-heading-global">Sản phẩm hot nhất</h3>
						</div>
					</div>
					<div class="row">
						@forelse ($products as $product)
							@include('frontend/product/product-item')
						@empty
							<div class="col-sm-12">
								<div class="alert alert-info">Chưa có sản phẩm</div>
							</div>
						@endforelse
						<div class="col-sm-12">{!! pagination($products, $products->total(), $products->perPage())  !!}</div>
					</div>
				</section>
		</div>
	</div>
@stop