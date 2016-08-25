@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Quản lý banner
				<a href="{{ route('admin.banner.create') }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<form method="get" action="" class="form mg-bt-10">
						<div class="row">
							<div class="col-sm-2">
								<select name="position" class="form-control input-sm">
									<option value="">Vị trí</option>
									@foreach($positionList as $key => $value)
									<option value="{{ $key }}" {{ Request::get('position') == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-2">
								<select name="page" class="form-control input-sm">
									<option value="">Trang đích</option>
									@foreach($pageList as $key => $value)
									<option value="{{ $key }}" {{ Request::get('page') == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-2">
								<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
							</div>
						</div>
					</form>
					<table class="display table table-bordered table-striped">
						<thead>
						<tr>
							<th>Ảnh</th>
							<th>Tiêu đề</th>
							<th>Link</th>
							<th width="80">Kích hoạt</th>
							<th width="30">Sửa</th>
							<th width="30">Xóa</th>
						</tr>
						</thead>
						<tbody>
						@if(!$banners->isEmpty())
							@foreach($banners as $key => $banner)
								<tr>
									<td>
										<img src="{{ $banner->getImage() }}" height="50">
									</td>
									<td>{{ $banner->getTitle() }}</td>
									<td>{{ $banner->getUrl() }}</td>
									<td>
										{!! makeActiveButton(route('admin.banner.active', [$banner->getId()]), $banner->getStatus()) !!}
									</td>
									<td>
										{!! makeEditButton(route('admin.banner.edit', [$banner->getId()])) !!}
									</td>
									<td>
										{!! makeDeleteButton(route('admin.banner.destroy', [$banner->getId()])) !!}
									</td>
								</tr>
							@endforeach
						@else
							<tr>
								<td colspan="8">
									Hiện chưa có banner nào!
								</td>
							</tr>
						@endif
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $banners, 'appended' => Request::all()])
				</div>
			</div>
		</div>
	</section>
@stop
