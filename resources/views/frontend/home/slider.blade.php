<div id="owl-slider-container" class="hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="home-slider" class="owl-carousel owl-theme">
                    @foreach($slideItems as $item)
                    <div class="item">
                        <a href="{{ $item->getUrl() }}" title="{{ $item->getName() }}" class="slide-link row">
                            <div class="col-sm-5">
                                <img src="{{ $item->getImage() }}" alt="{{ $item->getName() }}">
                            </div>
                            <div class="col-sm-7">
                                <h2 class="slide-title">{{ $item->getName() }}</h2>
                                <p class="slide-teaser"> {{ cutString(strip_tags($item->getSpec(), 160)) }} </p>
                                <p class="count-store">{{ $item->getTotalShop() }} cửa hàng</p>

                                <div class="table-responsive">
                                    <table class="table-price-banner table-bordered table">
                                        <tr>
                                        @foreach($item->shops as $shop)
                                            <td class="heading">{{ $shop->getName() }}</td>
                                        @endforeach
                                        </tr>
                                        <tr>
                                        @foreach($item->shops as $shop)
                                            <td class="price">{{ formatCurrency($shop->price->price) }}</td>
                                        @endforeach
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>