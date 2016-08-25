@extends('frontend/product/newest_list')

@section('layout')
<div class="row pd-t-40">
    @foreach ($products as $product)
        <div class="col-sm-6 mg-bt-20">
            <div class="row product-item product-brand">
                <div class="col-sm-12 col-xs-12 mg-bt-20">
                    <a class="text-center link-img" href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">
                        <img class="img-responsive" src="{{ $product->getImage() }}" alt="{{ $product->getName() }}" onerror="this.src='/images/grey.gif'">
                    </a>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <h2 class="name text-center">
                        <a href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">
                            {{ $product->getName() }}
                        </a>
                    </h2>

                    <div class="rating">
                        {!! $product->presenter()->getStar() !!}
                    </div>

                    <div class="other-info">
                        <div class="other-info-inner row">
                            <div class="col-sm-12">
                                <div class="border-line"></div>
                            </div>
                            <div class="count-shop text-center col-sm-6">
                                Có {{ $product->getTotalShop() }} cửa hàng bán
                            </div>
                            <div class="price-inner text-center col-sm-6">
                               Giá: <span class="product-price text-color-red">{{ $product->getPriceStr() }}</span>
                            </div>
                            <div class="col-sm-12">
                                <div class="border-line"></div>
                            </div>
                        </div>
                    </div>

                    <p class="teaser visible-xs text-center">
                        Sản phẩm {{ $product->getName() }} của {{ $product->getTotalShop() }} cửa hàng - Giá thấp nhất
                    </p>

                    <p class="teaser hidden-xs text-center">
                        Sản phẩm {{ $product->getName() }}, thông tin sản phẩm {{ $product->getName() }}, so sánh giá sản phẩm {{ $product->getName() }}
                    </p>

                    <div class="controls text-center">
                        <a target="_blank" href="{{ $product->getUrl() }}" class="btn btn-md btn-black inline-block" title="Xem chi tiết">So sánh giá</a>
                        <a target="_blank" href="{{ route('compare.addProduct', [$product->getId()]) }}" class="btn btn-md btn-white inline-block" title="Thêm vào so sánh">Thêm vào so sánh</a>
                        <div class="clearfix"></div>
                    </div>

                </div>

            </div>
        </div>
    @endforeach
</div>
@stop