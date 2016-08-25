@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Danh sách hãng sản xuất
				<a href="{{ route('admin.brand.create') }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<form method="get" action="" class="form-filter form-inline" style="margin-bottom:20px;">
						<input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Tên hãng" value="{{ Request::get('name', '') }}">
						<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
					</form>
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tên</th>
								<th>Slug</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($brands as $key => $brand)
								<tr>
									<td width="50">{{ $brand->getId() }}</td>
									<td><a href="" class="editable" data-id="{{ $brand->getId() }}" data-field="name">{{ $brand->getName() }}</a></td>
									<td><a href="" class="editable" data-id="{{ $brand->getId() }}" data-field="slug">{{ $brand->getSlug() }}</a></td>
									<td width="30"><a href="{{ route('admin.brand.edit', $brand->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
									<td width="30"><a href="{{ route('admin.brand.delete', $brand->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $brands, 'appended' => ['name' => Request::get('name')]])
				</div>
			</div>
		</div>
	</section>
@stop

@section('scripts')
<script src="/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script>
	$(function() {
		 $.fn.editable.defaults.mode = 'inline';

        $.fn.editableform.template = [
            '<form class="form-inline editableform">',
                '<div class="control-group">',
                    '<div class="editable-input"></div>',
                    '<div class="editable-error-block"></div>',
                '</div>',
            '</form>',
        ].join('');

        $.fn.editableform.buttons = '';

		$('.editable').each(function() {
            var $this = $(this);
            var field = $this.data('field');
            $this.editable({
                ajaxOptions : {
                    type : 'PUT'
                },
                // type : 'text',
                url : '{{ route('admin.brand.quickedit') }}',
                pk: $this.data('id'),
                params : {
                    _token : '{{ csrf_token() }}',
                    field : $this.data('field'),
                    id : $this.data('id')
                }
            });
        });
	});
</script>
@stop