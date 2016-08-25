@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Danh sách Event Group
				<a href="{{ route('admin.event_group.create') }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>Label</th>
								<th>Key</th>
								<th>Total</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($groups as $key => $group)
								<tr>
									<td>{{ $group->getName() }}</td>
									<td>{{ $group->getKey() }}</td>
									<td>{{ App::make('Nht\Hocs\Events\EventRepository')->countEventGroup($group->getKey()) }}</td>
									<td><a href="{{ route('admin.event.detail_key', [$group->getKey()]) }}">Chi tiết</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
@stop