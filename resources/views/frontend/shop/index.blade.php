@extends('frontend/layout/default')

@section('content')

<div id="shop-index">
    <div id="breadcrumb">
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', url()) !!}
            {!! getBreadcrumbItem('Cửa hàng', '' ,true) !!}
        </ol>
    </div>

    <div class="row">
        @foreach($shops as $shop)
            <div class="col-sm-3">
                <div class="shop-item">
                    <a class="link" href="{{ $shop->getUrlPath() }}" title="{{ $shop->getName() }}">
                        <img class="img-responsive img-thumbnail" onerror="this.src='/images/grey.gif'" src="{{ $shop->getImage() }}" alt="{{ $shop->getName() }}" title="{{ $shop->getName() }}">
                        <div class="url">{{ $shop->getName() }}</div>
                        <div class="name">{{ $shop->getAlias() }}</div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-sm-12 text-center">{!! pagination($shops, $shops->total(), $shops->perPage())  !!}</div>
    </div>
</div>
@stop