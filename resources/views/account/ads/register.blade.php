@extends('account/layout/default')

@section('account_breadcrumb')
<div class="col-sm-12">
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', '/') !!}
            {!! getBreadcrumbItem('Thiết lập tài khoản', route('account.settings')) !!}
            {!! getBreadcrumbItem('Quản lý quảng cáo', route('account.ads')) !!}
            {!! getBreadcrumbItem('Đăng ký quảng cáo', '', true) !!}
        </ol>
    </div>
@stop

@section('account_content')
<div class="row mg-bt-30">
    <div class="col-sm-12">
        <p align="center">Bạn có thể để lại thông tin của bạn vào form bên dưới. Chúng tôi sẽ liên lạc lại với bạn trong thời gian sớm nhất.</p>

        <form action="" class="form form-horizontal mg-t-30" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label class="control-label col-sm-3">Họ tên:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control btn-flat" name="name" value="{{ Request::old('name', $user->getName()) }}">
                    {!! alertError('name') !!}
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3">Số điện thoại:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control btn-flat" name="phone" value="{{ Request::old('phone', $user->getPhone()) }}">
                    {!! alertError('phone') !!}
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3">Email:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control btn-flat" name="email" value="{{ Request::old('email', $user->getEmail()) }}">
                    {!! alertError('phone') !!}
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3">Tin nhắn:</label>
                <div class="col-sm-6">
                    <textarea type="text" class="form-control btn-flat" name="content">{{ Request::old('content') }}</textarea>
                    {!! alertError('content') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-sm btn-primary">Gửi thông tin</button>
                </div>
            </div>
            {!! csrf_field() !!}

        </form>
    </div>
</div>
@stop