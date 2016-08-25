<div class="col-sm-4">
	<div class="product-item">
		<a class="pro-img" href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">
			<span style="background: url({{ $product->getImage() }}) center center no-repeat; display: block; overflow: hidden; background-size: contain; height: 100%;"></span>
			{{-- <img class="img-rounded img-responsive" src="{{ $product->getImage() }}" alt="{{ $product->getName() }}"> --}}
		</a>
		<div class="product-metadata clearfix">
			<div class="product-info">
				<h2>
					<a class="product-name text-center" href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">{{ $product->getName() }}</a>
				</h2>
			</div>
		</div>
		<div class="product-price-item clearfix">
			<div class="product-price-min text-center">
				<span class="text-muted"><span class="product-price text-color-red"> {{ $product->getPriceStr() }} <sup>đ</sup></span></span>
			</div>
			<div class="count-store text-center mg-bt-10">
                {{ $product->count_store }} cửa hàng bán
            </div>
			<a href="{{ $product->getUrl() }}" class="btn-buttom btn btn-md btn-readmore" title="Xem chi tiết"> So sánh giá </a>
		</div>
	</div>
</div>