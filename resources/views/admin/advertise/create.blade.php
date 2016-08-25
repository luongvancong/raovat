@extends('admin.layouts.master')

@section('styles')
    <link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css">
@endsection

@section('main-content')
    <h3>Đăng ký</h3>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action enctype="multipart/form-data">

        	<div class="form-group">
				<label for="email" class="col-sm-3 control-label">User </label>
				<div class="col-sm-6 text-center">
					<select class="select2 form-control" name="user_id">
						@foreach($user as $key => $value)
						<option value="{{ $value->getId() }}" {{ (Request::old('user_id') == $value->getId()) ? 'selected' : '' }}>{{ $value->getEmail() }}</option>
						@endforeach
					</select>
				</div>
			</div>

            <div class="form-group {{ hasValidator('title') }}">
				<label for="email" class="col-sm-3 control-label">Tiêu đề </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" name="title" value="{{ Request::old('title') }}">
					{!! alertError('title') !!}
				</div>
			</div>

            <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Banner </label>
				<div class="col-sm-6 text-center">
					<input type="file" class="form-control" name="banner">
				</div>
			</div>

            <div class="form-group {{ hasValidator('link') }}">
				<label for="email" class="col-sm-3 control-label">Đường dẫn </label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" name="link" value="{{ Request::old('link') }}">
					{!! alertError('link') !!}
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Vị trí đặt </label>
				<div class="col-sm-6 text-center">
					<select type="text" class="form-control" name="position">
						@foreach(position_ads() as $key => $value)
							<option value="{{ $key }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Thời gian đặt </label>
				<div class="col-sm-3 text-center">
					<input type="text" class="form-control datepicker" value="{{ Request::old('created_at', date('d/m/Y')) }}" name="created_at">
					{!! alertError('created_at') !!}
				</div>
				<div class="col-sm-3 text-center">
					<input type="text" class="form-control datepicker" value="{{ Request::old('expired', date('d/m/Y', strtotime('next month'))) }}" name="expired">
					{!! alertError('expired') !!}
				</div>
			</div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.create') }}</button>
                    <a href="{{ route('admin.advertise.index') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
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
		$(".select2").select2();

		$('.datepicker').datepicker({
            format: "dd/mm/yyyy"
        });
	});

</script>
@endsection
