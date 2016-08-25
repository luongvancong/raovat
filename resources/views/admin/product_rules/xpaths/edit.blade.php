@extends('admin/layouts/master')

@section('styles')
    <style>
        body label{
            font-size: 12px !important;
        }

        .form-group {
            padding-bottom: 0px !important;
        }
    </style>
@endsection

@section('main-content')
    <h3>
        <div class="pull-right">
            <a href="javascript:window.history.back()" class="btn btn-xs btn-danger mg-r-5">Quay lại</a>
        </div>
        <div class="clearfix"></div>
    </h3>
    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Site</label>
                <div class="col-sm-10">
                    <select name="site_id" class="form-control input-sm select2">
                        <option value="">Site</option>
                        @foreach($sites as $st)
                            <option value="{{ $st->getId() }}" {{ Request::old('site_id', $xpath->getSiteId()) == $st->getId() ? 'selected="selected"' : '' }}>{{ $st->getName() }}</option>
                        @endforeach
                    </select>
                    {!! alertError('site_id') !!}
                </div>
            </div>

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Link (Xpath or Text)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('link_item', $xpath->getLink()) }}" name="link_item" placeholder="Link">
                    {!! alertError('link_item') !!}
                </div>
            </div>

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Tên (Xpath or Text)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('name', $xpath->getName()) }}" name="name" placeholder="Tên">
                    {!! alertError('name') !!}
                </div>
            </div>

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Giá (Xpath or Text)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('price', $xpath->getPrice()) }}" name="price" placeholder="Giá">
                    {!! alertError('price') !!}
                </div>
            </div>

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Image (Xpath or Text)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('image', $xpath->getImage()) }}" name="image">
                    {!! alertError('image') !!}
                </div>
            </div>

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Images (Xpath or Text)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('images', $xpath->getImages()) }}" name="images">
                    {!! alertError('images') !!}
                </div>
            </div>

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Spec</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('spec', $xpath->getSpec()) }}" name="spec">
                    {!! alertError('spec') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
                    <a href="javascript:window.history.back()" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                </div>
            </div>
            {!! csrf_field() !!}

        </form>
    </div>
@stop

@section('scripts')
<script src="bower_components/select2/dist/js/select2.min.js"></script>
<script>
    $(function() {
        $('.select2').select2();
    });
</script>
@stop
