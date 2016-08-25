@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Xpath
                <div class="pull-right">
                    <a href="{{ route('admin.productXpath.create') }}" class="btn btn-xs btn-primary">Tạo xpath</a>
                    <a href="{{ route('admin.productRule.index') }}" class="btn btn-xs btn-danger mg-r-5">Quay lại</a>
                </div>
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">

                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <th width="30">ID</th>
                            <th>Link</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th width="30">Edit</th>
                            <th width="30">Delete</th>
                        </thead>
                        <tbody>
                            @foreach($xpaths as $xpath)
                            <tr>
                                <td>{{ $xpath->getId() }}</td>
                                <td>{{ $xpath->getLink() }}</td>
                                <td>{{ $xpath->getName() }}</td>
                                <td>{{ $xpath->getPrice() }}</td>
                                <td>{!! makeEditButton(route('admin.productXpath.edit', [$xpath->getId()])) !!}</td>
                                <td>{!! makeDeleteButton(route('admin.productXpath.delete', [$xpath->getId()])) !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop


