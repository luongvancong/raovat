@extends('admin/layouts/master')

@section('main-content')
	<h3>Giá sản phẩm</h3>

	<div class="panel-body">
		<form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Sản phẩm <b class="text-danger">*</b></label>
				<div class="col-sm-6">
					<p class="form-control-static">{{ $product->getName() }}</p>
					<input type="hidden" name="product_id" value="{{ $product->getId() }}">
				</div>
			</div>

			<div class="form-group {{ hasValidator('allowed_domains') }}">
				<label for="email" class="col-sm-3 control-label">Allow Domains <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('allowed_domains') }}" name="allowed_domains">
					{!! alertError('allowed_domains') !!}
				</div>
			</div>

			<div class="form-group {{ hasValidator('link') }}">
				<label for="email" class="col-sm-3 control-label">Link <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('link') }}" name="link">
					{!! alertError('link') !!}
				</div>
			</div>

			<div class="form-group {{ hasValidator('rule') }}">
				<label for="email" class="col-sm-3 control-label">Price Rule <b class="text-danger">*</b></label>
				<div class="col-sm-6 text-center">
					<input type="text" class="form-control" value="{{ Request::old('rule') }}" name="rule">
					{!! alertError('rule') !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
			   	<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.create') }}</button>
			   	<a href="{{ route('admin.price_rule.index', [$product->getId()]) }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop
