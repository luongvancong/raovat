@extends('admin/layouts/master')

@section('styles')
	<style media="screen">
		.btn-file {
			position: relative;
			overflow: hidden;
			width: auto !important;
		}

		.form-inline {
			cursor: pointer;
		}

		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: white;
			cursor: pointer;
			display: block;
		}

		.form-inline {
			display: inline-block !important;
		}
	</style>
@endsection

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Danh sách site
				<div class="pull-right">
					<a href="{{ route('admin.site.create') }}" class="btn btn-xs btn-primary mg-r-5"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
					<a href="{{ route('admin.site.sync') }}" class="btn btn-xs btn-danger mg-r-5"><i class="fa fa-sync"></i> Đồng bộ</a>

					<a href="{{ route('admin.site.getRankAlexa') }}" class="btn btn-xs btn-info">Cập nhật rank</a>
					<a href="{{ route('admin.site.updateTotalLinks') }}" class="btn btn-xs btn-warning">Cập nhật total links</a>

					<form id="form-xpath" class="form-inline mg-r-5" action="{{ route('admin.site.import') }}" method="post" enctype="multipart/form-data">
						<span class="btn btn-primary btn-xs btn-file">
				            <input type="hidden" name="action-import" value="import-xpath"/>
				            Import Xpath
							<input type="file" id="import-xpath" name="import-xpath">
							{!! csrf_field() !!}
				        </span>
					</form>

				</div>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<div class="row">

						<form method="get" action="" class="form-filter form-inline mg-bt-10">
							<div class="col-sm-10">
								<input type="text" name="id" class="form-control search-box-modules input-sm" placeholder="ID" value="{{ Request::get('id', '') }}">
								<input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Tên" value="{{ Request::get('name', '') }}">
								<select name="allow_crawl" class="form-control input-sm">
									<option value="">Cho phép crawl</option>
									@foreach($allowCrawlOptions as $key => $value)
									<option value="{{ $key }}" {{ Request::get('allow_crawl', -1) == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
									@endforeach
								</select>
								<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
							</div>
							<div class="col-sm-2">
								<select name="sort" class="form-control input-sm">
									<option value="">Sắp xếp</option>
									@foreach($sortOptions as $key => $value)
									<option value="{{ $key }}" {{ Request::get('sort') == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
									@endforeach
								</select>
							</div>
						</form>

						<div class="clearfix"></div>
					</div>
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Logo</th>
								<th>Tên</th>
								<th width="30">Links</th>
								<th width="30"><small>Nổi bật</small></th>
								<th>Xpath/Links</th>
								<th>Testing</th>
								<th>Run now</th>
								<th>Allow crawl</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($sites as $key => $site)
								<tr>
									<td width="50">{{ $site->getId() }}</td>
									<td>
										<img src="{{ $site->getImage() }}" height="30" style="max-width: 100px;">
									</td>
									<td>
										<p>{{ $site->getName() }}</p>
										<p class="text-default"><small><i class="fa fa-calendar"></i> {{ $site->getUpdatedAtStr() }}</small></p>
										<p class="text-info"><small><i class="fa fa-magic"></i> {{ $site->getRank() }} alexa</small></p>
									</td>
									<td>{{ $site->getTotalLinks() }}</td>
									<td>{!! makeActiveButton(route('admin.site.hot', [$site->getId()]), $site->getHot()) !!}</td>
									<td>
										@if($site->parent_id == 0)
											<a href="{{ route('admin.site.xpath', [$site->getId()]) }}" class="btn btn-xs btn-primary"><span class="badge">{{ $site->meta()->count() }}</span> Xpath</a>
											<a href="{{ route('admin.site.links.index', [$site->getId()]) }}" class="btn btn-xs btn-info"><span class="badge">{{ $site->links()->count() }}</span> Links</a>
											<a href="{{ route('admin.site.cronjob', [$site->getId()]) }}" class="btn btn-xs btn-danger"><span class="badge">{{ $site->cronjob()->count() }}</span> Cronjob</a>
										@endif
									</td>
									<td width="30">
										@if($site->parent_id == 0)
											{!! makeActiveButton(route('admin.site.toggleEnvTesting', [$site->getId()]), $site->getEnvTesting()) !!}
										@endif
									</td>
									<td width="30">
										@if($site->parent_id == 0)
											{!! makeActiveButton(route('admin.site.toggleEnvQuick', [$site->getId()]), $site->getEnvQuick()) !!}
										@endif
									</td>
									<td width="30">
										@if($site->parent_id == 0)
											{!! makeActiveButton(route('admin.site.toggleAllowCrawl', [$site->getId()]), $site->allow_crawl) !!}
										@endif
									</td>
									<td width="30"><a href="{{ route('admin.site.edit', $site->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
									<td width="30"><a href="{{ route('admin.site.delete', $site->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
								</tr>

								@foreach($site->branchs()->get() as $bk => $branch)
								<tr>
									<td colspan="1000">
										<p><i class="badge">{{ $bk+1 }}</i> {{ $branch->getAlias() }}</p>
										<p>{{ $branch->getAddress() }}</p>
										<a href="{{ route('admin.site.edit', [$branch->getId()]) }}" class="btn btn-xs btn-danger">Edit</a>
									</td>
								</tr>
								@endforeach
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $sites, 'appended' => $_GET])
				</div>
			</div>
		</div>
	</section>
@stop

@section('scripts')

<script>
	$(function() {
		$(document).on('action_active_success', function() {
			window.location.reload();
		});


		$('select[name="sort"]').change(function() {
			$('.form-filter').submit();
		});

		$('#import-xpath').change(function() {
			$('#form-xpath').submit();
		});
	});
</script>
@stop
