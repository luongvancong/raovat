@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Video sản phẩm - {{ $product->getName() }}
				<a href="{{ route('admin.product_video.create', [$product->getId()]) }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>Channel</th>
								<th>Title</th>
								<th>Created At</th>
								<th>Updated At</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($productVideos as $key => $video)
								<tr>
									<td>
										<a href="{{ $video->getChannelLink() }}">{{ $video->getChannel() }}</a>
									</td>
									<td><a href="{{ $video->getVideoLink() }}" target="_blank">{{ $video->getTitle() }}</a></td>
									<td>{{ $video->getCreatedAt() }}</td>
									<td>{{ $video->getUpdatedAt() }}</td>
									<td width="30"><a href="{{ route('admin.product_video.delete', $video->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $productVideos, 'appended' => Request::all() ])
				</div>
			</div>
		</div>
	</section>
@stop