@extends('frontend/layout/default')

@section('search-box')
<h1 class="hide">{{ $setting->getTitle() }}</h1>
<div id="navbar" class="navbar-collapse collapse">
	<form class="navbar-right navbar-form computer hidden-xs" action="" method="get">
		<div class="input-group">
	      <input type="search" name="q" placeholder="Tìm video liên quan đến sản phẩm?" class="form-control input-search" value="{{ Request::get('q', '') }}" />
	      <span class="input-group-btn">
	        	<button type="submit" class="btn btn-search"> <i class="fa fa-search"></i> Tìm kiếm</button>
	      </span>
	   </div>
	</form>
	<form class="navbar-right navbar-form visible-xs" action="" method="get">
		<div class="input-group">
	      <input type="search" name="q" placeholder="Tìm video liên quan đến sản phẩm?" class="form-control input-search" value="{{ Request::get('q', '') }}" />
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
					<a href="{{ route('compare') }}">So sánh</a>
				</li>
				<li class="mg-bt-5">
					<a href="{{ route('video.index') }}">Video review</a>
				</li>
			</ul>
	   </div>
	</form>
</div>
@stop

@section('content')

<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
  	{!! getBreadcrumbItem('Trang chủ', '/') !!}
  	{!! getBreadcrumbItem('Video', route('video.index'), true) !!}
</ol>


<div class="row mg-bt-10">
	<div class="col-sm-12">
		<div class="page-head">
			<h3 class="page-head-block">Video</h3>
		</div>
	</div>
</div>

<div class="row">
	@foreach($videos as $video)
		<div class="col-sm-4 col-xs-12 col-md-4 col-lg-3">
			<div class="post-item video-item">
				<a class="post-url" href="{{ $video->getUrl() }}" title="{{ $video->getTitle() }}">
					<i class="fa fa-play-circle video-play-icon"></i>
					<img class="post-img" src="{{ $video->getImage() }}" alt="{{ $video->getTitle() }}" title="{{ $video->getTitle() }}">
				</a>
				<h2><a class="post-txt" href="{{ $video->getUrl() }}" title="{{ $video->getTitle() }}">{{ $video->getTitle() }}</a></h2>
				<small class="teaser">{{ $video->getTeaser() }}</small>
			</div>
		</div>
	@endforeach
</div>

<div class="row">
	<div class="col-sm-12 text-center">{!! pagination($videos, $videos->total(), $videos->perPage())  !!}</div>
</div>
@stop