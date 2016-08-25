@extends('admin/layouts/master')

@section('main-content')
	<h3>Thêm hãng sản xuất</h3>
	<div class="panel-body">
		<form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">
			<div class="form-group {{ hasValidator('name') }}">
				<label for="email" class="col-sm-3 control-label">Tên <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('name') }}" name="name">
					{!! alertError('name') !!}
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">Mô tả ngắn</label>
				<div class="col-sm-6 text-center">
					<textarea name="teaser" class="form-control">{{ old('teaser') }}</textarea>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Mô tả</label>
				<div class="col-sm-6 text-center">
					<textarea name="description" class="form-control ckeditor">{{ old('description') }}</textarea>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Meta title</label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ old('meta_title')}}" name="meta_title">
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Meta keyword</label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ old('meta_keywords') }}" name="meta_keywords">
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Meta description</label>
				<div class="col-sm-6 text-center">
					<textarea name="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
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
