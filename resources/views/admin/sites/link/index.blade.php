@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                {{ $site->getName() }}
                <div class="pull-right">
                    <a href="{{ route('admin.site.links.create', $site->getId()) }}" class="btn btn-xs btn-primary mg-r-5"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
                    <form id="form-link" class="form-inline mg-r-5" action="{{ route('admin.links.import', $site->getId()) }}" method="post" enctype="multipart/form-data">
						<span class="btn btn-primary btn-xs btn-file">
				            <input type="hidden" name="action-import" value="import-link"/>
				            Import Link
							<input type="file" id="import-link" name="import-link">
							{!! csrf_field() !!}
				        </span>
					</form>
                    <a href="{{ route('admin.site.index') }}" class="btn btn-xs btn-danger mg-r-5">Quay lại</a>
                </div>
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <form method="get" action="" class="form-filter form-inline mg-bt-10">
                        <input type="text" name="id" class="form-control search-box-modules input-sm" placeholder="ID" value="{{ Request::get('id', '') }}">
                        <input type="text" name="link" class="form-control search-box-modules input-sm" placeholder="Link" value="{{ Request::get('link', '') }}">
                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                    </form>
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Link</th>
                            <th>Method</th>
                            <th>Page</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                            <th>Xem</th>
                        </thead>
                        <tbody>
                            @foreach($links as $key => $data)
                                <tr>
                                    <td>{{ $data->getId() }}</td>

                                    <td>{{ $data->getLink() }}</td>

                                    <td>{{ $data->getRequestMethod() }}</td>

                                    <td>{{ $data->getMaxPage() }}</td>

                                    <td width="30"><a href="{{ route('admin.site.links.edit', [$site->getId(), $data->getId()] ) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
                                    <td width="30"><a href="{{ route('admin.site.links.delete', [$site->getId(), $data->getId()] ) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
                                    <td width="30"><a href="javascript:;" class="action-open-info" data-target="#info-hidden-{{ $data->getId() }}"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr id="info-hidden-{{ $data->getId() }}" class="hide">
                                    <td colspan="100">
                                        <table class="table">
                                            <tr>
                                                <td>Xpath ID</td>
                                                <td>
                                                    <a href="" class="editable-select-xpathID" data-field="xpath_id" data-id="{{ $data->getId() }}" data-value="{{ $data->getXpathId() }}">

                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Max page</td>
                                                <td><a href="" class="editable" data-id="{{ $data->getId() }}" data-field="max_page">{{ $data->getMaxPage() }}</a></td>
                                            </tr>
                                        </table>
                                    </td>
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

@section('scripts')
<script src="/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script>
    $(function() {
        $('.action-open-info').click(function() {
            var $this = $(this);
            var $target = $($this.data('target'));
            $target.toggleClass('hide');
        });

        $('#import-link').change(function() {
			$('#form-link').submit();
		});

        $.fn.editable.defaults.mode = 'inline';

        $.fn.editableform.template = [
            '<form class="form-inline editableform">',
                '<div class="control-group">',
                    '<div class="editable-input"></div>',
                    '<div class="editable-error-block"></div>',
                '</div>',
            '</form>',
        ].join('');

        $.fn.editableform.buttons = '';

        $('.editable').each(function() {
            var $this = $(this);
            var field = $this.data('field');
            $this.editable({
                ajaxOptions : {
                    type : 'PUT'
                },
                // type : 'text',
                url : '{{ route('admin.link.quickedit') }}',
                pk: $this.data('id'),
                params : {
                    _token : '{{ csrf_token() }}',
                    field : $this.data('field'),
                    id : $this.data('id')
                }
            });
        });

        // Quick edit hsx
        $('.editable-select-hsx').each(function() {
            var $this = $(this);
            $this.editable({
                ajaxOptions : {
                    type : 'PUT'
                },
                type : 'select',
                source : {!! $brandEdiables !!},
                url : '{{ route('admin.link.quickedit') }}',
                pk : $this.data('id'),
                params : {
                    _token : '{{ csrf_token() }}',
                    field : $this.data('field'),
                    id : $this.data('id')
                }
            });
        });

        // Quick edit xpath ID
        $('.editable-select-xpathID').each(function() {
            var $this = $(this);
            $this.editable({
                ajaxOptions : {
                    type : 'PUT'
                },
                type : 'select',
                source : {!! $xpathEdiables !!},
                url : '{{ route('admin.link.quickedit') }}',
                pk : $this.data('id'),
                params : {
                    _token : '{{ csrf_token() }}',
                    field : $this.data('field'),
                    id : $this.data('id')
                }
            });
        });

    });
</script>
@stop
