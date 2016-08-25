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
        {{ $site->getName() }}
        <div class="pull-right">
            <a href="{{ route('admin.site.xpath', $site->getId()) }}" class="btn btn-xs btn-primary mg-r-5"><i class="fa fa-plus"></i> {{ trans('form.btn.create') }}</a>
            <a href="javascript:window.history.back()" class="btn btn-xs btn-danger mg-r-5">Quay lại</a>
        </div>
    </h3>
    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Link (Xpath or Text)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('xpath_link_detail', $xpath->getXpathLinkDetail()) }}" name="xpath_link_detail" placeholder="Link">
                </div>
            </div>

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Tên (Xpath or Text)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('xpath_name', $xpath->getXpathName()) }}" name="xpath_name" placeholder="Tên">
                </div>
            </div>

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Giá (Xpath or Text)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('xpath_price', $xpath->getXpathPrice()) }}" name="xpath_price" placeholder="Giá">
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
