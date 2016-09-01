@extends('admin/layouts/master')

@section('main-content')
	<h3>Cập nhật tỉnh thành, vùng miền</h3>
	<div class="panel-body">
		<form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">
			<div class="form-group {{ hasValidator('cit_parent') }}">
				<label for="email" class="col-sm-3 control-label">Chọn loại tỉnh thành vùng miền<b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<select name="cit_parent" class="form-control">
						<option value="0">---Chọn một tỉnh thành vùng miền---</option>
						{!! city_parent($data,0,"--",$city->getCity_Parent()) !!}
					</select>
					{!! alertError('cit_parent') !!}
				</div>
			</div>

			<div class="form-group {{ hasValidator('name') }}">
				<label for="email" class="col-sm-3 control-label">Tên <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('cit_name', $city->getName()) }}" name="cit_name">
					{!! alertError('cit_name') !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
			   	<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
			   	<a href="{{ route('admin.city.index') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop
