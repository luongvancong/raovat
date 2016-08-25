@extends('frontend/layout/default')

@section('styles')

@stop

@section('content')

    {{-- BREADCRUMB --}}
    @section('breadcrumb')
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', '/') !!}
            {!! getBreadcrumbItem('Sản phẩm', route('product.newest'), true) !!}
        </ol>
    @show
    {{-- END BREADCRUMB --}}

    {{-- DEVICE TAB --}}
    @section('device_tabs')
    <div class="row mg-bt-20">
        <div class="col-sm-12">
            <a href="{{ route('laptop.index') }}" class="btn {{ Request::is('laptop') ? 'btn-info' : 'btn-default' }}"><i class="fa fa-laptop"></i> Laptop <span class="badge">{{ App::make('Nht\Hocs\Products\ProductRepository')->countLaptop() }}</span></a>
            <a href="{{ route('phone.index') }}" class="btn {{ Request::is('dien-thoai') ? 'btn-danger' : 'btn-default' }}"><i class="fa fa-mobile-phone"></i> Điện thoại <span class="badge">{{ App::make('Nht\Hocs\Products\ProductRepository')->countPhone() }}</span></a>
            <a href="{{ route('tablet.index') }}" class="btn {{ Request::is('may-tinh-bang') ? 'btn-warning' : 'btn-default' }}"><i class="fa fa-tablet"></i> Máy tính bảng <span class="badge">{{ App::make('Nht\Hocs\Products\ProductRepository')->countTablet() }}</span></a>
            <a href="{{ route('camera.index') }}" class="btn {{ Request::is('may-anh') ? 'btn-success' : 'btn-default' }}"><i class="fa fa-camera-retro"></i> Máy ảnh <span class="badge">{{ App::make('Nht\Hocs\Products\ProductRepository')->countCamera() }}</span></a>
        </div>
    </div>
    @show
    {{-- END DEVICE TAB --}}

    <div class="row">

        @if(isset($brand) && $brand->description)
        <div class="col-sm-12 pd-bt-20">
            {!! $brand->description !!}
        </div>
        @endif

        <div class="col-sm-3">
            {{-- BRAND SIDEBAR --}}
            @section('brand_sidebar')
            <div class="sidebar">
                <h3 class="spp-hsx">
                    Thương hiệu
                </h3>

                <div class="fsearch-hsx">
                    <input id="hsx-search-inp" data-current_id="{{ $requestId }}" type="text" name="q" placeholder="Thương hiệu" class="form-control btn-flat inp">
                    <i class="fa fa-search"></i>
                </div>

                <ul id="hsx-list-sidebar" class="hsx-list-sidebar scrollup list-unstyled mg-t-15">
                    @foreach($GLB_Brands as $b)
                        @if($b->getTotalProducts() > 0)
                            {!! $b->htmlPresenter()->getItem($requestId) !!}
                        @endif
                    @endforeach
                </ul>
                <div class="viewmore-hsx action-viewmore-hsx mg-t-10">Xem thêm</div>
            </div>
            @show
            {{-- END BRAND SIDEBAR --}}
        </div>

        <div class="col-sm-9">
            <div class="main-primary">
                <section class="contentOuter listProducts">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-head">
                                <div class="pull-right hidden-xs" style="margin-bottom: 2px;">
                                    <div class="sort pull-left mg-r-5">
                                        @foreach($arraySort as $key => $value)
                                            <a href="{{ url_add_params(['sort' => $key]) }}" class="btn btn-sm {{ Request::get('sort') == $key ? 'btn-giaca' : 'btn-default' }}">{{ $value }}</a>
                                        @endforeach
                                    </div>
                                    <div class="layout-icon pull-left">
                                        <span class="item list action-layout {{ Request::get('layout', 'list') == 'list' ? 'active' : '' }}" data-layout="list"><i class="fa fa-list-ul"></i></span>
                                        <span class="item grid action-layout {{ Request::get('layout', 'list') == 'grid' ? 'active' : '' }}" data-layout="grid"><i class="fa fa-th-large"></i></span>
                                    </div>
                                </div>
                            </h3>
                        </div>
                    </div>

                    {{-- LAYOUT --}}
                    @section('layout')
                    <div class="row pd-t-40" id="product-listing">
                        @foreach ($products as $product)
                            {!! $product->presenter()->getItemDetail() !!}
                        @endforeach
                    </div>
                    @show
                    {{-- END LAYOUT --}}

                    <div class="row">
                        <div id="pl-loading" class="text-center"></div>
                        <div id="button-load-more" class="text-center">
                            <?php
                                $currentPage = (int) Request::get('page', 1);
                                $params = Request::all();
                                $params['page'] = $currentPage + 1;
                            ?>
                            <a id="btn-link-view-more" href="/{{ Request::path() . '?' . http_build_query($params) }}" class="btn btn-md btn-giaca">Xem thêm</a>
                        </div>
                        <div id="paginator-wrapper" class="col-sm-12 text-center">{!! pagination($products, $products->total(), $products->perPage())  !!}</div>
                    </div>

                </section>
        </div>
    </div>
@stop

@section('scripts')
<script>
    var BrandConfigs = {
        'ajax_find_brand' : '{{ route('ajax.find.brand') }}',
        'url_load_more' : '{{ URL::full() }}'
    };
</script>
{{-- <script src="js/jquery_scrollpagination.js"></script> --}}
<script src="/bower_components/jquery-infinite-scroll/jquery.infinitescroll.js"></script>
<script src="/js/product.js"></script>
@stop