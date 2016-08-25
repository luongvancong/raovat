@extends('admin.layouts.master')

@section('styles')
    <link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css">
@endsection

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>Thống kê</h4>
        </header>
        <div class="panel-body">

            <div class="adv-table">
                <div class="dataTables_wrapper">

                    <div class="row">
                        <form method="get" action="" class="form-filter form-inline mg-bt-10">
                            <div class="col-sm-10">
                                <input type="text" placeholder="Từ ngày" class="datepicker" name="from" value="{{ Request::get('from', date('d/m/Y',strtotime("-30 days"))) }}">
                                <input type="text" placeholder="Đến ngày" class="datepicker" name="to" value="{{ Request::get('to', date('d/m/Y')) }}">
                                <button type="submit" class="btn btn-default btn-sm">
                                    <i class="fa fa-search"></i> {{ trans('form.btn.search') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div id="all" style="width: 100%; height:500px; margin-top: 20px;"></div>
                        </div>
                    </div>

                    @for($i=1; $i <= 11; $i++)
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="chart_{{ $i }}" style="width: 100%; height:500px; margin-top: 40px;"></div>
                            </div>
                        </div>
                    @endfor

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

            $('#all').highcharts({
                title: {
                    text: 'KPI',
                    x: 0
                },
                xAxis: {
                    categories:
                        {!! json_encode($arr_created_at) !!}
                },
                yAxis: {
                    title: {
                        text: 'Số lượng'
                    },
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'Sản phẩm',
                    data: {!! json_encode($arr_product) !!}
                }, {
                    name: 'Video',
                    data: {!! json_encode($arr_video) !!}
                }, {
                    name: 'Tin tức',
                    data: {!! json_encode($arr_news) !!}
                }, {
                    name: 'Tổng người vào',
                    data: {!! json_encode($arr_view) !!}
                }, {
                    name: 'Time onsite',
                    data: {!! json_encode($arr_onsite) !!}
                }, {
                    name: 'Lượt click',
                    data: {!! json_encode($arr_click) !!}
                }, {
                    name: 'Tổng ảnh upload',
                    data: {!! json_encode($arr_upload) !!}
                }, {
                    name: 'Tổng comment',
                    data: {!! json_encode($arr_comment) !!}
                }, {
                    name: 'Bound rate',
                    data: {!! json_encode($arr_bound_rate) !!}
                }, {
                    name: 'Hỏi đáp',
                    data: {!! json_encode($arr_question) !!}
                }, {
                    name: 'Rao vặt',
                    data: {!! json_encode($arr_advertise) !!}
                }]
            });

            @for($i=1; $i <= 11; $i++)
                $('#chart_{{ $i }}').highcharts({
                    title: {
                        @if($i == 1)
                            text: 'Sản phẩm',
                        @elseif($i == 2)
                            text: 'Video',
                        @elseif($i == 3)
                            text: 'Tin tức',
                        @elseif($i == 4)
                            text: 'Tổng người vào',
                        @elseif($i == 5)
                            text: 'Time onsite',
                        @elseif($i == 6)
                            text: 'Lượt click',
                        @elseif($i == 7)
                            text: 'Tổng ảnh upload',
                        @elseif($i == 8)
                            text: 'Tổng comment',
                        @elseif($i == 9)
                            text: 'Bound rate',
                        @elseif($i == 10)
                            text: 'Hỏi đáp',
                        @elseif($i == 11)
                            text: 'Rao vặt',
                        @endif
                        x: 0
                    },
                    xAxis: {
                        categories:
                            {!! json_encode($arr_created_at) !!}
                    },
                    yAxis: {
                        title: {
                            text: 'Số lượng'
                        },
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: [{
                        @if($i == 1)
                            name: 'Sản phẩm',
                            data: {!! json_encode($arr_product) !!}
                        @elseif($i == 2)
                            name: 'Video',
                            data: {!! json_encode($arr_video) !!}
                        @elseif($i == 3)
                            name: 'Tin tức',
                            data: {!! json_encode($arr_news) !!}
                        @elseif($i == 4)
                            name: 'Tổng người vào',
                            data: {!! json_encode($arr_view) !!}
                        @elseif($i == 5)
                            name: 'Time onsite',
                            data: {!! json_encode($arr_onsite) !!}
                        @elseif($i == 6)
                            name: 'Lượt click',
                            data: {!! json_encode($arr_click) !!}
                        @elseif($i == 7)
                            name: 'Tổng ảnh upload',
                            data: {!! json_encode($arr_upload) !!}
                        @elseif($i == 8)
                            name: 'Tổng comment',
                            data: {!! json_encode($arr_comment) !!}
                        @elseif($i == 9)
                            name: 'Bound rate',
                            data: {!! json_encode($arr_bound_rate) !!}
                        @elseif($i == 10)
                            name: 'Hỏi đáp',
                            data: {!! json_encode($arr_question) !!}
                        @elseif($i == 11)
                            name: 'Rao vặt',
                            data: {!! json_encode($arr_advertise) !!}
                        @endif
                    }]
                });
            @endfor

        });
    </script>
@endsection
