@extends('frontend/layout/default')

@section('styles')
    <style>
        #modal-map-body {
            min-height: 300px;
        }
    </style>
@stop

@section('content')

<div id="shop-detail">
    <div id="breadcrumb">
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', '/') !!}
            {!! getBreadcrumbItem('Cửa hàng ' . $shop->getName(), '', true) !!}
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-8">
            <div class="general-info">
                <div class="page-head mg-bt-10">
                    <h1 class="page-head-block">{{ $shop->getName() }}</h1>
                </div>

                <div class="form form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Tên công ty</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">{{ $shop->getAlias() }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Website</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">http://{{ $shop->getName() }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Địa chỉ</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">{{ $shop->getAddress() }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Số điện thoại</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">{{ $shop->getPhone() }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Fax</label>
                        <div class="col-sm-6">
                            <p class="form-control-static">{{ $shop->getFax() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="branch">
                <div class="page-head mg-bt-10">
                    <h2 class="page-head-block">Trụ sở và chi nhánh</h2>
                </div>

                <div class="branch-list pd-bt-20 pd-t-20">
                    <div class="row">
                    @if($branchs->count())
                        @foreach($branchs as $key => $branch)
                            <div class="col-sm-6">
                                <div class="branch-item">
                                    <div class="pull-left pd-r-10">
                                        <span class="numberic">{{ $key+1 }}</span>
                                    </div>
                                    <div class="pull-left info">
                                        <div class="address">Địa chỉ: {{ $branch->getAddress() }}</div>
                                        <div class="phone">Phone: {{ $branch->getPhone() }}</div>
                                        <div class="map" onclick="showMap('{{ $branch->getLatitude() }}', '{{ $branch->getLongitude() }}')"><i class="fa fa-map-marker"></i> Bản đồ</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-sm-6">
                            <div class="branch-item">
                                <div class="pull-left pd-r-10">
                                    <span class="numberic">1</span>
                                </div>
                                <div class="pull-left info">
                                    <div class="address">Địa chỉ: {{ $shop->getAddress() }}</div>
                                    <div class="phone">Phone: {{ $shop->getPhone() }}</div>
                                    <div class="map" onclick="showMap('{{ $shop->getLatitude() }}', '{{ $shop->getLongitude() }}')"><i class="fa fa-map-marker"></i> Bản đồ</div>
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="popular-products">
                <div class="page-head mg-bt-10">
                    <h2 class="page-head-block">Sản phẩm đang bán</h2>
                </div>

                <div class="products">
                    @foreach($products as $product)
                    <div class="product-item">
                        <img src="{{ $product->getImage() }}" title="{{ $product->getName() }}" alt="{{ $product->getName() }}" class="img-reponsive pull-left">
                        <div class="info pull-left">
                            <h3><a class="link" href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">{{ $product->getName() }}</a></h3>
                            <p>{{ $product->getPriceStr() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-map" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bản đồ</h4>
            </div>
            <div class="modal-body">
                <div id="modal-map-body"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
<script>

function showMap(lat, long) {

    $('#modal-map').modal('show');

    function initMap() {
        var map;
        var myLatLng = {lat: parseFloat(lat), lng: parseFloat(long) };

        map = new google.maps.Map(document.getElementById('modal-map-body'), {
            center: myLatLng,
            zoom: 15
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!'
        });
    }

    $('#modal-map').on('shown.bs.modal', function() {
        initMap()
    });


}



</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgw7JoSOV_VqSLZBWP40kHd8la0tRP8EU" async defer></script>
@stop