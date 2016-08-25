@extends('admin.layouts.master')

@section('main-content')
<section class="panel">
	<header class="panel-heading">
		<h4>Danh sách đăng ký quảng cáo</h4>
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
							<th>Thông tin</th>
							<th>Nội dung</th>
							<th>Xóa</th>
						</tr>
					</thead>
					@foreach($data as $key => $value)
						<tr>
							<td>{{ $key+1 }}</td>
							<td>
								User Id: {{ $value->getUserId() }} <br>
								Họ tên: {{ $value->getName() }} <br>
								Điện thoại: {{ $value->getPhone() }} <br>
								Email: {{ $value->getEmail() }} 
							</td>
							<td width="50%">{{ $value->getContent() }}</td>
							<td width="30"><a href="{{ route('admin.advertise.register.delete', $value->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
						</tr>
					@endforeach
				</table>
				@include('admin/partials/paginate', ['data' => $data, 'appended' => ['name' => Request::get('name')]])
			</div>
		</div>
	</div>
</section>
@stop