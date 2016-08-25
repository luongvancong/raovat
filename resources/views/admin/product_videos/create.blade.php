@extends('admin/layouts/master')

@section('main-content')
	<h3>Video sản phẩm - Youtube</h3>

	<div class="panel-body">
		<form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Keyword</label>
				<div class="col-sm-6">
					<input class="form-control" name="q" value="{{ $product->getKeyword() ? $product->getKeyword() : $product->getName() }}" >
					<input type="hidden" name="product_id" value="{{ $product->getId() }}">
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Sort</label>
				<div class="col-sm-6">
					<?php
						$sort = ['relevance', 'date', 'rating', 'title', 'videoCount', 'viewCount'];
					?>
					<select name="order" class="form-control">
						@foreach($sort as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-sm-3 control-label">Max Results</label>
				<div class="col-sm-6">
					<?php
						$results = [25, 50, 75, 100];
					?>
					<select name="maxResults" class="form-control">
						@foreach($results as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-6">
			   	<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
			   	<a href="{{ route('admin.product_video.index', [$product->getId()]) }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
@stop
