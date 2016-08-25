@extends('admin/layouts/master')

@section('main-content')
	<h3>{{ trans('admin/general.update_info') . ' ' . trans('admin/general.modules.products') }}</h3>

	<div class="mg-bt-10">
		<a href="{{ route('admin.product.tag.index', [$product->getId()]) }}" class="btn btn-xs btn-info btn-flat"><i class="fa fa-tag"></i> Tag</a>
	</div>

	<div>
	    <!-- Nav tabs -->
	    <ul class="nav nav-tabs" role="tablist">
	        <li role="presentation" class="active"><a href="#info" data-toggle="tab">Thông tin</a></li>
	        <li role="presentation"><a href="#picture" data-toggle="tab">Ảnh đại diện</a></li>
	    </ul>
	    <!-- Tab panes -->
	    <div class="tab-content">
	        <div role="tabpanel" class="tab-pane active" id="info">
	        	<div class="panel-body">
					<form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">
						<div class="form-group {{ hasValidator('name') }}">
							<label for="email" class="col-sm-3 control-label">Tên <b class="text-danger">*</b></label>
							<div class="col-sm-6 text-center">
								<input type="text" class="form-control" value="{{ Request::old('name', $product->getName()) }}" name="name">
								{!! alertError('name') !!}
							</div>
						</div>

						<div class="form-group {{ hasValidator('keyword') }}">
							<label for="email" class="col-sm-3 control-label">Từ khóa <b class="text-danger">*</b></label>
							<div class="col-sm-6 text-center">
								<input type="text" class="form-control" value="{{ Request::old('keyword', $product->getKeyword()) }}" name="keyword">
								{!! alertError('keyword') !!}
							</div>
						</div>

						<div class="form-group {{ hasValidator('ignore_keyword') }}">
							<label for="email" class="col-sm-3 control-label">Loại trừ những từ sau:</label>
							<div class="col-sm-6 text-center">
								<input type="text" class="form-control" value="{{ Request::old('ignore_keyword', $product->getIgnoreKeyword()) }}" name="ignore_keyword">
								<p class="help-inline text-left">Mỗi từ cách nhau bằng dấu phẩy</p>
								{!! alertError('ignore_keyword') !!}
							</div>
						</div>

						<div class="form-group {{ hasValidator('post_keyword') }}">
							<label for="email" class="col-sm-3 control-label">Từ khóa tìm kiếm tin tức</label>
							<div class="col-sm-6 text-center">
								<input type="text" class="form-control" value="{{ Request::old('post_keyword', $product->post_keyword) }}" name="post_keyword">
								<p class="help-inline text-left">Mỗi từ cách nhau bằng dấu phẩy</p>
								{!! alertError('post_keyword') !!}
							</div>
						</div>

						<div class="form-group {{ hasValidator('rate_keyword') }}">
							<label for="email" class="col-sm-3 control-label">Từ khóa tìm kiếm đánh giá</label>
							<div class="col-sm-6 text-center">
								<input type="text" class="form-control" value="{{ Request::old('rate_keyword', $product->rate_keyword) }}" name="rate_keyword">
								<p class="help-inline text-left">Mỗi từ cách nhau bằng dấu phẩy</p>
								{!! alertError('rate_keyword') !!}
							</div>
						</div>

						<div class="form-group {{ hasValidator('video_keyword') }}">
							<label for="email" class="col-sm-3 control-label">Từ khóa tìm kiếm video</label>
							<div class="col-sm-6 text-center">
								<input type="text" class="form-control" value="{{ Request::old('video_keyword', $product->video_keyword) }}" name="video_keyword">
								<p class="help-inline text-left">Mỗi từ cách nhau bằng dấu phẩy</p>
								{!! alertError('video_keyword') !!}
							</div>
						</div>

						<div class="form-group {{ hasValidator('tags') }}">
							<label for="email" class="col-sm-3 control-label">Tags</label>
							<div class="col-sm-6 text-center">
								<input type="text" id="tags" class="form-control tags-input" value="{{ Request::old('tags', $product->tags) }}" name="tags">
								<p class="help-inline text-left">Mỗi từ cách nhau bằng dấu phẩy</p>
								{!! alertError('tags') !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Đối thủ</label>
							<div class="col-sm-6 text-center">
								<input type="text" id="opponent-tag" class="form-control" name="opponent" value="">

							</div>
						</div>

						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Meta title:</label>
							<div class="col-sm-6 text-center">
								<input type="text" class="form-control" value="{{ Request::old('meta_title', $product->getMetaTitle()) }}" name="meta_title">
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Meta keyword:</label>
							<div class="col-sm-6 text-center">
								<input type="text" class="form-control" value="{{ Request::old('meta_keyword', $product->getMetaKeyword()) }}" name="meta_keyword">
								<p class="help-inline text-left">Mỗi từ cách nhau bằng dấu phẩy</p>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">Meta description</label>
							<div class="col-sm-6 text-center">
								<input type="text" class="form-control" value="{{ Request::old('meta_description', $product->getMetaDescription()) }}" name="meta_description">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
						   	<button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
						   	<a href="{{ url('/admin/products') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
							</div>
						</div>
						{!! csrf_field() !!}
					</form>
				</div>
	        </div>
	        <div role="tabpanel" class="tab-pane" id="picture">
	        	<div class="panel-body">
	        		<form method="POST" enctype="multipart/form-data" action="{{ route('admin.product.changeAvatar') }}" class="form-horizontal">
	        			<div class="form-group">
	        				<div class="col-sm-6 col-sm-offset-3">
	        					<img src="{{ $product->getImage() }}" height="100" class="img-reponsive img-thumbnail">
	        				</div>
	        			</div>
	        			<div class="form-group">
	        				<label class="col-sm-3 control-label">Chọn ảnh</label>
	        				<div class="col-sm-6">
	        					<input type="file" name="file" class="form-control">
	        					<input type="hidden" name="product_id" value="{{ $product->getId() }}">
	        					{!! csrf_field() !!}
	        				</div>
	        			</div>
	        			<div class="form-group">
	        				<div class="col-sm-6 col-sm-offset-3">
	        					<button class="btn btn-primary btn-sm">Cập nhật</button>
	        				</div>
	        			</div>
	        		</form>
	        	</div>
	        </div>
	    </div>
	</div>
@stop

@section('scripts')
<script>
	$(function() {
		$('.tags-input').tagsInput({
			defaultText : 'Thêm tag'
		});

		var opponentId = [];

		$('#opponent-tag').tokenInput('{{ route("admin.product.tagAutoComplete") }}', {
			prePopulate : {!! $oldOpponents !!}
		});

		// $('#opponent-tag').tokenInput('add', {{ $oldOpponents }});
	});
</script>
@stop