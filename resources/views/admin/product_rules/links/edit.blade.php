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
    <h3>Add Link</h3>
    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">

            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-1" id="add-link">

                        <fieldset class="link-field origin-link">
                            <legend class="link-legend">Link</legend>

                            <div class="form-group {{ hasValidator('site_id') }}">
                                <label for="input" class="col-sm-2 control-label">Site ID :</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select id="site_id" name="site_id" class="form-control input-sm">
                                        <option value="">Select a site</option>
                                        @foreach($sites as $sit)
                                            <option value="{{ $sit->getId() }}" {{ $sit->getId() == Request::old('site_id', $link->getSiteId()) ? 'selected="selected"' : '' }}>{{ $sit->getName() }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ hasValidator('brand_id') }}">
                                <label for="input" class="col-sm-2 control-label">Brand :</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select id="brand_id" name="brand_id" class="form-control input-sm select2">
                                        <option value="">Select a brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->getId() }}" {{ $brand->getId() == Request::old('brand_id', $link->getBrandId()) ? 'selected="selected"' : '' }}>{{ $brand->getName() }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ hasValidator('brand_id') }}">
                                <label for="input" class="col-sm-2 control-label">Device:</label>
                                <div class="col-sm-10">
                                    @foreach($deviceOptions as $key => $value)
                                        <label class="radio-inline">
                                            <input type="radio" name="type_device" value="{{ $key }}" {{ Request::old('type_device', $currentDevice) == $key ? 'checked' : '' }}> {{ $value }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group {{ hasValidator('xpath_id') }}">
                                <label for="input" class="col-sm-2 control-label">Xpath ID :</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select id="xpath_id" name="xpath_id" class="form-control input-sm">
                                        <option value="">Select a xpath</option>
                                        @foreach($xpaths as $xpath)
                                            <option value="{{ $xpath->getId() }}" {{ Request::old('xpath_id', $link->getXpathId()) == $xpath->getId() ? 'selected="selected"' : '' }}>{{ $xpath->getLink() }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ hasValidator('url') }}">
                                <label class="col-sm-2 control-label">Link :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control input-sm" id="url" name="url" value="{{ Request::old('url', $link->getUrl()) }}" placeholder="Link">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input" class="col-sm-2 control-label">Response Type</label>
                                <div class="col-sm-5">
                                    <select name="response_type" class="form-control">
                                        @foreach($responseTypes as $key => $type)
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
                                            <input type="radio" name="request_method" value="GET" {{ Request::old('request_method', $link->getRequestMethod()) == 'GET' ? 'checked' : '' }}> GET
                                        </label>
                                        <label>
                                            <input type="radio" name="request_method" value="POST" {{ Request::old('request_method', $link->getRequestMethod()) == 'POST' ? 'checked' : '' }}> POST
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

                            <div class="form-group {{ hasValidator('page') }}">
                                <label class="col-sm-3 control-label">Params/ Max page / Step:</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control input-sm" id="param_page" name="param_page" value="{{ Request::old('param_page', $link->getParamPage()) }}" placeholder="page">
                                    {!! alertError('param_page') !!}
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
                    <a href="{{ route('admin.productLink.index', ['site_id' => $site->getId()]) }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                </div>
            </div>
            {!! csrf_field() !!}

        </form>
    </div>

@stop

@section('scripts')
<script>
    $(function() {
        $('.select2').select2();
    });
</script>
@stop
