@extends('admin.layouts.master')

@section('main-content')
<section class="panel">
	<header class="panel-heading">
		<h4>Danh sách quảng cáo</h4>
	</header>
	<div class="panel-body">
		<div class="adv-table">
			<div class="dataTables_wrapper">

				<div class="row">
					<form method="get" action="" class="form-filter form-inline mg-bt-10">
						<div class="col-md-12">
							<input type="text" name="id" class="form-control search-box-modules input-sm" placeholder="ID" value="{{ Request::get('id', '') }}">
							<input type="text" name="username" class="form-control search-box-modules input-sm" placeholder="Username" value="{{ Request::get('username', '') }}">
							<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
						</div>
						<div class="clearfix"></div>
					</form>
				</div>

				<table class="display table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>User</th>
							<th>Info</th>
							<th>Banner</th>
							<th>Thống kê</th>
							<th>Active</th>
							<th>Sửa</th>
							<th>Xóa</th>
						</tr>
					</thead>
					@foreach($data as $key => $value)
						<tr>
							<td>{{ $value->getId() }}</td>
							<td>
								Tên: {{ $value->getUserEmail() }} <br>
							</td>
							<td>
								Tiêu đề: {{ $value->getTitle() }} <br>
								Vị trí: {{ position_ads()[$value->getPosition()] }} <br>
								Ngày bắt đầu: {{ $value->getCreatedAt() }} <br>
								Ngày kết thúc: {{ $value->getExpired() }}
							</td>
							<td align="center">
								<a href="">
									<img class="img-thumbnail" style="width: 150px;" src="{{ PATH_IMAGE_ADVERTISE . $value->getBanner() }}">
								</a>
							</td>
							<td width="30"><a href="{{ route('admin.advertise.statistic', $value->getId()) }}" class="btn btn-xs btn-success">Thống kê</a></td>
							<td width="30">
								{!! makeActiveButton(route('admin.advertise.active', [$value->getId()]), $value->getActive()) !!}
							</td>
							<td width="30"><a href="{{ route('admin.advertise.edit', $value->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
							<td width="30"><a href="{{ route('admin.advertise.delete', $value->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
						</tr>
					@endforeach
				</table>
				
				@include('admin/partials/paginate', ['data' => $data, 'appended' => ['name' => Request::get('usernames')]])
			</div>
		</div>
	</div>
</section>
@stop