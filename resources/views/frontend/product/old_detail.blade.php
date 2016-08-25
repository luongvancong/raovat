@extends('frontend/layout/master')

@section('content')
	<div class="row">
		<h1 class="pdt-product-name">{{ $product->getName() }}</h1>
		{{-- <div class="text-left">Giá bán: <b class="text-danger pdt-price">{{ $product->getPriceStr() }}đ</b></div> --}}
		<div class="col-sm-7">
			<div class="page-header">
				<h3>Thông số sản phẩm</h3>
			</div>
			<div class="col-sm-4">
				<div class="text-center">
					<img class="img-rounded img-responsive" src="{{ $product->getImage() }}" alt="{{ $product->getName() }}">
				</div>
				<div class="pdt-small-img">
					<ul class="list-unstyled">
						@for($i = 0; $i <= 5; $i ++)
						<li>
							<a href="#" class="simg-link">
								<img src="/images/grey.gif" class="simg-img">
							</a>
						</li>
						@endfor
						<li class="clearfix"></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-8">
				<div>{!! $product->getSpec() !!}</div>
			</div>
		</div>
		<div class="col-sm-5">
			<div class="price-compare">
				<div class="page-header">
					<h3>So sánh giá</h3>
				</div>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Sản phẩm</th>
							<th>Giá tham khảo</th>
							<th>Cập nhật lúc</th>
							<th>Chi tiết</th>
						</tr>
					</thead>
					<tbody>
						@foreach($prices['items'] as $storeName => $priceStores)
							<tr><td colspan="4"><a href="http://{{ $storeName }}" rel="nofollow" target="_blank">{{ $storeName }}</a></td></tr>
							@foreach ($priceStores as $price)
								<tr>
									<td>{{ $price->getProductName() }}</td>
									<td>{{ $price->getPriceStr() }}đ</td>
									<td>{{ $price->getTimeUpdated() }}</td>
									<td><a href="{{ $price->getOriginLink() }}" target="_blank">Đến nơi bán</a></td>
								</tr>
							@endforeach
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="pdt-posts">
				<div class="page-header">
					<h3>Tin tức liên quan</h3>
				</div>
				<ul class="list-unstyled">
					@forelse($posts as $post)
						<li><a href="{{ $post->getUrl() }}" title="{{ $post->getTitle() }}">&bullet; {{ $post->getTitle() }}</a></li>
					@empty
						<li>Chưa có tin tức</li>
					@endforelse
				</ul>
			</div>

			<div class="pdt-videos">
				<div class="page-header">
					<h3>Video liên quan</h3>
				</div>
				<ul class="list-unstyled">
				@forelse($videos as $video)
					<li><a href="{{ $video->getUrl() }}" title="{{ $video->getTitle() }}">&bullet; {{ $video->getTitle() }}</a></li>
				@empty
					<li>Chưa có tin tức</li>
				@endforelse
				</ul>
			</div>
		</div>

	</div>

	<div class="container">
		<div class="page-header">
			<h3>Sản phẩm tương tự</h3>
		</div>
		<div class="row">
			@foreach($relatedProducts as $p)
				<div class="col-sm-2 text-center">
					<div class="pro-item">
						<a class="pro-img" href="{{ $p->getUrl() }}" title="{{ $p->getName() }}">
							<img class="img-rounded img-responsive" src="{{ $p->getImage() }}" alt="{{ $p->getName() }}">
						</a>

						<a class="pro-link" href="{{ $p->getUrl() }}" title="{{ $p->getName() }}" >{{ $p->getName() }}</a>
						<p class="text-danger" title="{{ $p->getPriceStr() }}">{{ $p->getPriceStr() }}đ</p>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@stop