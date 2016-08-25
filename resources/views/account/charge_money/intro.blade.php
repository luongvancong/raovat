@extends('account/layout/default');

@section('account_breadcrumb')
<div class="col-sm-12">
    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        {!! getBreadcrumbItem('Trang chủ', '/') !!}
        {!! getBreadcrumbItem('Thiết lập tài khoản', route('account.settings')) !!}
        {!! getBreadcrumbItem('Nạp tiền', '', true) !!}
    </ol>
</div>
@stop

@section('account_content')
<div class="charge-money">
    <h1>Hướng dẫn nạp tiền</h1>
    <div class="content">
        <p>
            Quý khách hàng nạp tiền vào tài khoản vui lòng chuyển tiền vào một trong các tài khoản bên dưới với nội dung "{{ $syntaxChargeMoney }}"
        </p>
        <ul class="list-unstyled">
            <li>
                <label><span class="badge">1</span></label>
                <table class="table">
                    <tr>
                        <td>Ngân hàng</td>
                        <td>Vietcombank</td>
                    </tr>
                    <tr>
                        <td>Số tài khoản</td>
                        <td>0211 0000 87698</td>
                    </tr>
                    <tr>
                        <td>Chủ tài khoản</td>
                        <td>TRAN TRUNG MANH</td>
                    </tr>
                </table>
            </li>
            <li>
                <label><span class="badge">2</span></label>
                <table class="table">
                    <tr>
                        <td>Ngân hàng</td>
                        <td>Maritimebank</td>
                    </tr>
                    <tr>
                        <td>Số tài khoản</td>
                        <td>1100 1010 710 888</td>
                    </tr>
                    <tr>
                        <td>Chủ tài khoản</td>
                        <td>TRAN TRUNG MANH</td>
                    </tr>
                </table>
            </li>
        </ul>
    </div>
</div>
@stop