@extends('account/layout/default')

@section('account_breadcrumb')
<div class="col-sm-12">
    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        {!! getBreadcrumbItem('Trang chủ', '/') !!}
        {!! getBreadcrumbItem('Thiết lập tài khoản', route('account.settings')) !!}
        {!! getBreadcrumbItem('Đấu giá click', '', true) !!}
    </ol>
</div>
@stop

@section('account_content')
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-info">
            <h1 class="acc-igno-heading">
                <div>- Chọn sản phẩm ở cột bên trái để loại bỏ chúng khỏi chiến dịch đấu giá</div>
                <div>- Sản phẩm ở cột bên phải sẽ không được hiển thị ở những vị trí đầu trong danh sách so sánh giá</div>
            </h1>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="account-ignore-products-container-left">
            <select id="left-select-product" class="select2 form-control input-sm">
                <option value="">Chọn một sản phẩm</option>
                @foreach($products as $product)
                    <option value="{{ $product->getId() }}">{{ $product->getName() }}</option>
                @endforeach
            </select>
            <button id="acc-ignopro-submit" class="btn btn-sm btn-primary mg-t-20">Cập nhật</button>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="account-ignore-products-container">
            @foreach($productIgnores as $k => $p)
                <div id="acc-igpro-item-{{ $p->getId() }}" data-id="{{ $p->getId() }}" class="acc-igpro-item">
                    {{ $p->getName() }}
                    <i class="fa fa-close text-danger pointer acc-igitem-close pull-right"></i>
                    <div class="clearfix"></div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $(function() {
        $('.select2').select2();

        $('#left-select-product').on('change', function() {
            var inc = $('.acc-igpro-item:last-child').index();

            var $this = $(this);

            if($('#acc-igpro-item-' + $this.val()).length) {
                return;
            }

            var item = $('<div>');
            item.attr('id', 'acc-igpro-item-' + $this.val());
            item.addClass('acc-igpro-item');
            item.data('id', $this.val());
            item.html($('#left-select-product option:selected').html() + '<i class="fa fa-close text-danger pointer acc-igitem-close pull-right"></i><div class="clearfix"></div>');
            $('.account-ignore-products-container').append(item);

            $('#acc-ignopro-submit').removeClass('hide');

        });


        $(document).on('click', '.acc-igitem-close', function() {
            var $this = $(this);
            $this.parents('.acc-igpro-item').remove();
        });

        function getDataInsert(formdata) {
            $('.acc-igpro-item').each(function() {
                var $item = $(this);
                formdata.append('id[]', $item.data('id'));
            });
        }

        $('#acc-ignopro-submit').on('click', function() {
            var $this = $(this);

            var formdata = new FormData();
            formdata.append('_token', '{{ csrf_token() }}');
            getDataInsert(formdata);

            $.ajax({
                url : '{{ route('account.auction.ignoreProducts', [$auction->getId()]) }}',
                data : formdata,
                processData: false,
                contentType: false,
                type : 'POST',
                beforeSend : function() {
                    $this.attr('disabled', 'disabled');
                },
                success : function(response) {
                    if(response.code == 1) {
                        alert('Cập nhật thành công');
                        window.history.back();
                    }
                }
            })

            console.log(formdata);
        });
    });
</script>
@stop