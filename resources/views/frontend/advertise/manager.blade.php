@extends('frontend/layout/default')

@section('content')
<div class="row mg-bt-30">
	<div class="col-sm-12">
		<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', '/') !!}
            {!! getBreadcrumbItem('Quản lý quảng cáo', '', true) !!}
        </ol>
	</div>

	<div class="col-sm-12">
		<table class="display table table-bordered table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Banner</th>
					<th>Title</th>
					<th>Vị trí</th>
					<th>Ngày bắt đầu</th>
					<th>Ngày kết thúc</th>
					<th>Thống kê</th>
					<th>Kích hoạt</th>
				</tr>
				@foreach($data as $key => $value)
				<tr>
					<td>{{ $key+1 }}</td>
					<td align="center">
						<a href="{{ $value->getLink() }}">
							<img class="img-thumbnail" style="height: 50px;" src="{{ PATH_IMAGE_ADVERTISE . $value->getBanner() }}">
						</a>
					</td>
					<td>{{ $value->getTitle() }}</td>
					<td>{{ position_ads()[$value->getPosition()] }}</td>
					<td>
						{{ date('d/m/Y', strtotime($value->getCreatedAt())) }}
					</td>
					<td>
						{{ date('d/m/Y', strtotime($value->getExpired())) }}
					</td>
					<td width="30"><a href="{{ route('advertise.manager.statistic', $value->getId()) }}" class="btn btn-xs btn-success">Thống kê</a></td>
					<td>{{ ($value->getActive() == 1) ? "Đã kích hoạt" : "Chưa kích hoạt" }}</td>
				</tr>
				@endforeach
			</thead>
		</table>

		@include('admin/partials/paginate', ['data' => $data, 'appended' => ['name' => Request::get('usernames')]])
	</div>
</div>
@endsection