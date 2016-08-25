@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Báo sai giá
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <form method="get" action="" class="form-filter form-inline mg-bt-10">
                        <input type="text" name="title" class="form-control search-box-modules input-sm" placeholder="Tên" value="{{ Request::get('title', '') }}">

                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                    </form>
                    <table class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Giá hiện tại</th>
                                <th>Link</th>
                                <th>Lỗi</th>
                                <th>Lúc</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wrongPrices as $wrongPrice)
                                <tr>
                                    <td width="50">{{ $wrongPrice->getId() }}</td>
                                    <td>{{ $wrongPrice->getProductName() }}</td>
                                    <td>{{ $wrongPrice->getPriceStr() }}</td>
                                    <td>{{ $wrongPrice->getOriginLink() }}</td>
                                    <td>{{ $wrongPrice->error_label }}</td>
                                    <td>{{ $wrongPrice->reported_at }}</td>
                                    <td width="30"><a href="{{ route('admin.wrongPrice.edit', [$wrongPrice->getId(), $wrongPrice->report_id]) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
                                    <td width="30"><a href="{{ route('admin.wrongPrice.delete', [$wrongPrice->getId(), $wrongPrice->report_id]) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('admin/partials/paginate', ['data' => $wrongPrices, 'appended' => ['title' => Request::get('title')]])
                </div>
            </div>
        </div>
    </section>
@stop