@extends('frontend/layout/default')

@section('content')

    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        {!! getBreadcrumbItem('Trang chủ', '/') !!}
        {!! getBreadcrumbItem($tag, '', true) !!}
    </ol>

    <div class="row">

        <div class="col-sm-12">
            <div class="main-primary">
                <section class="contentOuter listProducts">

                    <div class="page-head">
                        <h3 class="page-head-block">{{ $products->total() }} sản phẩm</h3>
                    </div>

                    <div class="row pd-t-10">
                        <div class="col-sm-12 hidden-xs mg-bt-20">
                            <form id="form-sort" action="" method="GET">
                                <input type="hidden" name="q" value="{{ Request::get('q') }}">
                                <input type="hidden" name="page" value="{{ Request::get('page') }}">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <select name="sort_by" class="sort-control input-sm form-control btn-flat">
                                            <option value="">Sắp xếp theo</option>
                                            @foreach($arraySort as $key => $value)
                                            <option value="{{ $key }}" {{ $key == Request::get('sort_by') ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" placeholder="Giá từ" name="price_from" value="{{ Request::get('price_from') }}" class="form-control input-sm btn-flat">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" placeholder="đến" name="price_to" value="{{ Request::get('price_to') }}" class="form-control input-sm btn-flat">
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="submit" class="btn btn-black btn-sm block" style="width: 100%"><i class="fa fa-filter"></i> Lọc</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @forelse ($products as $product)
                            {!! $product->presenter()->getItem() !!}
                        @empty
                            <div class="col-sm-12">
                                <div class="alert alert-info mg-t-20 btn-flat">Không tìm thấy sản phẩm phù hợp</div>
                            </div>
                        @endforelse
                        <div class="col-sm-12">{!! pagination($products, $products->total(), $products->perPage())  !!}</div>
                    </div>

                </section>


                @if($posts->count())
                <section class="contentOuter listPosts">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-head">
                                <h3 class="page-head-block">Bài viết</h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12 pd-t-20">
                            <div class="row">
                            @forelse($posts as $post)
                                <div class="col-sm-4 col-xs-12 col-md-4 col-lg-3">
                                    <div class="post-item">
                                        <a class="post-url" href="{{ $post->getUrl() }}" title="{{ $post->getTitle() }}">
                                            <img class="post-img lazy" data-type="post" data-id="{{ $post->getId() }}" data-src="{{ $post->getImage() }}" alt="{{ $post->getTitle() }}" title="{{ $post->getTitle() }}">
                                        </a>
                                        <p class="pit-time mg-bt-0 mg-t-10"><i class="fa fa-calendar"></i> {{ $post->getUpdatedAtStr() }}</p>
                                        <h2><a href="{{ $post->getUrl() }}" class="post-txt">{{ $post->getTitle() }}</a></h2>
                                    </div>
                                </div>
                            @empty
                                <p class="col-sm-12">Hiện chưa có tin tức liên quan đến sản phẩm này</p>
                            @endforelse
                                <div class="col-sm-12 text-center mg-bt-30">
                                    <a target="_blank" title="Xem tất cả tin liên quan" href="{{ route('post.index') }}?q={{ Request::get('q') }}" class="btn btn-primary btn-md">Xem tất cả tin liên quan</a>
                                </div>
                            </div>
                        </div>
                </section>
                @endif


                @if($videos->count())
                <section class="contentOuter listPosts">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-head">
                                <h3 class="page-head-block">Tìm thấy Video</h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-12 pd-t-20">
                            <div class="row">
                            @forelse($videos as $video)
                                <div class="col-sm-4 col-xs-12 col-md-4 col-lg-3">
                                    <div class="post-item">
                                        <a class="post-url" href="{{ $video->getUrl() }}" title="{{ $video->getTitle() }}">
                                            <i class="fa fa-play-circle video-play-icon"></i>
                                            <img class="post-img" src="{{ $video->getImage() }}" alt="{{ $video->getTitle() }}" title="{{ $video->getTitle() }}">
                                        </a>
                                        <h2><a class="post-txt" href="{{ $video->getUrl() }}" title="{{ $video->getTitle() }}">{{ $video->getTitle() }}</a></h2>
                                    </div>
                                </div>
                            @empty
                                <p class="col-sm-12">Hiện chưa có video liên quan đến sản phẩm này</p>
                            @endforelse
                                <div class="col-sm-12 text-center mg-bt-30">
                                    <a target="_blank" title="Xem tất cả video liên quan" href="{{ route('video.index') }}?q={{ Request::get('q') }}" class="btn btn-primary btn-md">Xem tất cả video liên quan</a>
                                </div>
                            </div>
                        </div>
                </section>
                @endif

        </div>
    </div>
@stop

@section('scripts')
<script>
    $(function() {
        $('.sort-control').on('change', function() {
            $('#form-sort').submit();
        });
    });
</script>
@stop