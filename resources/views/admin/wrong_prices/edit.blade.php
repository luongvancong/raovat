@extends('admin/layouts/master')

@section('main-content')
<h3>Sửa giá</h3>

<div class="panel-body">
    <form class="form-horizontal bucket-form" method="post" action enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-sm-3 control-label">Giá</label>
            <div class="col-sm-6">
                <div class="input-group">
                    <input type="text" name="price" class="form-control price" value="{{ $price->getPrice() }}">
                    <div class="input-group-addon price-format">{{ $price->getPriceStr() }}</div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> {{ trans('form.btn.update') }}</button>
            <a href="{{ route('admin.wrongPrice.index') }}" class="btn btn-link">{{ trans('form.btn.back') }}</a>
            </div>
        </div>
        {!! csrf_field() !!}
    </form>
</div>

@stop

@section('scripts')
<script>
    $(function() {
        $('.price').keyup(function() {
            var $this = $(this);
            $this.next().text(number_format($this.val(), 0, '.', '.'));
        });
    });
</script>
@stop