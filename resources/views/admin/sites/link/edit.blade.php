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
    <h3>{{ $site->getName() }}</h3>
    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">

            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1" id="add-link">

                        <fieldset class="link-field origin-link">
                            <legend class="link-legend">Link</legend>

                            <div class="form-group {{ hasValidator('xpath_id') }}">
                                <label for="input" class="col-sm-2 control-label">Xpath ID :</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select id="xpath_id" name="xpath_id" class="form-control input-sm">
                                        <option value="">Select a xpath or create new xpath</option>
                                        @foreach($xpaths as $xpath)
                                            <option value="{{ $xpath->getId() }}" {{ $link->getXpathId() == $xpath->getId() ? 'selected="selected"' : '' }}>{{ $xpath->getXpathLinkDetail() }}</option>
                                        @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary btn-sm btn-flat" id="add-xpath-action">+</button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ hasValidator('link') }}">
                                <label class="col-sm-2 control-label">Link :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-sm" id="link" name="link" value="{{ Request::old('link', $link->getLink()) }}" placeholder="Link">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input" class="col-sm-2 control-label">Response Type</label>
                                <div class="col-sm-5">
                                    <select name="response_type" class="form-control">
                                        @foreach($typeXpaths as $key => $type)
                                        <option value="{{ $key }}" {{ $key == Request::old('response_type', $link->getResponseType()) ? 'selected="selected"' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group group-key">
                                <label for="input" class="col-sm-2 control-label">Key</label>
                                <div class="col-sm-5">
                                    <input type="text" name="json_key" value="{{ Request::old('json_key', $link->getJsonKey()) }}" class="form-control input-sm">
                                </div>
                            </div>

                            <div class="form-group group-method">
                                <label for="input" class="col-sm-2 control-label">Request Method</label>
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="radio" name="request_method" value="GET" {{ Request::old('request_method', $link->getRequestMethod() == 'GET' ? 'checked="checked"' : '') }}> GET
                                        </label>
                                        <label>
                                            <input type="radio" name="request_method" value="POST" {{ Request::old('request_method', $link->getRequestMethod() == 'POST' ? 'checked="checked"' : '') }}> POST
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group group-header">
                                <label for="input" class="col-sm-2 control-label">Header</label>
                                <div class="col-sm-5">
                                    <textarea class="form-control input-sm" name="header" rows="5">{{ Request::old('header', $link->getHeader()) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group group-cookie">
                                <label for="input" class="col-sm-2 control-label">Cookies</label>
                                <div class="col-sm-5">
                                    <textarea class="form-control input-sm" name="cookies" rows="5">{{ Request::old('cookies', $link->getCookies()) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group group-data">
                                <label for="input" class="col-sm-2 control-label">Form data</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control input-sm" name="form_data" rows="10">{{ Request::old('form_data', $link->getFormData()) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group {{ hasValidator('max_page') }}">
                                <label class="col-sm-3 control-label">Params / Max page / Step:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control input-sm" id="param_page" name="param_page" value="{{ Request::old('param_page', $link->getParamPage()) }}" placeholder="page">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control input-sm" id="max_page" name="max_page" value="{{ Request::old('max_page', $link->getMaxPage()) }}" placeholder="1">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control input-sm" id="step_page" name="step_page" value="{{ Request::old('step_page', $link->getStepPage()) }}" placeholder="1">
                                </div>
                            </div>

                            <div class="form-group" id="show-remove">
                                <label for="input" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-danger remove-link">Remove</button>
                                </div>
                            </div>

                        </fieldset>

                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
                    <a href="{{ route('admin.site.links.index', $site->getId()) }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                </div>
            </div>
            {!! csrf_field() !!}

            {{-- <button type="button" class="btn btn-primary btn-circle btn-lg" id="add-new-link">
                <span class="glyphicon glyphicon-plus"></span>
            </button> --}}

        </form>
    </div>

    @include('admin/sites/xpath/modal_create')

@stop

@section('scripts')
    <script type="text/javascript">
        $( function() {

            $('#add-xpath-action').click(function(e) {
                e.preventDefault();
                $('#modal-create-xpath').modal('toggle');
            });

            $('#form-create-xpath').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url : '{{ route("admin.site.xpath.create", [$site->getId()]) }}',
                    type : 'POST',
                    dataType : 'json',
                    data : $(this).serialize(),
                    success : function(response) {
                        if(response.code == 1) {
                            $('#modal-create-xpath').modal('toggle');
                            var option = '<option value="'+ response.data.id +'">'+ response.data.xpath_link_detail +'</option>';
                            $('#xpath_id').prepend(option);
                        }
                    }
                });
            });

        });
    </script>
@endsection
