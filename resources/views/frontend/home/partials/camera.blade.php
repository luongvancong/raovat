<?php
    // Xác định tab nào đang là slider để custom controls prev, next
    // Phần này có liên quan đến đoạn xử lý slider
    // cẩn thận khi chỉnh sửa
    $sliderControlType = '';
    if($cameraGroup['status']['hot']) {
        $sliderControlType = 'hot';
    }
    elseif($cameraGroup['status']['have_more_shop']) {
        $sliderControlType = 'have-more-shop';
    }
    elseif($cameraGroup['status']['have_change_price']) {
        $sliderControlType = 'have-change-price';
    }
    elseif($cameraGroup['status']['new']) {
        $sliderControlType = 'newest';
    }
    elseif($cameraGroup['status']['have_more_question']) {
        $sliderControlType = 'care';
    }

    // Chỉnh sửa nd này cho phù hợp với từng loại thiết bị
    $device = 'camera';
?>
<div class="row mg-bt-30 mg-t-20 home-device-block">
    <div class="col-sm-12">
        {{-- <h3 class="hp-phone-block mg-bt-20">
            <a href="{{ route('camera.index') }}" title="Máy ảnh">Máy ảnh</a>
            <div class="pull-right">
                <a href="javascript:;" class="custom-control-slider-product {{ $device }} {{ $sliderControlType }} prev pull-left btn-flat"><i class="fa fa-angle-left"></i></a>
                <a href="javascript:;" class="custom-control-slider-product last {{ $device }} {{ $sliderControlType }} next pull-left btn-flat"><i class="fa fa-angle-right"></i></a>
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
                        <a href="javascript:;" class="main-tab camera"><span>Máy ảnh</span></a>
                    </li>
                    @if($cameraGroup['hot']->count() > 0)
                    <li role="presentation" class="{{ $cameraGroup['status']['hot'] ? 'active' : '' }}">
                        <a data-type="hot" data-device="{{ $device }}" class="navtab-item hot" href="#{{ $device }}-hot">
                            <span>Hot nhất</span>
                        </a>
                    </li>
                    @endif

                    @if($cameraGroup['have_more_shop']->count() > 0)
                    <li role="presentation" class="{{ $cameraGroup['status']['have_more_shop'] ? 'active' : '' }}">
                        <a data-type="have-more-shop" data-device="{{ $device }}" class="navtab-item have-more-shop" href="#{{ $device }}-have-more-shop">
                            <span>Nhiều người bán</span>
                        </a>
                    </li>
                    @endif

                    @if($cameraGroup['have_change_price']->count() > 0)
                    <li role="presentation" class="{{ $cameraGroup['status']['have_change_price'] ? 'active' : '' }}">
                        <a data-type="have-change-price" data-device="{{ $device }}" class="navtab-item have-change-price {{ $cameraGroup['have_more_shop']->count() == 0 ? 'active' : '' }}" href="#{{ $device }}-have-change-price">
                            <span>Mới thay đổi giá</span>
                        </a>
                    </li>
                    @endif

                    @if($cameraGroup['new']->count() > 0)
                    <li role="presentation" class="{{ $cameraGroup['status']['new'] ? 'active' : '' }}">
                        <a data-type="newest" data-device="{{ $device }}" class="navtab-item newest {{ $cameraGroup['have_change_price']->count() == 0 ? 'active' : '' }}" href="#{{ $device }}-newest">
                            <span>Mới</span>
                        </a>
                    </li>
                    @endif

                    @if($cameraGroup['have_more_question']->count() > 0)
                    <li role="presentation" class="{{ $cameraGroup['status']['have_more_question'] ? 'active' : '' }}">
                        <a data-type="care" data-device="{{ $device }}" class="navtab-item care {{ $cameraGroup['new']->count() == 0 ? 'active' : '' }}" href="#{{ $device }}-care">
                            <span>Quan tâm nhiều nhất</span>
                        </a>
                    </li>
                    @endif

                    <li class="clearfix"></li>
                </ul>
                <div class="tab-content pd-t-40">

                    @if($cameraGroup['hot']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $cameraGroup['status']['hot'] ? 'active' : '' }}" id="{{ $device }}-hot">
                        <div class="row">
                            <div class="device-carousel {{ $device }} hot">
                            @foreach($cameraGroup['hot'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($cameraGroup['have_more_shop']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $cameraGroup['status']['have_more_shop'] ? 'active' : '' }}" id="{{ $device }}-have-more-shop">
                        <div class="row">
                            <div class="device-carousel {{ $device }} have-more-shop">
                            @foreach($cameraGroup['have_more_shop'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($cameraGroup['have_change_price']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $cameraGroup['status']['have_change_price'] ? 'active' : '' }}" id="{{ $device }}-have-change-price">
                        <div class="row">
                            <div class="device-carousel {{ $device }} have-change-price">
                            @foreach($cameraGroup['have_change_price'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($cameraGroup['new']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $cameraGroup['status']['new'] ? 'active' : '' }}" id="{{ $device }}-newest">
                        <div class="row">
                            <div class="device-carousel {{ $device }} newest">
                            @foreach($cameraGroup['new'] as $product)
                                {!! $product->presenter()->getItem(['container_class' => 'col-lg-4 col-sm-4 col-xs-12 mg-bt-40 item-container']) !!}
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($cameraGroup['have_more_question']->count() > 0)
                    <div role="tabpanel" class="tab-pane {{ $cameraGroup['status']['have_more_question'] ? 'active' : '' }}" id="{{ $device }}-care">
                        <div class="row">
                            <div class="device-carousel {{ $device }} care">
                            @foreach($cameraGroup['have_more_question'] as $product)
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