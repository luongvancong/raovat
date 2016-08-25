@extends('frontend/layout/default')

@section('content')
<div class="col-sm-12">
	<div class="main-primary">
		<section class="contentOuter listProducts">
			<div class="row">
				<div class="col-sm-12">
					<div class="page-head">
						<h1 class="page-head-block">So sánh sản phẩm</h1>
					</div>
				</div>
			</div>
		</section>
	</div>

	<div class="table-compare pd-t-10">
		@if(!$products->isEmpty())
		<div class="row">
			<div class="col-sm-12">
				<div class="text-right" style="margin-bottom:20px">
					<a href="/" class="btn btn-defaul btn-sm">Quay lại trang chủ</a>
					<a href="{{ route('compare.clear') }}" class="bt btn-sm btn-danger">Xóa sạch so sánh</a>
				</div>
			</div>
		</div>
		@endif

		<div class="row">
		@if(!$products->isEmpty())
			<div class="col-sm-12">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>Sản phẩm</td>
							@foreach($products as $product)
							<td><b class="text-danger">{{ $product->getName() }}</b></td>
							@endforeach
						</tr>

						<tr>
							<td>Giá thấp nhất</td>
							@foreach($products as $product)
							<td>{{ $product->getPriceStr() }}đ</td>
							@endforeach
						</tr>

						<tr>
							<td>Thông số kỹ thuật</td>
							@foreach($products as $product)
							<td>{!! $product->getSpec() !!}</td>
							@endforeach
						</tr>
					</tbody>
				</table>
			</div>
		@else
			<div class="col-sm-12">
				<div class="alert alert-info">
					Chưa có sản phẩm nào, click <a href="/">vào đây</a> để quay lại trang chủ
				</div>
			</div>
		@endif
		</div>
	</div>
</div>
@stop