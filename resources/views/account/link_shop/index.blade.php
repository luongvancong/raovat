@extends('account/layout/default')

@section('account_breadcrumb')
<div class="col-sm-12">
    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        {!! getBreadcrumbItem('Trang chủ', '/') !!}
        {!! getBreadcrumbItem('Thiết lập tài khoản', route('account.settings')) !!}
        {!! getBreadcrumbItem('Liên kết cửa hàng', '', true) !!}
    </ol>
</div>
@stop

@section('account_content')
<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" class="form form-horizontal">
            <div class="form-group {{ hasValidator('shop_id') }}">
                <label class="control-label col-sm-3">Cửa hàng</label>
                <div class="col-sm-4">
                    <select name="shop_id" id="" class="form-control input-sm select2">
                        <option value="">Chọn một cửa hàng</option>
                        @foreach($sites as $site)
                        <option value="{{ $site->getId() }}" {{ $user->shop_id == $site->getId() ? 'selected="selected"' : '' }}>{{ $site->getName() }}</option>
                        @endforeach
                    </select>
                    {!! alertError('shop_id') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                </div>
            </div>

            {!! csrf_field() !!}
        </form>
    </div>
</div>
@stop

@section('scripts')
<script>
    $(function() {
        $('.select2').select2();
    });
</script>
@stop