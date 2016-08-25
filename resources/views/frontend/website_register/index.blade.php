@extends('frontend/layout/default')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', '/') !!}
            {!! getBreadcrumbItem('Đăng ký website', '', true) !!}
        </ol>

        <div class="page-header">
            <h1>Đăng ký website tham gia hệ thống</h1>
        </div>
        <form action="" class="form form-horizontal" method="POST">
            <div class="form-group {{ hasValidator('url') }}">
                <label class="control-label col-sm-3">Url</label>
                <div class="col-sm-6">
                    <input type="text" name="url" value="{{ Request::old('url') }}" placeholder="Ví dụ: http://thegioididong.com" class="form-control btn-flat">
                    {!! alertError('url') !!}
                </div>
            </div>
            <div class="form-group {{ hasValidator('alias') }}">
                <label class="control-label col-sm-3">Tên website</label>
                <div class="col-sm-6">
                    <input type="text" name="alias" value="{{ Request::old('alias') }}" placeholder="Ví dụ: thegioididong" class="form-control btn-flat">
                    {!! alertError('alias') !!}
                </div>
            </div>
            <div class="form-group {{ hasValidator('email') }}">
                <label class="control-label col-sm-3">Email</label>
                <div class="col-sm-6">
                    <input type="text" name="email" value="{{ Request::old('email') }}"  class="form-control btn-flat">
                    {!! alertError('email') !!}
                </div>
            </div>
            <div class="form-group {{ hasValidator('city_id') }}">
                <label class="control-label col-sm-3">Tỉnh/Thành phố</label>
                <div class="col-sm-6">
                    <select name="city_id" id="city_id" class="form-control btn-flat">
                        <option value="">Chọn một giá trị</option>
                        @foreach($cities as $city)
                        <option value="{{ $city->cit_id }}" {{ Request::old('city_id') == $city->cit_id ? 'selected="selected"' : '' }}>{{ $city->cit_name }}</option>
                        @endforeach
                    </select>
                    {!! alertError('city_id') !!}
                </div>
            </div>
            <div class="form-group {{ hasValidator('district_id') }}">
                <label class="control-label col-sm-3">Quận/huyện</label>
                <div class="col-sm-6">
                    <select name="district_id" id="district_id" class="form-control btn-flat">
                        <option value="">Chọn một giá trị</option>
                    </select>
                    {!! alertError('district_id') !!}
                </div>
            </div>

            <div class="form-group {{ hasValidator('address') }}">
                <label class="control-label col-sm-3">Địa chỉ</label>
                <div class="col-sm-6">
                    <input type="text" name="address" value="{{ Request::old('address') }}" class="form-control btn-flat">
                    {!! alertError('address') !!}
                </div>
            </div>

            <div class="form-group {{ hasValidator('phone') }}">
                <label class="control-label col-sm-3">Số điện thoại</label>
                <div class="col-sm-6">
                    <input type="text" name="phone" value="{{ Request::old('phone') }}" class="form-control btn-flat">
                    {!! alertError('phone') !!}
                </div>
            </div>
            <div class="form-group {{ hasValidator('fax') }}">
                <label class="control-label col-sm-3">Số fax</label>
                <div class="col-sm-6">
                    <input type="text" name="fax" value="{{ Request::old('fax') }}" class="form-control btn-flat">
                    {!! alertError('fax') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </div>
</div>

@stop

@section('scripts')
<script>
    $(function() {
        var oldCityId = {{ Request::old('city_id', 0) }};
        var oldDistrictId = {{ Request::old('district_id', 0) }};
        function ajaxCities(params) {
            var cityId = params.city_id;
            return $.ajax({
                url: '{{ route('ajax.districts') }}',
                type : 'GET',
                dataType : 'json',
                data : {
                    city_id : cityId
                },
                success : function(districts) {
                    var $district = $('#district_id');
                    $district.find('.item').remove();
                    var selected = '';
                    for(i in districts) {
                        if(districts[i].cit_id == oldDistrictId) {
                            selected = 'selected="selected"';
                        }else{
                            selected = '';
                        }
                        $district.append('<option  '+ selected +' class="item" value="'+ districts[i].cit_id +'">'+ districts[i].cit_name +'</option>');
                    }
                }
            });
        }

        if(oldCityId > 0) {
            ajaxCities({
                city_id : oldCityId
            });
        }

        $('#city_id').on('change', function() {
            var $this = $(this);
            ajaxCities({
                city_id : $this.val()
            })
        });
    });
</script>
@stop