@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Quản lý đánh giá
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <!-- <form method="get" action="" class="form-filter form-inline mg-bt-10">

                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                    </form> -->
                    <table class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Tổng đánh giá</th>
                                <th>Trung bình</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rates as $rate)
                                <tr>
                                    <td width="50">{{ $rate->getId() }}</td>
                                    <td>{{ $rate->product_name }}</td>
                                    <td>{{ $rate->total_rate }}</td>
                                    <td>{{ $rate->avg }} <i class="fa fa-star text-danger"></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('admin/partials/paginate', ['data' => $rates, 'appended' => $_GET])
                </div>
            </div>
        </div>
    </section>
@stop

