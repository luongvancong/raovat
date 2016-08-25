@extends('frontend/layout/default')

@section('content')

<div class="row mg-bt-30">
    <div class="col-sm-12">
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', '/') !!}
            {!! getBreadcrumbItem('Thông tin cá nhân', '', true) !!}
        </ol>
    </div>
    <div class="col-sm-3">
        <div class="prf-img-crop">
            <img src="{{ $user->getImage('md_') }}" alt="{{ $user->getName() }}" class="img-responsive">
        </div>

    </div>
    <div class="col-sm-9">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Thông tin cá nhân</a></li>
            <li role="presentation"><a href="#change_pass" aria-controls="change_pass" role="tab" data-toggle="tab">Thay avatar</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <form action="" class="form form-horizontal mg-t-30" method="POST">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Tên đầy đủ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control btn-flat" name="name" value="{{ Request::old('name', $user->getName()) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Phone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control btn-flat" name="phone" value="{{ Request::old('phone', $user->getPhone()) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Địa chỉ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control btn-flat" name="address" value="{{ Request::old('address', $user->getAddress()) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                        </div>
                    </div>
                    {!! csrf_field() !!}
                </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="change_pass">
                <form action="{{ route('profile.change_avatar') }}" method="POST" enctype="multipart/form-data" class="form form-horizontal mg-t-30">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Chọn ảnh</label>
                        <div class="col-sm-6">
                            <input type="file" name="file" class="form-control btn-flat">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                        </div>
                    </div>
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>

    </div>
</div>
@stop