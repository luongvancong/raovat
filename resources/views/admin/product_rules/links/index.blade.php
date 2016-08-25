@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                {{ $site->getName() }}
                <div class="pull-right">
                    <a href="{{ route('admin.productLink.create', ['site_id' => $site->getId()]) }}" class="btn btn-xs btn-primary mg-r-5"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
                    <a href="{{ route('admin.productLink.index', ['site_id' => $site->getId()]) }}" class="btn btn-xs btn-danger mg-r-5">Quay lại</a>
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
                            <th>Method</th>
                            <th>Page</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </thead>
                        <tbody>
                            @foreach($links as $key => $data)
                                <tr>
                                    <td>{{ $data->getId() }}</td>

                                    <td>{{ $data->getUrl() }}</td>

                                    <td>{{ $data->getRequestMethod() }}</td>

                                    <td>{{ $data->getMaxPage() }}</td>

                                    <td width="30"><a href="{{ route('admin.productLink.edit', [$data->getId()] ) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
                                    <td width="30"><a href="{{ route('admin.productLink.delete', [$data->getId()] ) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>

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
    .btn-file {
        position: relative;
        overflow: hidden;
        width: auto !important;
    }

    .form-inline {
        cursor: pointer;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: pointer;
        display: block;
    }

    .form-inline {
        display: inline-block !important;
    }
</style>
@stop

