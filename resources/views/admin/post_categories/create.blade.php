@extends('admin/layouts/master')

@section('main-content')
	<h3>Thêm nhóm tin</h3>
	<div class="panel-body">
		<form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">
			<div class="form-group {{ hasValidator('name') }}">
				<label for="email" class="col-sm-3 control-label">Tên <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('name') }}" name="name">
					{!! alertError('name') !!}
				</div>
			</div>

			<div class="form-group {{ hasValidator('slug') }}">
				<label for="email" class="col-sm-3 control-label">Slug</label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('slug') }}" name="slug">
					{!! alertError('slug') !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
			   	<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.create') }}</button>
			   	<a href="{{ route('admin.post_category.index') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop
