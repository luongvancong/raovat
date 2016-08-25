@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Danh sách tag
                <div class="pull-right">
                    <a href="{{ route('admin.tag.create') }}" class="btn btn-xs btn-primary mg-r-5"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
                </div>
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <form method="get" action="" class="form-filter form-inline mg-bt-10">
                        <input type="text" name="name" value="{{ Request::get('name') }}" class="form-control search-box-modules input-sm" placeholder="Tag" value="{{ Request::get('id', '') }}">
                        Vị trí:
                        @foreach($positions as $positionKey => $positionText)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="position[]" value="{{ $positionKey }}" {{ in_array($positionKey, Request::get('position', [])) ? 'checked' : '' }}> {{ $positionText }}
                            </label>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                    </form>
                    <table class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Vị trí</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $key => $tag)
                                <tr>
                                    <td width="50">{{ $tag->getId() }}</td>
                                    <td>{{ $tag->getName() }}</td>
                                    <td><?php
                                            $__tagPositions = App::make('Nht\Hocs\Tags\TagRepository')->getPositions($tag);
                                            foreach($__tagPositions as $pid) {
                                                echo getPositionByKey($pid) . ', ';
                                            }
                                        ?>
                                    </td>
                                    <td width="30"><a href="{{ route('admin.tag.edit', $tag->getId()) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a></td>
                                    <td width="30"><a href="{{ route('admin.tag.delete', $tag->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('admin/partials/paginate', ['data' => $tags, 'appended' => ['name' => Request::get('name')]])
                </div>
            </div>
        </div>
    </section>
@stop