@extends('admin/layouts/master')

@section('styles')
    <link rel="stylesheet" href="/node_modules/fancybox/dist/css/jquery.fancybox.css">
@endsection

@section('scripts')
    <script type="text/javascript" src="/node_modules/fancybox/dist/js/jquery.fancybox.pack.js"></script>
    <script>
    $(document).ready(function() {
        $('.fancybox').fancybox();
    });
    </script>
@endsection

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
			<h4>
				Danh sách ảnh sản phẩm
			</h4>
		</header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <form method="get" action="" class="form-filter form-inline" style="margin-bottom:20px;">
                        <input type="text" name="id" class="form-control search-box-modules input-sm" placeholder="Id sản phẩm" value="{{ Request::get('id', '') }}">
						<input type="text" name="name" class="form-control search-box-modules input-sm" placeholder="Tên sản phẩm" value="{{ Request::get('name', '') }}">
						<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
					</form>
                    <table class="display table table-bordered table-striped">
                        <thead>
							<tr>
								<th>#</th>
								<th>ID</th>
								<th>Ảnh</th>
								<th>Sản phẩm</th>
                                <th>Show</th>
								<th>Xóa</th>
							</tr>
						</thead>
                        @foreach($picture as $key => $value)
                            <tr>
                                <td> {{ $key+1 }} </td>
                                <td>{{ $value->getId() }}</td>
                                <td align="center">
                                    <a href="{{ PATH_IMAGE_PRODUCT . $value->getImage() }}" class="fancybox" title="{{ $value->presenter()->getProductName($value) }}">
                                        <img class="img-thumbnail" src="{{ PATH_IMAGE_PRODUCT . 'sm_' . $value->getImage() }}" alt="{{ $value->presenter()->getProductName($value) }}" />
                                    </a>
                                </td>
                                <td>{{ $value->presenter()->getProductName($value) }}</td>
                                <td>
                                    {!! makeActiveButton(route('admin.picture.active', [$value->getId()]), $value->getActive() ) !!}
                                </td>
                                <td>
                                    <a href="{{ route('admin.picture.delete', $value->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @include('admin/partials/paginate', ['data' => $picture, 'appended' => ['name' => Request::get('name')]])
                </div>
            </div>
        </div>
    </section>
@stop
