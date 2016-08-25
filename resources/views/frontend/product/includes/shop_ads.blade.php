<div id="shop-ads-auction" class="mg-bt-10">
@foreach($shopAds as $priceItem)
    <div class="shop-ads-color-ads price-items-table">
        <div id="shop-{{ $priceItem->shop_id }}" class="row">
            <div class="col-sm-2 hidden-xs">
                <a class="shop-link-img" href="javascript:;" title="{{ $priceItem->shop_name }}">
                    <img onerror="noImage(this)" src="{{ $priceItem->shop_logo }}" alt="{{ $priceItem->shop_name }}" class="img-responsive">
                </a>
                <span class="shop-ads-qc">QC</span>
                <span class="shop-link-text">{{ $priceItem->shop_url }}</span>
            </div>
            <div class="col-sm-10">

                <div class="item-infomation first">
                    <div class="row">
                        <div class="col-sm-5">
                            <div>
                                <h3 class="item-name">
                                    <a data-id="{{ $product->getId() }}" data-priceId="{{ $priceItem->getId() }}" data-shop="{{ $priceItem->getSource() }}" href="{{ route('redirect', [$product->getId(), $priceItem->getId()]) }}">{{ $priceItem->getProductName() }}</a>
                                </h3>
                                <span class="item-link">{{ $priceItem->getOriginLink() }}</span>
                                <div class="item-time">Cập nhật lúc: {{ $priceItem->getCrawledTimeStr() }}</div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="item-price">{{ $priceItem->getPriceStr() }}</div>
                        </div>
                        <div class="col-sm-2">
                            @if( $priceItem->count_items > 1 )
                                <div data-shop="{{ $priceItem->shop_id }}" data-price_id="{{ $priceItem->id }}" data-productId="{{ $product->getId() }}" data-source="{{ $priceItem->shop_name }}" data-total_product_viewmore="{{ $priceItem->count_items - 1 }}" class="item-viewmore text-center">
                                    <span class="viewmore-text btn btn-default" data-text-old="{{ $priceItem->count_items - 1 }} sản phẩm" >{{ $priceItem->count_items - 1 }} sản phẩm <i class="fa fa-angle-down"></i></span>
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-2">
                            <a class="block btn btn-sm btn-store goto-shop-link shop-ads-go-to-link" data-id="{{ $product->getId() }}" data-priceId="{{ $priceItem->getId() }}" data-shop="{{ $priceItem->getSource() }}" data-shopid="{{ $priceItem->shop_id }}" data-auc="{{ $priceItem->auction_id }}" href="{{ route('redirect', [$product->getId(), $priceItem->getId()]) }}" target="_blank">Đến nơi bán</a>
                        </div>

                        <div class="col-sm-1">
                            <a href="javascript:;" data-priceName="{{ $priceItem->getProductName() }}" data-price="{{ $priceItem->getPriceStr() }}" data-priceId="{{ $priceItem->getId() }}" class="btn-action-wrong-price block btn-wrong-price"><i class="fa fa-bell-o"></i> Báo lỗi</a>
                        </div>
                    </div>
                </div>

                <div id="viewmore-placement-{{ $priceItem->shop_id }}" class="hide"></div>
            </div>

        </div>
    </div>
@endforeach
</div>