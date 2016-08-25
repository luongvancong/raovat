@extends('frontend/product/newest_list')


{{-- BREADCRUMB --}}
@section('breadcrumb')
    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        {!! getBreadcrumbItem('Trang chủ', '/') !!}
        {!! getBreadcrumbItem($device, url(), true) !!}
    </ol>
@stop
{{-- END BREADCRUMB --}}


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
                    {!! $b->htmlPresenter()->getItem($requestId, route($route.'.brand.index', [$b->getSlug()])) !!}
                @endif
            @endforeach
        </ul>
        <div class="viewmore-hsx action-viewmore-hsx mg-t-10">Xem thêm</div>
    </div>
@stop
{{-- END BRAND SIDEBAR --}}
