@extends('admin/layouts/master')

@section('main-content')
    <section class="panel">
        <header class="panel-heading">
            <h4>
                Video
                <a href="{{ route('admin.video.findFromYoutube') }}" class="btn btn-xs btn-primary pull-right"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
            </h4>
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <div class="dataTables_wrapper">
                    <form method="get" action="" class="form-filter form-inline mg-bt-10">
                        <input type="text" name="id" class="form-control search-box-modules input-sm" placeholder="ID sản phẩm" value="{{ Request::get('id', '') }}">
                        <input type="text" name="title" class="form-control search-box-modules input-sm" placeholder="Tên sản phẩm" value="{{ Request::get('title', '') }}">
                        <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-search"></i> {{ trans('form.btn.search') }}</button>
                    </form>
                    <table class="display table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Channel</th>
                                <th>Title</th>
                                <th>Tag</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $key => $video)
                                <tr>
                                    <td>{{ $video->getId() }}</td>
                                    <td>
                                        <a href="{{ $video->getChannelLink() }}">{{ $video->getChannel() }}</a>
                                    </td>
                                    <td><a href="{{ $video->getVideoLink() }}" target="_blank">{{ $video->getTitle() }}</a></td>
                                    <td><a href="{{ route('admin.video.tag.index', [$video->getId()]) }}" class="btn btn-xs btn-info"><i class="fa fa-tag"></i> <span class="budget">{{ $video->tags()->count() }}</span> Tags</a></td>
                                    <td>{{ $video->getCreatedAt() }}</td>
                                    <td>{{ $video->getUpdatedAt() }}</td>
                                    <td width="30"><a href="{{ route('admin.video.delete', $video->getId()) }}" class="btn btn-xs btn-danger btn-delete-action"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @include('admin/partials/paginate', ['data' => $videos, 'appended' => Request::all() ])
                </div>
            </div>
        </div>
    </section>
@stop