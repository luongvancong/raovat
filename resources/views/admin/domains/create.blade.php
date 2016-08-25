@extends('admin/layouts/master')

@section('main-content')
	<h3>Product rule</h3>
	<div class="panel-body">
		<form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data">
			<div class="form-group {{ $errors->has('dom_allowed_domains') ? 'has-error' : '' }}">
				<label for="dom_allowed_domains" class="col-sm-3 control-label">Allowed domains <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="dom_allowed_domains" name="dom_allowed_domains" placeholder="Phân cách nhau bởi dấu phẩy" value="{{ Request::old('dom_allowed_domains') }}" />
					{!! $errors->first('dom_allowed_domains', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_name') ? 'has-error' : '' }}">
				<label for="dom_name" class="col-sm-3 control-label">Start urls <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="dom_name" name="dom_name" placeholder="Phân cách nhau bởi dấu phẩy" value="{{ Request::old('dom_name') }}" />
					{!! $errors->first('dom_name', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_position') ? 'has-error' : '' }}">
				<label for="dom_position" class="col-sm-3 control-label">Order</label>
				<div class="col-sm-2">
					<input type="number" min="0" max="999" class="form-control" id="dom_position" name="dom_position" placeholder="Độ ưu điên" value="{{ Request::old('dom_position', 1) }}" />
					{!! $errors->first('dom_position', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_code_link') ? 'has-error' : '' }}">
				<label for="dom_code_link" class="col-sm-3 control-label">Detail link rule <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="dom_code_link" name="dom_code_link" placeholder="Luật lấy link - XPath" value="{{ Request::old('dom_code_link') }}" />
					{!! $errors->first('dom_code_link', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_code_title') ? 'has-error' : '' }}">
				<label for="dom_code_title" class="col-sm-3 control-label">Title rule <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="dom_code_title" name="dom_code_title" placeholder="Luật lấy tiêu đề - XPath" value="{{ Request::old('dom_code_title') }}" />
					{!! $errors->first('dom_code_title', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_code_teaser') ? 'has-error' : '' }}">
				<label for="dom_code_teaser" class="col-sm-3 control-label">Teaser rule </label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="dom_code_teaser" name="dom_code_teaser" placeholder="Luật lấy mô tả - XPath" value="{{ Request::old('dom_code_teaser') }}" />
					{!! $errors->first('dom_code_teaser', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_code_thumbnail') ? 'has-error' : '' }}">
				<label for="dom_code_thumbnail" class="col-sm-3 control-label">Thumbnail rule</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="dom_code_thumbnail" name="dom_code_thumbnail" placeholder="Luật lấy hình ảnh - XPath" value="{{ Request::old('dom_code_thumbnail') }}" />
					{!! $errors->first('dom_code_thumbnail', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_code_content') ? 'has-error' : '' }}">
				<label for="dom_code_content" class="col-sm-3 control-label">Content rule <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="dom_code_content" name="dom_code_content" placeholder="Luật lấy nội dung - CSS" value="{{ Request::old('dom_code_content') }}" />
					{!! $errors->first('dom_code_content', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.create') }}</button>
					<a href="{{ url('/admin/domains') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop
