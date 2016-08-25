@if(isset($dbProductPrices))
    @foreach($dbProductPrices as $priceItem)

        <div class="item-infomation border">
            <div class="row">
                <div class="col-sm-6">
                    <div>
                        <h3 class="item-name">{{ $priceItem->getProductName() }}</h3>
                        <span class="item-link">{{ $priceItem->getOriginLink() }}</span>
                        <div class="item-time">Cập nhật lúc: {{ $priceItem->getCrawledTimeStr() }}</div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="item-price">{{ $priceItem->getPriceStr() }}</div>
                </div>

                <div class="col-sm-2">
                    <a class="btn block btn-sm btn-store goto-shop-link" data-id="{{ $product->getId() }}" data-priceId="{{ $priceItem->getId() }}" data-shop="{{ $priceItem->getSource() }}" href="{{ route('redirect', [$product->getId(), $priceItem->getId()]) }}" target="_blank">Đến nơi bán</a>
                </div>

               {{--  <div class="col-sm-1">
                    <a href="javascript:;" data-priceName="{{ $priceItem->getProductName() }}" data-price="{{ $priceItem->getPriceStr() }}" data-priceId="{{ $priceItem->getId() }}" class="btn-action-wrong-price block btn-wrong-price"><i class="fa fa-bell-o"></i> Báo lỗi</a>
                </div> --}}
            </div>
        </div>

    @endforeach

@endif
