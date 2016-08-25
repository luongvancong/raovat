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
        {!! getBreadcrumbItem('Tạo chiến dịch', route('account.auction.create'), true) !!}
    </ol>
</div>
@stop

@section('account_content')
<div class="row">
    <div class="col-sm-12">
        <div class="auction-header">
            <h1 class="auction-head"><i class="fa fa-legal"></i> Tham gia đấu giá click</h1>
            <div class="auction-sapo">
                <h2>- Nhanh tay tham gia đấu giá, đưa sản phẩm cửa hàng của bạn hiển thị ở vị trí đầu tiên</h2>
                <h2>- Phí click là số tiền bạn trả cho mỗi click của khách hàng khi xem sản phẩm của bạn</h2>
            </div>
        </div>
        <form action="" method="POST" class="form form-horizontal">
            <!-- <div class="form-group {{ hasValidator('product_id') }}">
                <label class="control-label col-sm-3">Sản phẩm</label>
                <div class="col-sm-4">
                    <select name="product_id" id="product_id" class="form-control input-sm select2">
                        <option value="">Chọn một sản phẩm</option>
                        @foreach($products as $product)
                        <option value="{{ $product->getId() }}" {{ Request::old('product_id') == $product->getId() ? 'selected="selected"' : '' }}>{{ $product->getName() }}</option>
                        @endforeach
                    </select>
                    {!! alertError('product_id') !!}
                </div>
            </div> -->

            <div class="form-group">
                <label class="control-label col-sm-3">Giá đấu cao nhất hiện tại là</label>
                <div class="col-sm-6">
                    <p class="form-control-static"><span id="max-money-per-click" class="text-danger">{{ formatCurrency($minMoneyPerClick) }}</span> <sup>đ</sup> (Bạn nên đặt cao hơn giá cao nhất)</p>
                </div>
            </div>

            <div class="form-group {{ hasValidator('money_per_click') }}">
                <label class="control-label col-sm-3">Mức đấu giá / Click</label>
                <div class="col-sm-4">
                    <select name="money_per_click" id="" class="form-control input-sm">
                        <option value="">Chọn giá</option>
                        @for($i = $minMoneyPerClick; $i <= 10000; $i += 500)
                        <option value="{{ $i }}" {{ Request::old('money_per_click') == $i ? 'selected="selected"' : '' }}>{{ formatCurrency($i) }} VND</option>
                        @endfor
                    </select>
                    {!! alertError('money_per_click') !!}
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3">Thời gian</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="input-group" id="start_date">
                                <input type="text" placeholder="Từ ngày" class="datepicker form-control" name="start_date" value="{{ Request::get('start_date', date('d/m/Y')) }}">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>

                        </div>

                        <div class="col-sm-4">
                            <div class="input-group" id="end_date">
                                <input type="text" placeholder="Đến ngày" class="datepicker form-control" name="end_date" value="{{ Request::get('end_date', date('d/m/Y', strtotime("+1 months"))) }}">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group {{ hasValidator('budget') }}">
                <label class="control-label col-sm-3">Ngân sách</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="text" name="budget" class="form-control input-sm" value="{{ Request::old('budget') }}">
                        <div class="input-group-addon">
                            <span>{{ formatCurrency((int) Request::old('budget', 0)) }}</span>
                        </div>
                    </div>

                    {!! alertError('budget') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                    <a href="/" class="btn btn-sm btn-default">Thoát</a>
                </div>
            </div>

            {!! csrf_field() !!}
        </form>

        <div class="well btn-flat">
            <ul>
                <li>Số tiền hiện có tài khoản của bạn: <span id="user_money">{{ formatCurrency($user->money) }}</span> <sup>đ</sup> <a href="{{ route('account.chargeMoney.intro') }}"><small>Nạp tiền</small></a></li>
            </ul>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(function() {
        var userMoney = {{ (int) $user->money }};

        $('#start_date, #end_date').datetimepicker({
            locale: 'vi',
            sideBySide: true,
        });

        $('.select2').select2();

        $('#product_id').change(function() {
            var $this = $(this);
            $.ajax({
                url : '{{ route('account.auction.getMaxMoneyPerClickToProduct') }}',
                data : {
                    product_id : $this.val(),
                    _token : '{{ csrf_token() }}'
                },
                type : 'POST',
                success : function(response) {
                    $('#max-money-per-click').text(number_format(response));
                }
            });
        });


    });
</script>
@stop