@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Danh sách vùng miền
				<a href="{{ route('admin.city.create') }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<form method="get" action="" class="form-filter form-inline" style="margin-bottom:20px;">
						<input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Nhóm tin" value="{{ Request::get('name', '') }}">
						<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
					</form>
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tên</th>
								<th>Danh mục</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($cities as $key => $city)
								<tr>
									<td width="50">{{ $city->getId() }}</td>
									<td>{{ $city->getName() }}</td>
									<td>
										@if($city->getCity_Parent() == 0)
											Danh mục cha
										@else
											{!! $city->getParent->cit_name !!}
										@endif 
									</td>
									<td width="30"><a href="{{ route('admin.city.edit', $city->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
									<td width="30"><a href="{{ route('admin.city.delete', $city->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $cities, 'appended' => ['name' => Request::get('name')]])
				</div>
			</div>
		</div>
	</section>
@stop