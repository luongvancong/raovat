@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Lịch chạy lấy giá
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">

                    <table class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Thứ 2</th>
                                <th>Thứ 3</th>
                                <th>Thứ 4</th>
                                <th>Thứ 5</th>
                                <th>Thứ 6</th>
                                <th>Thứ 7</th>
                                <th>Chủ nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            @for ($i = 0; $i <= 6; $i++)
                                <td>
                                    <a href="{{ route('admin.cronjob.getByDay', [$i]) }}">
                                        <span class="label label-info">{{ App::make('Nht\Hocs\Sites\SiteRepository')->countSiteCronByDay($i) }} sites</span>
                                        <span class="label label-danger">{{ App::make('Nht\Hocs\Sites\SiteRepository')->countPageByDay($i) }} pages</span>
                                    </a>
                                </td>
                            @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop