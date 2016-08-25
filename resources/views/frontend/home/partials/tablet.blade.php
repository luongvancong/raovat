<?php
    // Xác định tab nào đang là slider để custom controls prev, next
    // Phần này có liên quan đến đoạn xử lý slider
    // cẩn thận khi chỉnh sửa
    $sliderControlType = 'hot';
    if($tabletGroup['status']['hot']) {
        $sliderControlType = 'hot';
    }
    elseif($tabletGroup['status']['have_more_shop']) {
        $sliderControlType = 'have-more-shop';
    }
    elseif($tabletGroup['status']['have_change_price']) {
        $sliderControlType = 'have-change-price';
    }
    elseif($tabletGroup['status']['new']) {
        $sliderControlType = 'newest';
    }
    elseif($tabletGroup['status']['have_more_question']) {
        $sliderControlType = 'care';
    }
?>
<div class="row mg-bt-30 mg-t-20 home-device-block">
    <div class="col-sm-12">
        {{-- <h3 class="hp-phone-block mg-bt-20">
            <a href="{{ route('tablet.index') }}" title="Đánh giá">Máy tính bảng</a>
            <div class="pull-right">
                <a href="javascript:;" class="custom-control-slider-product tablet {{ $sliderControlType }} prev pull-left btn-flat"><i class="fa fa-angle-left"></i></a>
                <a href="javascript:;" class="custom-control-slider-product last tablet {{ $sliderControlType }} next pull-left btn-flat"><i class="fa fa-angle-right"></i></a>
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
                        <a href="javascript:;" class="main-tab tablet"><span>Máy tính bảng</span></a>
                    </li>
                    @if($tabletGroup['hot']->count() > 0)
                    <li role="presentation" class="{{ $tabletGroup['status']['hot'] ? 'active' : '' }}">
                        <a data-type="hot" data-device="tablet" class="navtab-item hot" href="#tablet-hot">
                            <span>Hot nhất</span>
                        </a>
                    </li>
                    @endif

                    @if($tabletGroup['have_more_shop']->count() > 0)
                    <li role="presentation" class="{{ $tabletGroup['status']['have_more_shop'] ? 'active' : '' }}">
                        <a data-type="have-more-shop" data-device="tablet" class="navtab-item have-more-shop" href="#tablet-have-more-shop">
                            <span>Nhiều người bán</span>
                        </a>
                    </li>
                    @endif

                    @if($tabletGroup['have_change_price']->count() > 0)
                    <li role="presentation" class="{{ $tabletGroup['status']['have_change_price'] ? 'active' : '' }}">
                        <a data-type="have-change-price" data-device="tablet" class="navtab-item have-change-price {{ $tabletGroup['have_more_shop']->count() == 0 ? 'active' : '' }}" href="#tablet-have-change-price">
                            <span>Mới thay đổi giá</span>
                        </a>
                    </li>
                    @endif

                    @if($tabletGroup['new']->count() > 0)
                    <li role="presentation" class="{{ $tabletGroup['status']['new'] ? 'active' : '' }}">
                        <a data-type="newest" data-device="tablet" class="navtab-item newest {{ $tabletGroup['have_change_price']->count() == 0 ? 'active' : '' }}" href="#tablet-newest">
                            <span>Mới</span>
                        </a>
                    </li>
                    @endif

                    @if($tabletGroup['have_more_question']->count() > 0)
                    <li role="presentation" class="{{ $tabletGroup['status']['have_more_question'] ? 'active' : '' }}">
                        <a data-type="care" data-device="tablet" class="navtab-item care {{ $tabletGroup['new']->count() == 0 ? 'active' : '' }}" href="#tablet-care">
                            <span>Quan tâm nhiều nhất</span>
                        </a>
                    </li>
                    @endif

                    <li class="clearfix"></li>
                </ul>
                <div class="tab-content pd-t-40">

                    @if($tabletGroup['hot']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $tabletGroup['status']['hot'] ? 'active' : '' }}" id="tablet-hot">
                        <div class="row">
                            <div class="device-carousel tablet hot">
                            @foreach($tabletGroup['hot'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($tabletGroup['have_more_shop']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $tabletGroup['status']['have_more_shop'] ? 'active' : '' }}" id="tablet-have-more-shop">
                        <div class="row">
                            <div class="device-carousel tablet have-more-shop">
                            @foreach($tabletGroup['have_more_shop'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($tabletGroup['have_change_price']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $tabletGroup['status']['have_change_price'] ? 'active' : '' }}" id="tablet-have-change-price">
                        <div class="row">
                            <div class="device-carousel tablet have-change-price">
                            @foreach($tabletGroup['have_change_price'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($tabletGroup['new']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $tabletGroup['status']['new'] ? 'active' : '' }}" id="tablet-newest">
                        <div class="row">
                            <div class="device-carousel tablet newest">
                            @foreach($tabletGroup['new'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($tabletGroup['have_more_question']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $tabletGroup['status']['have_more_question'] ? 'active' : '' }}" id="tablet-care">
                        <div class="row">
                            <div class="device-carousel tablet care">
                            @foreach($tabletGroup['have_more_question'] as $product)
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
</div>