@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Giá sản phẩm - {{ $product->getName() }}
				<a href="{{ route('admin.price_rule.create', [$product->getId()]) }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>Link</th>
								<th>Rule</th>
								<th>Created At</th>
								<th>Updated At</th>
								<th>Sửa</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($priceRules as $key => $priceRule)
								<tr>
									<td>
										<a href="{{ $priceRule->getLink() }}">{{ $priceRule->getLink() }}</a>
									</td>
									<td>{{ $priceRule->getRule() }}</td>
									<td>{{ $priceRule->getCreatedAt() }}</td>
									<td>{{ $priceRule->getUpdatedAt() }}</td>
									<td width="30"><a href="{{ route('admin.price_rule.edit', $priceRule->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
									<td width="30"><a href="{{ route('admin.price_rule.delete', $priceRule->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $priceRules, 'appended' => Request::all() ])
				</div>
			</div>
		</div>
	</section>
@stop