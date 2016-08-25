@extends('account/layout/default')

@section('styles')
<link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css">
@stop

@section('account_breadcrumb')
<div class="col-sm-12">
    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        {!! getBreadcrumbItem('Trang chủ', '/') !!}
        {!! getBreadcrumbItem('Thiết lập tài khoản', route('account.settings')) !!}
        {!! getBreadcrumbItem('Đấu giá click', route('account.auction')) !!}
        {!! getBreadcrumbItem('Thống kê', '', true) !!}
    </ol>
</div>
@stop

@section('account_content')
<div class="row">
    <div class="col-sm-12">
        <h1 class="text-center account-auction-statistic-header">Thống kê</h1>
        <div class="account-auction-filter">
            <form action="">
                <input type="text" class="date-picker account-date-picker" name="start_date" placeholder="Từ ngày" value="{{ date('Y-m-d', strtotime($auction->getStartDate())) }}">
                <input type="text" class="date-picker account-date-picker" name="end_date" placeholder="Đến ngày" value="{{ date('Y-m-d', strtotime($auction->getEndDate())) }}">
                <button class="btn btn-sm btn-default">Thống kê</button>
            </form>
        </div>
        <div id="account-auction-chart" class="account-auction-chart"></div>
    </div>
</div>
@stop

@section('scripts')
    <script type="text/javascript" src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.vi.min.js"></script>
    <script type="text/javascript" src="/bower_components/highcharts/highcharts.js"></script>
    <script>
    $(function () {
        $('.date-picker').datepicker({
            format: "yyyy-mm-dd",
            language : 'vi',
            todayHighlight : true
        });

        // Create the chart
        $('#account-auction-chart').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Biểu đồ thống kê lượt click'
            },
            subtitle: {
                text: 'Từ ngày {{ $startDate }} đến ngày {{ $endDate }}'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Lượt click'
                },
                tickInterval: {{ $maxValue }}

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        // format: '{point.y:.1f}%'
                    }
                }
            },

            tooltip: {
                // headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                // pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [{
                name: 'Click',
                colorByPoint: true,
                data: {!! json_encode($dataChart) !!}
            }],

        });
    });
    </script>
@stop