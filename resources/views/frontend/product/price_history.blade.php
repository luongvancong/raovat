@extends('frontend/layout/default')

@section('content')
<div id="breadcrumb">
    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        {!! getBreadcrumbItem('Trang chủ', '/') !!}
        {!! getBreadcrumbItem($product->getBrand(), route('product.brand', [$product->getBrand()])) !!}
        {!! getBreadcrumbItem($product->getName(), route('product.detail',[$product->getId(), $product->getSlug()])) !!}
        {!! getBreadcrumbItem('Lịch sử giá', '#' ,true) !!}
    </ol>
</div>

<div class="section-price-histories">
    <h1 class="heading">Lịch sử giá cả sản phẩm {{ $product->getName() }}</h1>
    <div id="data-chart" class="data-chart"></div>
</div>

@stop

@section('scripts')
<script type="text/javascript" src="/bower_components/highcharts/highcharts.js"></script>
<script>
    // Create the chart
    $('#data-chart').highcharts({
        title: {
            text: 'Biểu đồ thay đổi giá sản phẩm',
            x: -20 //center
        },
        subtitle: {
            text: 'Giaca.org',
            x: -20
        },
        xAxis: {
            categories: {!! json_encode($dataChart['categories']) !!}
        },
        yAxis: {
            title: {
                text: 'Giá cả'
            }
        },
        tooltip: {
            valueSuffix: ' VNĐ'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Giá thấp nhất',
            data: {!! json_encode($dataChart['min_price']) !!}
        }, {
            name: 'Giá trung bình',
            data: {!! json_encode($dataChart['avg_price']) !!}
        }]
    });
</script>
@stop