@extends('admin/layouts/master')

@section('main-content')
    <h3>Thêm Tag</h3>
    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">
            <div class="form-group {{ hasValidator('name') }}">
                <label for="email" class="col-sm-3 control-label">Tên <b class="text-danger">*</b></label>
                <div class="col-sm-6 text-center">
                    <input type="text" class="form-control" id="name" value="{{ Request::old('name') }}" name="name">
                    {!! alertError('name') !!}
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Slug</label>
                <div class="col-sm-6 text-center">
                    <input type="text" class="form-control" value="{{ Request::old('slug') }}" id="slug" name="slug">
                </div>
            </div>

            <div class="form-group {{ hasValidator('meta_title') }}">
                <label for="email" class="col-sm-3 control-label">Meta title</label>
                <div class="col-sm-6 text-center">
                    <input type="text" class="form-control" value="{{ Request::old('meta_title') }}" name="meta_title">
                    {!! alertError('meta_title') !!}
                </div>
            </div>

            <div class="form-group {{ hasValidator('meta_keywords') }}">
                <label for="email" class="col-sm-3 control-label">Meta keywords</label>
                <div class="col-sm-6 text-center">
                    <input type="text" class="form-control" value="{{ Request::old('meta_keywords') }}" name="meta_keywords">
                    {!! alertError('meta_keywords') !!}
                </div>
            </div>

            <div class="form-group {{ hasValidator('meta_description') }}">
                <label for="email" class="col-sm-3 control-label">Meta description</label>
                <div class="col-sm-6 text-center">
                    <textarea class="form-control" name="meta_description">{{ Request::old('meta_description') }}</textarea>
                    {!! alertError('meta_description') !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Vị trí</label>
                <div class="col-sm-6">
                    <select name="position[]" multiple="true" class="form-control">
                        @foreach($positions as $key => $position)
                            <option value="{{ $key }}" {{ in_array($key, Request::get('position', [])) ? 'selected="selected"' : '' }}>{{ $position }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.create') }}</button>
                <a href="{{ route('admin.tag.index') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
                </div>
            </div>
            {!! csrf_field() !!}
        </form>
    </div>
@stop

@section('scripts')
<script>
    $(function() {
        $('#name').on('keyup', function() {
            var slug = removeAccents($(this).val());
            slug = strSlug(slug, '-');
            console.log($(this).val());
            console.log(slug);
            $('#slug').val(slug);
        });
    });
</script>
@stop