<?php
    // Xác định tab nào đang là slider để custom controls prev, next
    // Phần này có liên quan đến đoạn xử lý slider
    // cẩn thận khi chỉnh sửa
    $sliderControlType = 'hot';
    if($phoneGroup['status']['hot']) {
        $sliderControlType = 'hot';
    }
    elseif($phoneGroup['status']['have_more_shop']) {
        $sliderControlType = 'have-more-shop';
    }
    elseif($phoneGroup['status']['have_change_price']) {
        $sliderControlType = 'have-change-price';
    }
    elseif($phoneGroup['status']['new']) {
        $sliderControlType = 'newest';
    }
    elseif($phoneGroup['status']['have_more_question']) {
        $sliderControlType = 'care';
    }
?>
<div id="home-phone-block" class="row mg-bt-30 mg-t-30 home-device-block">
    <div class="col-sm-12">
        {{-- <h3 class="hp-phone-block mg-bt-20">
            <a href="{{ route('phone.index') }}" title="Đánh giá">Điện thoại</a>
            <div class="pull-right">
                <a href="javascript:;" class="custom-control-slider-product phone {{ $sliderControlType }} prev pull-left btn-flat"><i class="fa fa-angle-left"></i></a>
                <a href="javascript:;" class="custom-control-slider-product last phone {{ $sliderControlType }} next pull-left btn-flat"><i class="fa fa-angle-right"></i></a>
            </div>
        </h3> --}}
        <div class="row mg-bt-20">
            <div class="col-sm-12 relative">
                <div class="control-group">
                    <a href="javascript:;" class="custom-control-slider-product phone {{ $sliderControlType }} prev pull-left btn-flat"><i class="fa fa-angle-left"></i></a>
                    <a href="javascript:;" class="custom-control-slider-product last phone {{ $sliderControlType }} next pull-left btn-flat"><i class="fa fa-angle-right"></i></a>
                </div>
                <ul id="homepage-navtab-ul" class="product-device-tab nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="javascript:;" class="main-tab phone"><span>Điện thoại</span></a>
                    </li>
                    @if($phoneGroup['hot']->count() > 0)
                    <li role="presentation" class="{{ $phoneGroup['status']['hot'] ? 'active' : '' }}">
                        <a data-type="hot" data-device="phone" class="navtab-item hot" href="#phone-hot">
                            <span>Hot nhất</span>
                        </a>
                    </li>
                    @endif

                    @if($phoneGroup['have_more_shop']->count() > 0)
                    <li role="presentation" class="{{ $phoneGroup['status']['have_more_shop'] ? 'active' : '' }}">
                        <a data-type="have-more-shop" data-device="phone" class="navtab-item have-more-shop" href="#phone-have-more-shop">
                            <span>Nhiều người bán</span>
                        </a>
                    </li>
                    @endif

                    @if($phoneGroup['have_change_price']->count() > 0)
                    <li role="presentation" class="{{ $phoneGroup['status']['have_change_price'] ? 'active' : '' }}">
                        <a data-type="have-change-price" data-device="phone" class="navtab-item have-change-price {{ $phoneGroup['have_more_shop']->count() == 0 ? 'active' : '' }}" href="#phone-have-change-price">
                            <span>Mới thay đổi giá</span>
                        </a>
                    </li>
                    @endif

                    @if($phoneGroup['new']->count() > 0)
                    <li role="presentation" class="{{ $phoneGroup['status']['new'] ? 'active' : '' }}">
                        <a data-type="newest" data-device="phone" class="navtab-item newest {{ $phoneGroup['have_change_price']->count() == 0 ? 'active' : '' }}" href="#phone-newest">
                            <span>Mới</span>
                        </a>
                    </li>
                    @endif

                    @if($phoneGroup['have_more_question']->count() > 0)
                    <li role="presentation" class="{{ $phoneGroup['status']['have_more_question'] ? 'active' : '' }}">
                        <a data-type="care" data-device="phone" class="navtab-item care {{ $phoneGroup['new']->count() == 0 ? 'active' : '' }}" href="#phone-care">
                            <span>Quan tâm nhiều nhất</span>
                        </a>
                    </li>
                    @endif

                    <li class="clearfix"></li>
                </ul>
                <div class="tab-content pd-t-40">

                    @if($phoneGroup['hot']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $phoneGroup['status']['hot'] ? 'active' : '' }}" id="phone-hot">
                        <div class="row">
                            <div class="device-carousel phone hot">
                            @foreach($phoneGroup['hot'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($phoneGroup['have_more_shop']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $phoneGroup['status']['have_more_shop'] ? 'active' : '' }}" id="phone-have-more-shop">
                        <div class="row">
                            <div class="device-carousel phone have-more-shop">
                            @foreach($phoneGroup['have_more_shop'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($phoneGroup['have_change_price']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $phoneGroup['status']['have_change_price'] ? 'active' : '' }}" id="phone-have-change-price">
                        <div class="row">
                            <div class="device-carousel phone have-change-price">
                            @foreach($phoneGroup['have_change_price'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($phoneGroup['new']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $phoneGroup['status']['new'] ? 'active' : '' }}" id="phone-newest">
                        <div class="row">
                            <div class="device-carousel phone newest">
                            @foreach($phoneGroup['new'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($phoneGroup['have_more_question']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $phoneGroup['status']['have_more_question'] ? 'active' : '' }}" id="phone-care">
                        <div class="row">
                            <div class="device-carousel phone care">
                            @foreach($phoneGroup['have_more_question'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-3 hide">

        @foreach($GLB_ads as $value)
            @if($value->position == CENTER_PAGE_1)
                <a class="advertise" data-id="{{ $value->id }}" href="{{ $value->link }}" title="{{ $value->title }}">
                    <img class="img-responsive" src="{{ ($value->banner != '/images/ads.jpg') ? PATH_IMAGE_ADVERTISE. $value->banner : $value->banner }}" alt="{{ $value->title }}">
                </a>
            @endif
        @endforeach
        <br>
        @foreach($GLB_ads as $value)
            @if($value->position == CENTER_PAGE_2)
                <a class="advertise" data-id="{{ $value->id }}" href="{{ $value->link }}" title="{{ $value->title }}">
                    <img class="img-responsive" src="{{ ($value->banner != '/images/ads.jpg') ? PATH_IMAGE_ADVERTISE. $value->banner : $value->banner }}" alt="{{ $value->title }}">
                </a>
            @endif
        @endforeach

    </div>
</div>