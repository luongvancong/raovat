@extends('admin/layouts/master')

@section('main-content')
    <h3>Nạp tiền</h3>
    <div class="panel-body">
        <form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">
            <div class="form-group {{ hasValidator('user_id') }}">
                <label for="email" class="col-sm-3 control-label">ID User <b class="text-danger">*</b></label>
                <div class="col-sm-3 text-center">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('user_id') }}" name="user_id">
                    {!! alertError('user_id') !!}
                </div>
            </div>

            <div class="form-group {{ hasValidator('money') }}">
                <label for="email" class="col-sm-3 control-label">Money <b class="text-danger">*</b></label>
                <div class="col-sm-3 text-center">
                    <input type="text" class="form-control input-sm" value="{{ Request::old('money') }}" name="money">
                    {!! alertError('money') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-3">
                    <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                </div>
            </div>

            {!! csrf_field() !!}
        </form>
    </div>
@stop