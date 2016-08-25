@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				{{ trans('admin/general.modules.product') }}
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<form method="get" action="" class="form-filter form-inline mg-bt-10">
						<input type="text" name="id" class="form-control search-box-modules input-sm" placeholder="ID sản phẩm" value="{{ Request::get('id', '') }}">
						<input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Tên sản phẩm" value="{{ Request::get('name', '') }}">
						<input type="text" name="price" class="form-control search-box-modules input-sm" placeholder="Giá sản phẩm" value="{{ Request::get('price', '') }}">
						<select name="type" class="form-control input-sm">
							<option value="">Loại</option>
							<option value="hot">Hot</option>
							<option value="banner">Banner</option>
						</select>
						<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
					</form>
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>ID</th>
								<th>Tên sản phẩm</th>
								<th>Từ khóa</th>
								<th>Loại bỏ</th>
								<th>Từ khóa tin tức</th>
								<th>Từ khóa đánh giá</th>
								<th>Từ khóa video</th>
								<th>Smartphone</th>
								<th>Tablet</th>
								<th>Laptop</th>
								{{-- <th>Banner</th> --}}
								{{-- <th>Hot</th> --}}
								<th>Newest</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($products as $key => $product)
								<tr>
									<td width="50">{{ $key + 1 }}</td>
									<td width="50">{{ $product->getId() }}</td>
									<td width="300">
										<a href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">{{ $product->getName() }}</a>
										<p>{!! $product->getPriceStr() !!} <sup>đ</sup></p>
									</td>
									<td class="editable" data-field="keyword" data-id="{{ $product->getId() }}">{{ $product->getKeyword() }}</td>
									<td class="editable" data-field="ignore_keyword" data-id="{{ $product->getId() }}">{{ $product->getIgnoreKeyword() }}</td>
									<td class="editable" data-field="post_keyword" data-id="{{ $product->getId() }}">{{ $product->post_keyword }}</td>
									<td class="editable" data-field="rate_keyword" data-id="{{ $product->getId() }}">{{ $product->rate_keyword }}</td>
									<td class="editable" data-field="video_keyword" data-id="{{ $product->getId() }}">{{ $product->video_keyword }}</td>
									<td class="editable" data-field="is_smartphone" data-id="{{ $product->getId() }}">{{ $product->is_smartphone }}</td>
									<td class="editable" data-field="is_tablet" data-id="{{ $product->getId() }}">{{ $product->is_tablet }}</td>
									<td class="editable" data-field="is_laptop" data-id="{{ $product->getId() }}">{{ $product->is_laptop }}</td>
								{{-- 	<td width="30">
										{!! makeActiveButton(route('admin.product.is_banner', [$product->getId()]), $product->is_banner) !!}
									</td> --}}
						{{-- 			<td width="30">
										{!! makeActiveButton(route('admin.product.hot', [$product->getId()]), $product->hot) !!}
									</td> --}}
									<td width="30">
										{!! makeActiveButton(route('admin.product.newest', [$product->getId()]), $product->newest) !!}
									</td>
									<td width="30"><a href="{{ route('admin.product.edit', $product->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
									<td width="30"><a href="{{ route('admin.product.destroy', $product->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $products, 'appended' => ['name' => Request::get('name'), 'price' => Request::get('price')]])
				</div>
			</div>
		</div>
	</section>
@stop

@section('scripts')
<script>
	$(function() {
		$('table').editableTableWidget();
		$('table td').on('change', function(evt, newValue) {
			var $this = $(this);
			$.ajax({
				url : '{{ route('admin.product.editable') }}',
				type : 'PUT',
				data : {
					product_id : $this.data('id'),
					field : $this.data('field'),
					value : newValue,
					_token : '{{ csrf_token() }}'
				},
				success: function(response) {
					console.log(response);
				}
			});
		});
	});
</script>
@stop