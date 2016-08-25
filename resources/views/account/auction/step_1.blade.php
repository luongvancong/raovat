@extends('account/layout/default')

@section('styles')
    <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
@endsection

@section('account_breadcrumb')
<div class="col-sm-12">
    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        {!! getBreadcrumbItem('Trang chủ', '/') !!}
        {!! getBreadcrumbItem('Thiết lập tài khoản', route('account.settings')) !!}
        {!! getBreadcrumbItem('Đấu giá click', route('account.auction')) !!}
        {!! getBreadcrumbItem('Bước 1', route('account.auction.create'), true) !!}
    </ol>
</div>
@stop

@section('account_content')
<div class="row">
    <div class="col-sm-12">
        <div class="auction-header">
            <h1 class="auction-head"><i class="fa fa-legal"></i> Bước 1: Liên kết tài khoản với cửa hàng trên hệ thống</h1>
            <div class="auction-sapo">
                <h2>- Chúng tôi muốn biết bạn muốn quảng cáo cho cửa hàng nào</h2>
            </div>
        </div>

        <form action="{{ route('account.linkToShop') }}" method="POST" class="form form-horizontal">
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
                    <button type="submit" class="btn btn-primary btn-sm">Tiếp theo</button>
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