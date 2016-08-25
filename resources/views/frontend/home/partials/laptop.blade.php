<?php
    // Xác định tab nào đang là slider để custom controls prev, next
    // Phần này có liên quan đến đoạn xử lý slider
    // cẩn thận khi chỉnh sửa
    $sliderControlType = '';
    if($laptopGroup['status']['hot']) {
        $sliderControlType = 'hot';
    }
    elseif($laptopGroup['status']['have_more_shop']) {
        $sliderControlType = 'have-more-shop';
    }
    elseif($laptopGroup['status']['have_change_price']) {
        $sliderControlType = 'have-change-price';
    }
    elseif($laptopGroup['status']['new']) {
        $sliderControlType = 'newest';
    }
    elseif($laptopGroup['status']['have_more_question']) {
        $sliderControlType = 'care';
    }
?>
<div class="row mg-bt-30 mg-t-20 home-device-block">
    <div class="col-sm-12">
        {{-- <h3 class="hp-phone-block mg-bt-20">
            <a href="{{ route('laptop.index') }}" title="Đánh giá">Laptop</a>
            <div class="pull-right">
                <a href="javascript:;" class="custom-control-slider-product laptop {{ $sliderControlType }} prev pull-left btn-flat"><i class="fa fa-angle-left"></i></a>
                <a href="javascript:;" class="custom-control-slider-product last laptop {{ $sliderControlType }} next pull-left btn-flat"><i class="fa fa-angle-right"></i></a>
            </div>
        </h3> --}}
        <div class="row mg-bt-20">
            <div class="col-sm-12 relative">
                <div class="control-group">
                    <a href="javascript:;" class="custom-control-slider-product phone {{ $sliderControlType }} prev pull-left btn-flat"><i class="fa fa-angle-left"></i></a>
                    <a href="javascript:;" class="custom-control-slider-product last phone {{ $sliderControlType }} next pull-left btn-flat"><i class="fa fa-angle-right"></i></a>
                </div>
                <ul id="homepage-navtab-ul" class="product-device-tab nav nav-tabs" role="tablist">
                    <li class="active"><a href="javascript:;" class="main-tab laptop"><span>Laptop</span></a></li>
                    @if($laptopGroup['hot']->count() > 0)
                    <li role="presentation" class="{{ $laptopGroup['status']['hot'] ? 'active' : '' }}">
                        <a data-type="hot" data-device="laptop" class="navtab-item hot" href="#laptop-hot">
                            <span>Hot nhất</span>
                        </a>
                    </li>
                    @endif

                    @if($laptopGroup['have_more_shop']->count() > 0)
                    <li role="presentation" class="{{ $laptopGroup['status']['have_more_shop'] ? 'active' : '' }}">
                        <a data-type="have-more-shop" data-device="laptop" class="navtab-item have-more-shop" href="#laptop-have-more-shop">
                            <span>Nhiều người bán</span>
                        </a>
                    </li>
                    @endif

                    @if($laptopGroup['have_change_price']->count() > 0)
                    <li role="presentation" class="{{ $laptopGroup['status']['have_change_price'] ? 'active' : '' }}">
                        <a data-type="have-change-price" data-device="laptop" class="navtab-item have-change-price {{ $laptopGroup['have_more_shop']->count() == 0 ? 'active' : '' }}" href="#laptop-have-change-price">
                            <span>Mới thay đổi giá</span>
                        </a>
                    </li>
                    @endif

                    @if($laptopGroup['new']->count() > 0)
                    <li role="presentation" class="{{ $laptopGroup['status']['new'] ? 'active' : '' }}">
                        <a data-type="newest" data-device="laptop" class="navtab-item newest {{ $laptopGroup['have_change_price']->count() == 0 ? 'active' : '' }}" href="#laptop-newest">
                            <span>Mới</span>
                        </a>
                    </li>
                    @endif

                    @if($laptopGroup['have_more_question']->count() > 0)
                    <li role="presentation" class="{{ $laptopGroup['status']['have_more_question'] ? 'active' : '' }}">
                        <a data-type="care" data-device="laptop" class="navtab-item care {{ $laptopGroup['new']->count() == 0 ? 'active' : '' }}" href="#laptop-care">
                            <span>Quan tâm nhiều nhất</span>
                        </a>
                    </li>
                    @endif

                    <li class="clearfix"></li>
                </ul>
                <div class="tab-content pd-t-40">

                    @if($laptopGroup['hot']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $laptopGroup['status']['hot'] ? 'active' : '' }}" id="laptop-hot">
                        <div class="row">
                            <div class="device-carousel laptop hot">
                            @foreach($laptopGroup['hot'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($laptopGroup['have_more_shop']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $laptopGroup['status']['have_more_shop'] ? 'active' : '' }}" id="laptop-have-more-shop">
                        <div class="row">
                            <div class="device-carousel laptop have-more-shop">
                            @foreach($laptopGroup['have_more_shop'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($laptopGroup['have_change_price']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $laptopGroup['status']['have_change_price'] ? 'active' : '' }}" id="laptop-have-change-price">
                        <div class="row">
                            <div class="device-carousel laptop have-change-price">
                            @foreach($laptopGroup['have_change_price'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($laptopGroup['new']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $laptopGroup['status']['new'] ? 'active' : '' }}" id="laptop-newest">
                        <div class="row">
                            <div class="device-carousel laptop newest">
                            @foreach($laptopGroup['new'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($laptopGroup['have_more_question']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $laptopGroup['status']['have_more_question'] ? 'active' : '' }}" id="laptop-care">
                        <div class="row">
                            <div class="device-carousel laptop care">
                            @foreach($laptopGroup['have_more_question'] as $product)
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