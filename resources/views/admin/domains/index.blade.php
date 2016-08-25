@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Product rule list
				<a href="{{ route('admin.domain.create') }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<form method="get" action="" class="form-filter form-inline">
						<label>Tên domain <input type="text" name="domain" class="form-control search-box-modules input-sm" placeholder="Tên domain" value="{{ Request::get('domain', '') }}"></label>
						<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
					</form>
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Domain</th>
								<th>Crawl domain</th>
								<th>Order</th>
								<th>Act</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($domains as $key => $domain)
								<tr>
									<td width="50">{{ $key + 1 }}</td>
									<td>{{ $domain->getAllowedDomain() }}</td>
									<td>{{ $domain->getName() }}</td>
									<td>{{ $domain->getPosisition() }}</td>
									<td width="30">
										{!! makeActiveButton(route('admin.domain.active', [$domain->getId()]), $domain->getStatus()) !!}
									</td>
									<td width="30"><a href="{{ route('admin.domain.edit', $domain->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
									<td width="30"><a href="{{ route('admin.domain.destroy', $domain->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $domains, 'appended' => ['name' => Request::get('domain')]])
				</div>
			</div>
		</div>
	</section>
@stop