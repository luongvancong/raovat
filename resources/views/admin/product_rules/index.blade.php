@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Site lấy sản phẩm
                <div class="pull-right">
                    <a href="{{ route('admin.productXpath.create') }}" class="btn btn-xs btn-primary">Tạo xpath</a>
                    <a href="{{ route('admin.site.index') }}" class="btn btn-xs btn-danger mg-r-5">Quay lại</a>
                </div>
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">

                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <th width="30">ID</th>
                            <th>Name</th>
                            <th>Xpath</th>
                            <th>Link</th>
                        </thead>
                        <tbody>
                            @foreach($sites as $site)
                            <tr>
                                <td>{{ $site->getId() }}</td>
                                <td>{{ $site->getName() }}</td>
                                <td><a href="{{ route('admin.productXpath.index', ['site_id' => $site->getId()]) }}"><span class="badge">{{ $site->productXpath->count() }}</span></a></td>
                                <td><a href="{{ route('admin.productLink.index', ['site_id' => $site->getId()]) }}"><span class="badge">{{ $site->productLink->count() }}</span></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop


