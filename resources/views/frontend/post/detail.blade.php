@extends('frontend/layout/default')

@section('styles')
	<style>
		.timerepeat {
			display: none;
		}
		.wrap_relate {
			display: none;
		}
		.contrelate.d1 {
			display: none;
		}
		.contrelate.d2 {
			display: none;
		}
		.list_gameapp {
			display: none;
		}
	</style>

	<link rel="canonical" href="{{ $post->getCanonicalUrl($category) }}" />

@stop

@section('content')

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage":{
    "@type":"WebPage",
    "@id":"https://google.com/article"
  },
  "headline": "{{ $post->getTitle() }}",
  "image": {
    "@type": "ImageObject",
    "url": "http://{{ getServerName() .  $post->getImage() }}",
    "height": 800,
    "width": 800
  },
  "datePublished": "{{ $post->getDateTimeIso8601() }}",
  "dateModified": "{{ $post->getDateTimeIso8601() }}",
  "author": {
    "@type": "Organization",
    "name": "Giaca.org"
  },
   "publisher": {
    "@type": "Organization",
    "name": "Giaca.org",
    "logo": {
      "@type": "ImageObject",
      "url": "http://{{ getServerName() }}/img/logo.png",
      "width": 197,
      "height": 42
    }
  },
  "description": "{{ $post->getTeaser() }}"
}
</script>

<div id="post-detail-page">

    <div id="breadcrumb">
    	<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
    		{!! getBreadcrumbItem('Trang chủ', '/') !!}
    		{!! getBreadcrumbItem('Tin tức', route('post.index')) !!}
    		{!! getBreadcrumbItem($category->getName(), route('post.category', [$category->getId(), removeTitle($category->getName())])) !!}
    		{!! getBreadcrumbItem($post->getTitle(), '', true) !!}
    	</ol>
    </div>

    <div class="row">
    	<div class="col-sm-7">

    		<div class="page-head mg-bt-10">
    			<h1 class="page-head-block">{{ $post->getTitle() }}</h1>
    		</div>


    		<div class="post-datetime mg-bt-15">
    			<small class="text-default"><i class="fa fa-calendar"></i> Cập nhật lúc: {{ $post->getUpdatedAtStr() }}</small>
    		</div>

    		@if($post->hasTags())
    		<div id="post-tags-product">
    			Tìm mua ngay sản phẩm:
    			@foreach($post->getArrayTags() as $tag)
    				<a class="label label-danger" href="{{ route('searchon', ['q' => $tag]) }}">{{ $tag }}</a>
    			@endforeach
    		</div>
    		@endif
    		<div id="post-content" class="post-content">{!! Xss::clean($post->getContent()) !!}</div>

    		@if($post->tags()->count())
    		<div id="post-tags" class="tag-container">
    			@foreach($post->tags()->get() as $tag)
    				<a href="{{ route('tag.index', $tag->getName()) }}" class="tag-item">{{ $tag->getName() }}</a>
    			@endforeach
    		</div>
    		@endif

    		<!-- Go to www.addthis.com/dashboard to customize your tools -->
    		<div class="addthis_native_toolbox mg-t-20"></div>

    		<div class="post-source">
    			<div class="text-right"><small>Nguồn: {{ $post->getSource() }}</small></div>
    		</div>


            <div class="comments">
                @foreach($post->comments()->get() as $comment)
                    <div class="comment-item">
                        <div class="user-info">
                            <img src="{{ $comment->getUserAvatar() }}" alt="{{ $comment->getUserName() }}">
                            <span>{{ $comment->getUserName() }}</span>
                        </div>
                        <div class="user-comment">{!! $comment->getComment() !!}</div>
                    </div>
                @endforeach
            </div>
    	</div>

    	<div class="col-sm-2 most-view-post">
    		<h3 class="most-view-post-heading">Xem nhiều</h3>
    		@foreach($mostViewPosts as $p)
    		<a href="{{ $p->getUrl($category->getId(), $category->getSlug()) }}" title="{{ $p->getTitle() }}" class="mg-bt-20 block">
    			<img class="lazy" data-src="{{ $p->getImage() }}" data-type="post" data-id="{{ $p->getId() }}" alt="{{ $p->getTitle() }}" style="border: 1px solid #ccc;width:100%;display:block;">
    			<h3 class="title">{{ $p->getTitle() }}</h3>
    		</a>
    		@endforeach
    	</div>

    	<div class="col-sm-3">

    		<div class="ads-col-3 mg-bt-20">
    			<a href="">
    				{{-- <img src="/images/grey.gif" alt="Quang cao" style="border: 1px solid #ccc;width:100%;display:block;"> --}}
    			</a>
    		</div>

    		<div class="most-view-post">
    			<h4 class="most-view-post-heading">Mới nhất</h4>
    			@foreach($newestPosts as $p)
    			<a href="{{ $p->getUrl($category->getId(), $category->getSlug()) }}" title="{{ $p->getTitle() }}" class="mg-bt-20 block">
    				<img class="lazy" data-src="{{ $p->getImage() }}" data-type="post" data-id="{{ $p->getId() }}" alt="{{ $p->getTitle() }}" style="border: 1px solid #ccc;width:100%;display:block;">
    				<h4 class="title">{{ $p->getTitle() }}</h4>
    			</a>
    			@endforeach
    		</div>

    		<div class="page-head mg-bt-10">
    			<h2 class="page-head-block">Sản phẩm liên quan</h2>
    		</div>

    		<ul class="list-unstyled post-releated-product">
    		@foreach($products['items'] as $product)
    			<li class="product-item">
    				<h5><a href="{{ $product->getUrl() }}" title="{{ $product->getName() }}"><i class="fa fa-square"></i> {{ $product->getName() }}</a></h5>
    			</li>
    		@endforeach
    		</ul>
    	</div>
    </div>



    <div class="post-relateds">
    	<div class="row mg-bt-10">
    		<div class="col-sm-12">
    			<div class="page-head">
    				<h2 class="page-head-block">Tin liên quan</h2>
    			</div>
    		</div>
    	</div>

    	<ul class="list-unstyled post-rela-ul">
    		@foreach($relatedPosts as $p)
    			<li>
    				<h2 class="title"><a href="{{ $p->getUrl($category->getId(), $category->getSlug()) }}"><i class="fa fa-square"></i> {{ $p->getTitle() }}</a></h2>
    				<small>{{ $p->getTeaser() }}</small>
    			</li>
    		@endforeach
    	</ul>
    </div>

    <div class="post-relateds">
    	<div class="row mg-bt-10">
    		<div class="col-sm-12">
    			<div class="page-head">
    				<h2 class="page-head-block">Tin cùng danh mục</h2>
    			</div>
    		</div>
    	</div>

    	<ul class="list-unstyled post-rela-ul">
    		@foreach($sameCategoryPosts as $p)
    			<li>
    				<h2 class="title"><a href="{{ $p->getUrl($category->getId(), $category->getSlug()) }}"><i class="fa fa-square"></i> {{ $p->getTitle() }}</a></h2>
    				<small>{{ $p->getTeaser() }}</small>
    			</li>
    		@endforeach
    	</ul>
    </div>
</div>
@stop

@section('scripts')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5674cf635e4c5b26" async="async"></script>
@stop