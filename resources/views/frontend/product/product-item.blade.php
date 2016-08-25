<div class="col-sm-4 col-xs-4">
    <div class="product-item">
        <a class="pro-img" href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">
            {{-- <span style="background: url({{ $product->getImage() }}) center center no-repeat; display: block; overflow: hidden; background-size: contain; height: 100%;"></span> --}}
            <img class="img-rounded img-responsive" src="{{ $product->getImage() }}" alt="{{ $product->getName() }}">
        </a>
        <div class="product-metadata clearfix">
            <div class="hidden-sm hidden-md hidden-lg product-mobile-name">{{ $product->getName() }}</div>
            <div class="product-info hidden-xs">
                <h2>
                    <a class="product-name" href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">{{ $product->getName() }}</a>
                </h2>
                <div class="count-store text-center">Có {{ $product->getTotalShop() }} cửa hàng bán</div>
            </div>
            <div class="pull-right product-like hide hidden-xs">
                <span class="product-comment">
                    <i class="fa fa-comment-o text-color-blue"></i> {{ rand(0, 10) }}
                </span>
                <span class="product-like">
                    <i class="fa fa-heart-o text-color-red"></i> {{ rand(1, 100) }}
                </span>
            </div>
            <div class="product-price-item clearfix">
                <div class="product-price-min text-center">
                    <span class="text-muted">Giá tham khảo: <span class="product-price text-color-red"> {{ $product->getPriceStr() }} <sup>đ</sup></span></span>
                </div>
                <a href="{{ $product->getUrl() }}" class="btn-buttom btn btn-md btn-readmore" title="Xem chi tiết">So sánh giá</a>
            </div>
        </div>
    </div>
</div>