@extends('admin.layouts.master')

@section('styles')
    <link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css">
@endsection

@section('main-content')
    <h3>Thêm Thông Tin</h3>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action enctype="multipart/form-data">

            <div class="form-group {{ hasValidator('created_at') }}">
				<label for="email" class="col-sm-3 control-label">Chọn ngày </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control datepicker" value="{{ Request::old('created_at', date('d/m/Y')) }}" name="created_at">
                    {!! alertError('created_at') !!}
				</div>
			</div>

            <div class="form-group {{ hasValidator('product') }}">
				<label for="email" class="col-sm-3 control-label">Tổng sản phẩm </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('product') }}" name="product">
                    {!! alertError('product') !!}
				</div>
			</div>

            <div class="form-group {{ hasValidator('video') }}">
                <label for="email" class="col-sm-3 control-label">Tổng Video </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('video') }}" name="video">
                    {!! alertError('video') !!}
				</div>
            </div>

            <div class="form-group {{ hasValidator('news') }}">
                <label for="email" class="col-sm-3 control-label">Tổng tin tức </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('news') }}" name="news">
                    {!! alertError('news') !!}
				</div>
            </div>

            <div class="form-group {{ hasValidator('view') }}">
                <label for="email" class="col-sm-3 control-label">Tổng người vào </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('view') }}" name="view">
                    {!! alertError('view') !!}
				</div>
            </div>

            <div class="form-group {{ hasValidator('onsite') }}">
                <label for="email" class="col-sm-3 control-label">Time onsite  </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('onsite') }}" name="onsite">
                    {!! alertError('onsite') !!}
				</div>
            </div>

            <div class="form-group {{ hasValidator('click') }}">
                <label for="email" class="col-sm-3 control-label">Tổng lượt click  </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('click') }}" name="click">
                    {!! alertError('click') !!}
				</div>
            </div>

            <div class="form-group {{ hasValidator('upload') }}">
                <label for="email" class="col-sm-3 control-label">Tổng số ảnh upload  </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('upload') }}" name="upload">
                    {!! alertError('upload') !!}
				</div>
            </div>

            <div class="form-group {{ hasValidator('comment') }}">
                <label for="email" class="col-sm-3 control-label">Tổng Comment  </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('comment') }}" name="comment">
                    {!! alertError('comment') !!}
				</div>
            </div>

            <div class="form-group {{ hasValidator('bound_rate') }}">
                <label for="email" class="col-sm-3 control-label">Bound rate  </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('bound_rate') }}" name="bound_rate">
                    {!! alertError('bound_rate') !!}
				</div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.create') }}</button>
                    <a href="{{ route('admin.kpi.index') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                </div>
            </div>
            {!! csrf_field() !!}
        </form>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.datepicker').datepicker({
                format: "dd/mm/yyyy"
            });
        });
    </script>
@endsection
