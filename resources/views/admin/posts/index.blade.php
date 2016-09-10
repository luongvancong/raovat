@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Danh sách tin tức
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<form method="get" action="" class="form-filter form-inline" style="margin-bottom:20px;">
						<input type="text" name="title" class="form-control search-box-modules input-sm" placeholder="Tiêu đề" value="{{ Request::get('title', '') }}">
						<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
					</form>
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tiêu đề</th>
								<th>Giá</th>
								<th>Ngày cập nhật</th>
								<th>Tag</th>
								<th>Cho phép đăng</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($posts as $key => $post)
								<tr>
									<td width="50">{{ $post->getId() }}</td>
									<td>{{ $post->getTitle() }}</td>
									<td>{!! format_number($post->getPrice(), 'đ') !!}</td>
									<td>{{ $post->updated_at }}</td>
									<td><a href="{{ route('admin.post.tag.index', [$post->getId()]) }}" class="btn btn-xs btn-info"><i class="fa fa-tag"></i> <span class="badge">{{ $post->tags()->count() }}</span> Tags</a></td>
									<td>
										{!! makeActiveButton(route('admin.post.active', [$post->getId()]), $post->getStatus()) !!}
									</td>
									<td width="30"><a href="{{ route('admin.post.edit', $post->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
									<td width="30"><a href="{{ route('admin.post.delete', $post->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $posts, 'appended' => $_GET])
				</div>
			</div>
		</div>
	</section>
@stop