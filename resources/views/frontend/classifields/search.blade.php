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

    <div  class="row">
        <div class="col-sm-6">
            <div id="classifield-list" class="row">
                @foreach($classifields as $cf)
                    @include('frontend/classifields/partials/search')
                @endforeach
            </div>
        </div>


        <div id="right-column" class="col-sm-6">
            <div class="row">
                <div class="col-sm-6 product-block">
                    <div class="btn btn-danger">Sản phẩm liên quan</div>
                    <ul class="list-unstyled">
                        @foreach($products as $p)
                            @include('frontend/classifields/partials/product')
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-6">
                    <div class="btn btn-warning">Tin tức liên quan</div>
                    <ul class="list-unstyled">
                        @foreach($posts as $p)
                            @include('frontend/classifields/partials/post')
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
        <div id="paginator-wrapper" class="col-sm-12 text-center">{!! pagination($classifields, $classifields->total(), $classifields->perPage())  !!}</div>
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

            if($this.scrollTop() > 265 && $("#classifield-list").height() >= $(window).height()) {
                $('#right-column').addClass('fixed');
            } else {
                $('#right-column').removeClass('fixed');
            }
        });
    });
</script>
@stop