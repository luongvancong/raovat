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
            <a href="javascript:window.history.back()" class="btn btn-xs btn-danger mg-r-5">Quay lại</a>
        </div>
    </h3>
    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">

            <div class="form-group group-link">
                <label for="input" class="col-sm-2 control-label">Link (Xpath or Text)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('xpath_link_detail', $xpath->getXpathLinkDetail()) }}" name="xpath_link_detail" placeholder="Link" required="required">
                </div>
            </div>

            <div class="form-group group-price">
                <label for="input" class="col-sm-2 control-label">Giá (Xpath or Text)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('price', $xpath->getXpathPrice()) }}" name="xpath_price" placeholder="Giá" required="required">
                </div>
            </div>

            <div class="form-group group-name">
                <label for="input" class="col-sm-2 control-label">Tên (Xpath or Text)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('name', $xpath->getXpathName()) }}" name="xpath_name" placeholder="Tên" required="required">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
                    <a href="javascript:window.history.back()" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                </div>
            </div>

            {!! csrf_field() !!}

            <input type="hidden" name="site_id" value="{{ $site->getId() }}">

        </form>
    </div>
@stop

@section('scripts')
<script>
    $(function(){
        if($('select[name="type"]').val() == 0) {
            // $('.group-data, .group-header, .group-data, .group-method, .group-key').hide();
        }

        $('select[name="type"]').change(function() {
            var type = $(this).val();

            switch(type) {
                // Response html
                case 1:

                case 2:

                case 3:
            }
        });
    });
</script>
@stop
