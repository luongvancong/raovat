@extends('frontend/layout/default')

@section('content')

<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
  	{!! getBreadcrumbItem('Trang chủ', '/') !!}
  	{!! getBreadcrumbItem('Video', route('video.index')) !!}
  	{!! getBreadcrumbItem($video->getTitle(), '', true) !!}
</ol>

<div class="row">
	<div class="col-sm-7">
		<div class="page-head">
			<h1 class="page-head-block">{{ $video->getTitle() }}</h1>
		</div>

		<p class="video-detail-teaser">{{ $video->getTeaser() }}</p>

		<div class="post-content pd-t-10">
			<div class="text-center" style="margin-bottom: 20px;">
				{!! $video->getEmbed() !!}
			</div>
		</div>
	</div>

	<div class="col-sm-2">
		@for($i = 0; $i < 2; $i ++)
		<a href="#" title="Ads" class="mg-bt-10 block">
			<img src="/images/grey.gif" alt="Quang cao" style="border: 1px solid #ccc;width:100%;display:block;">
		</a>
		@endfor
	</div>

	<div class="col-sm-3">
		<div class="page-head">
			<h3 class="page-head-block">Sản phẩm liên quan</h3>
		</div>
		<ul class="list-unstyled pd-t-10 video-rl-product">
		@forelse($products['items'] as $product)
			<li class="item"><a href="{{ $product->getUrl() }}" title="{{ $product->getName() }}"><i class="fa fa-square"></i> {{ $product->getName() }}</a></li>
		@empty
			<li><a href="javascript:;">Chưa có sản phẩm nào</a></li>
		@endforelse
		</ul>

		<div class="ads-col-3 mg-bt-20">
			<a href="">
				<img src="/images/grey.gif" alt="Quang cao" style="border: 1px solid #ccc;width:100%;display:block;">
			</a>
		</div>
	</div>


</div>


<div class="post-relateds">
	<div class="row">
		<div class="col-sm-12">
			<div class="page-head">
				<h1 class="page-head-block">Video liên quan</h1>
			</div>
		</div>
	</div>
	<ul class="list-unstyled video-related post-rela-ul pd-t-10">
		@foreach($relatedVideos as $v)
			<li>
				<div>
					<a class="link" href="{{ $v->getUrl() }}"><h2><i class="fa fa-square icon"></i> {{ $v->getTitle() }}</h2></a>
				</div>
				<small class="teaser">{{ $v->getTeaser() }}</small>
			</li>
		@endforeach
	</ul>
</div>

@stop

