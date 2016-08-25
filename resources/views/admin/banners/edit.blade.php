@extends('admin/layouts/master')

@section('main-content')
	<h3>Cập nhật banner</h3>
	<div class="panel-body">
		<form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">

			<div class="form-group">
				<div class="col-sm-6 col-sm-offset-3">
					<img src="{{ $banner->getImage('sm') }}" height="90" onerror="this.src='/images/grey.gif'">
				</div>
			</div>
			<div class="form-group {{ hasValidator('image') }}">
				<label for="email" class="col-sm-3 control-label">Ảnh <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="file" class="form-control" value="{{ Request::old('image') }}" name="image">
					{!! alertError('image') !!}
				</div>
			</div>

			<div class="form-group {{ hasValidator('title') }}">
				<label for="email" class="col-sm-3 control-label">Tiêu đề <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('title', $banner->getTitle()) }}" name="title">
					{!! alertError('title') !!}
				</div>
			</div>

			<div class="form-group {{ hasValidator('teaser') }}">
				<label for="email" class="col-sm-3 control-label">Mô tả ngắn <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<textarea class="form-control" name="teaser">{{ Request::old('teaser', $banner->getTeaser()) }}</textarea>
					{!! alertError('teaser') !!}
				</div>
			</div>

			<div class="form-group {{ hasValidator('link') }}">
				<label for="email" class="col-sm-3 control-label">Link <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('link', $banner->getLink()) }}" name="link">
					{!! alertError('link') !!}
				</div>
			</div>

			<div class="form-group {{ hasValidator('position') }}">
				<label for="email" class="col-sm-3 control-label">Vị trí <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('position', $banner->getPosition()) }}" name="position">
					<p class="help-inline text-left">
						<span class="badge" data-toggle="tooltip" data-placement="top" title="Bên trên">top</span>
						<span class="badge" data-toggle="tooltip" data-placement="top" title="Bên trái">left</span>
						<span class="badge" data-toggle="tooltip" data-placement="top" title="Bên dưới">bottom</span>
						<span class="badge" data-toggle="tooltip" data-placement="top" title="Bên phải">right</span>
					</p>
					{!! alertError('position') !!}
				</div>
			</div>

			<div class="form-group {{ hasValidator('page') }}">
				<label for="email" class="col-sm-3 control-label">Trang đích <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('page', $banner->getPage()) }}" name="page">
					<p class="help-inline text-left">
						<span class="badge" data-toggle="tooltip" data-placement="top" title="Trang chủ">home</span>
						<span class="badge" data-toggle="tooltip" data-placement="top" title="Trang chi tiết sản phẩm">product_detail</span>
					</p>
					{!! alertError('page') !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
			   	<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.create') }}</button>
			   	<a href="{{ route('admin.brand.index') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop

@section('scripts')
	<script>
		$(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
@stop
