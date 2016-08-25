<div class="row mg-bt-40">
    <div class="col-sm-12">
        <div class="page-head">
            <h4 class="page-head-block">Cửa hàng mới nhất</h2>
            <div class="pull-right">
                <a href="javascript:;" class="custom-control-slider shop newest prev pull-left btn-flat"><i class="fa fa-angle-left"></i></a>
                <a href="javascript:;" class="custom-control-slider shop last newest next pull-left btn-flat"><i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <div id="shop-newest-slider" class="mg-t-20">
                @foreach($newestShops as $shop)
                    <div class="col-sm-2 col-xs-4 mg-bt-5">
                        <div class="shop-item">
                            <a href="#" class="shop-item-link" title="{{ $shop->getName() }}">
                                <img class="shop-item-image" src="{{ $shop->getImage() }}" alt="{{ $shop->getName() }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>