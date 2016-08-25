@extends('frontend/layout/default')

@section('search-box')
<div id="navbar" class="navbar-collapse collapse">
    <form class="form-search-raovat navbar-right navbar-form computer hidden-xs" action="" method="get">
        <div class="input-group">
            <input type="search" name="q" placeholder="Tìm kiếm rao vặt" class="form-control input-search" value="{{ $keyword }}" />
            <span class="input-group-btn">
                <button type="submit" class="btn btn-search"> <i class="fa fa-search"></i> Tìm kiếm</button>
            </span>
       </div>
    </form>
    <form class="form-search-raovat navbar-right navbar-form visible-xs" action="" method="get">
        <div class="input-group">
            <input type="search" name="q" placeholder="Tìm kiếm rao vặt?" class="form-control input-search" value="{{ $keyword }}" />
            <span class="input-group-btn">
                <button type="submit" class="btn btn-search"> <i class="fa fa-search"></i> Tìm kiếm</button>
            </span>
       </div>
       <div class="form-group">
        <ul class="list-unstyled mg-t-10">
            <li class="mg-bt-5">
                <a href="{{ route('post.index') }}">Tin tức</a>
            </li>
            <li class="mg-bt-5">
                <a href="{{ route('video.index') }}">Video</a>
            </li>
        </ul>
       </div>
    </form>
</div>
@stop

@section('content')
    @yield('content')
@stop

@section('scripts')
    <script>
        $(function() {
            // Redirect for search page
            $('.form-search-raovat').on('submit', function(e) {
                e.preventDefault();
                var q = $(this).find('[name="q"]').val();
                window.location.href = '/rao-vat/tim-kiem/' + q + '.html';
            });
        });
    </script>
    @yield('raovat_scripts')
@stop