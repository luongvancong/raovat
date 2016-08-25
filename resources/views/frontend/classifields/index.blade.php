@extends('frontend/classifields/layout')


@section('content')

<div id="raovat-page">
    <div id="breadcrumb">
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', url()) !!}
            {!! getBreadcrumbItem('Rao vặt', '', true) !!}
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-12 pd-bt-20">
            <h1 class="heading pd-bt-5">Tổng hợp rao vặt</h1>
            <h2 class="sub-heading">Cập nhật thông tin rao vặt từ vatgia.com, chotot.vn...</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="page-head mg-bt-10">
                <h1 class="page-head-block">Rao vặt</h1>
            </div>
            <div id="classifield-list" class="row">
                @foreach($classifields as $cf)
                    @include('frontend/classifields/partials/item')
                @endforeach
            </div>
        </div>
        <div id="right-column" class="col-sm-6">
            <div class="row">
                <div  class="col-sm-6 product-block">
                    <div class="page-head-mm mg-bt-10">
                        <h1 class="page-head-block btn btn-danger">Sản phẩm hot</h1>
                    </div>
                    <ul class="list-unstyled">
                        @foreach($productHots as $p)
                            @include('frontend/classifields/partials/product')
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-6 product-block">
                    <div class="page-head-mm mg-bt-10">
                        <h1 class="page-head-block btn btn-warning">Nhiều người bán</h1>
                    </div>
                    <ul class="list-unstyled">
                        @foreach($productHaveMoreShops as $p)
                            @include('frontend/classifields/partials/product')
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-12">
            <div id="pl-loading" class="text-center"></div>
        </div>
        <div id="paginator-wrapper" class="col-sm-12 text-center">
            {!! pagination($classifields, $classifields->total(), $classifields->perPage())  !!}
        </div>
    </div>

</div>
@stop

@section("raovat_scripts")
<script src="/bower_components/jquery-infinite-scroll/jquery.infinitescroll.js"></script>
<script>
    $(function() {
        // SCROLL PAGINATION
        $('#classifield-list').infinitescroll({
            loading: {
                msgText: "<div>Đang tải thêm...</div>",
                selector : '#pl-loading'
            },
            extraScrollPx: 500,
            dataType: 'json',
            appendCallback: false,
            nextSelector: "#custom-pagination li.active + li > a",
            navSelector: "#custom-pagination"
        }, function(response, opts) {
            if(response.currentPage <= 9) {
                if(response.code == 1) {
                    $('#classifield-list').append(response.html);
                    $('#paginator-wrapper').html(response.html_pagination);
                    // $('#button-load-more').html(response.html_button_viewmore);
                } else {
                    $('#paginator-wrapper').html('');
                    // $('#button-load-more').html('');
                }
            } else {
                $('#classifield-list').infinitescroll('pause');
            }

            $('#custom-pagination').show();
        });


        $(window).scroll(function() {
            var $this = $(this);

            if($this.scrollTop() > 265) {
                $('#right-column').addClass('fixed');
            } else {
                $('#right-column').removeClass('fixed');
            }
        });
    });
</script>
@stop