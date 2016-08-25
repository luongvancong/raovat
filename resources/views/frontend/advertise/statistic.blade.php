@extends('frontend/layout/default')

@section('styles')
    <link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css">
@endsection

@section('content')
<div class="row mg-bt-30">
	<div class="col-sm-12">
		<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', '/') !!}
            {!! getBreadcrumbItem('Quản lý quảng cáo', route('advertise.manager')) !!}
            {!! getBreadcrumbItem('Thống kê quảng cáo', '', true) !!}
        </ol>

        <div class="col-sm-12">
        	<div class="row">
                <form method="get" action="" class="form-filter form-inline mg-bt-10">
                    <div class="col-sm-10">
                        <input type="text" placeholder="Từ ngày" class="datepicker" name="from" value="{{ Request::get('from', date('d/m/Y',strtotime("-5 days"))) }}">
                        <input type="text" placeholder="Đến ngày" class="datepicker" name="to" value="{{ Request::get('to', date('d/m/Y')) }}">
                        <button type="submit" class="btn btn-default btn-sm">
                            <i class="fa fa-search"></i> {{ trans('form.btn.search') }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div id="chart" style="width: 100%; height:500px; margin-top: 20px;"></div>
                </div>
            </div>
        </div>
	</div>


</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/bower_components/highcharts/highcharts.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy"
            });

            $('#chart').highcharts({
                title: {
                    text: 'Click quảng cáo',
                    x: 0
                },
                xAxis: {
                    categories: {!! json_encode(array_get($data, 'day')) !!}
                },
                yAxis: {
                    title: {
                        text: 'Click'
                    },
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'Click',
                    data: {!! json_encode(array_get($data, 'count')) !!}
                }]
            });

        });
    </script>
@endsection