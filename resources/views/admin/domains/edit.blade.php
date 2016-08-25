@extends('admin/layouts/master')

@section('main-content')
	<h3>Update product rule</h3>
	<div class="panel-body">
		<form class="form-horizontal bucket-form" method="post" enctype="multipart/form-data">
			<div class="form-group {{ $errors->has('dom_allowed_domains') ? 'has-error' : '' }}">
				<label for="dom_allowed_domains" class="col-sm-3 control-label">Allowed domains <b class="text-danger">*</b></label>
				<div class="col-sm-6">
			   	<input type="text" class="form-control" id="dom_allowed_domains" name="dom_allowed_domains" placeholder="Phân cách nhau bởi dấu phẩy" value="{{ Request::old('dom_allowed_domains', $domain->getAllowedDomain()) }}" />
			   	{!! $errors->first('dom_allowed_domains', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_name') ? 'has-error' : '' }}">
				<label for="dom_name" class="col-sm-3 control-label">Start urls <b class="text-danger">*</b></label>
				<div class="col-sm-6">
			   	<input type="text" class="form-control" id="dom_name" name="dom_name" placeholder="Tên domain" value="{{ Request::old('dom_name', $domain->getName()) }}" />
			   	{!! $errors->first('dom_name', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_position') ? 'has-error' : '' }}">
				<label for="dom_position" class="col-sm-3 control-label">Độ ưu điên</label>
				<div class="col-sm-2">
			   	<input type="number" min="0" max="999" class="form-control" id="dom_position" name="dom_position" placeholder="Độ ưu điên" value="{{ Request::old('dom_position', $domain->getPosisition()) }}" />
			   	{!! $errors->first('dom_position', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_code_link') ? 'has-error' : '' }}">
				<label for="dom_code_link" class="col-sm-3 control-label">Detail link rule <b class="text-danger">*</b></label>
				<div class="col-sm-6">
			   	<input type="text" class="form-control" id="dom_code_link" name="dom_code_link" placeholder="Luật lấy link" value="{{ Request::old('dom_code_link', $domain->getCodeLink()) }}" />
			   	{!! $errors->first('dom_code_link', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_code_title') ? 'has-error' : '' }}">
				<label for="dom_code_title" class="col-sm-3 control-label">Title rule <b class="text-danger">*</b></label>
				<div class="col-sm-6">
			   	<input type="text" class="form-control" id="dom_code_title" name="dom_code_title" placeholder="Luật lấy tiêu đề" value="{{ Request::old('dom_code_title', $domain->getCodeTitle()) }}" />
			   	{!! $errors->first('dom_code_title', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_code_teaser') ? 'has-error' : '' }}">
				<label for="dom_code_teaser" class="col-sm-3 control-label">Teaser rule </label>
				<div class="col-sm-6">
			   	<input type="text" class="form-control" id="dom_code_teaser" name="dom_code_teaser" placeholder="Luật lấy mô tả" value="{{ Request::old('dom_code_teaser', $domain->getCodeTeaser()) }}" />
			   	{!! $errors->first('dom_code_teaser', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_code_thumbnail') ? 'has-error' : '' }}">
				<label for="dom_code_thumbnail" class="col-sm-3 control-label">Thumbnail rule</label>
				<div class="col-sm-6">
			   	<input type="text" class="form-control" id="dom_code_thumbnail" name="dom_code_thumbnail" placeholder="Luật lấy hình ảnh" value="{{ Request::old('dom_code_thumbnail', $domain->getCodeThumbnail()) }}" />
			   	{!! $errors->first('dom_code_thumbnail', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group {{ $errors->has('dom_code_content') ? 'has-error' : '' }}">
				<label for="dom_code_content" class="col-sm-3 control-label">Content rule <b class="text-danger">*</b></label>
				<div class="col-sm-6">
			   	<input type="text" class="form-control" id="dom_code_content" name="dom_code_content" placeholder="Luật lấy nội dung" value="{{ Request::old('dom_code_content', $domain->getCodeContent()) }}" />
			   	{!! $errors->first('dom_code_content', '<span class="help-inline text-danger">:message</span>') !!}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
			   	<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
			   	<a href="{{ url('/admin/domains') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop
