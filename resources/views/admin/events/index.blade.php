@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Danh sách Event
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
							@foreach ($events as $key => $event)
								<tr>
									<td>{{ $event->getLabel() }}</td>
									<td>{{ $event->getKey() }}</td>
									<td>{{ $event->count }}</td>
									<td><a href="{{ route('admin.event.detail_key', [$event->getKey()]) }}">Chi tiết</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $events, 'appended' => $_GET])
				</div>
			</div>
		</div>
	</section>
@stop