@extends('admin.layouts.master')

@section('styles')
    <link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css">
@endsection

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
            <h4>
            	Thống kê quảng cáo
	            <div class="pull-right">
	            	<a href="{{ route('admin.advertise.statistic.update', $id) }}" class="btn btn-xs btn-primary mg-r-5"><i class="fa fa-plus"></i>Cập nhật</a>
	            </div>
        	</h4>
        </header>

        <div class="panel-body">
        	<div class="adv-table">
        		<div class="dataTables_wrapper">
        			
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
	</section>
@stop

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