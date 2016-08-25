@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                {{ $site->getName() }}
                <div class="pull-right">
                    <a href="{{ route('admin.site.xpath.create', $site->getId()) }}" class="btn btn-xs btn-primary mg-r-5"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
                    <a href="javascript:window.history.back()" class="btn btn-xs btn-danger mg-r-5">Quay lại</a>
                </div>
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Link</th>
                            <th>Price</th>
                            <th>Name</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </thead>
                        <tbody>
                            @foreach($xpaths as $key => $xpath)
                                <tr>
                                    <td>{{ $xpath->getId() }}</td>

                                    <td>{{ $xpath->getXpathLinkDetail() }}</td>

                                    <td>{{ $xpath->getXpathPrice() }}</td>

                                    <td>{{ $xpath->getXpathName() }}</td>

                                    <td>{!! makeEditButton(route('admin.site.xpath.edit', $xpath->getId())) !!}</td>

                                    <td>{!! makeDeleteButton(route('admin.site.xpath.delete', $xpath->getId())) !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@stop

@section('styles')
<link href="/bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<style>
    .editable-container.editable-inline {
        width: 100%;
    }
    .editable-input {
        display: block !important;
    }
    .editableform .form-control {
        width: 100%;
    }
    .control-group.form-group {
        width: 100%;
    }
</style>
@stop

@section('scripts')
<script src="/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
@stop