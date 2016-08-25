@extends('frontend/layout/default')

@section('search-box')
<div id="navbar" class="navbar-collapse collapse">
	<form class="navbar-right navbar-form computer hidden-xs" action="" method="get">
		<div class="input-group">
	      <input type="search" name="q" placeholder="Tìm tin tức liên quan đến sản phẩm?" class="form-control input-search" value="{{ Request::get('q', '') }}" />
	      <span class="input-group-btn">
	        	<button type="submit" class="btn btn-search"> <i class="fa fa-search"></i> Tìm kiếm</button>
	      </span>
	   </div>
	</form>
	<form class="navbar-right navbar-form visible-xs" action="" method="get">
		<div class="input-group">
	      <input type="search" name="q" placeholder="Bạn cần tìm sản phẩm gì?" class="form-control input-search" value="{{ Request::get('q', '') }}" />
	      <span class="input-group-btn">
	        	<button type="submit" class="btn btn-search"> <i class="fa fa-search"></i> Tìm kiếm</button>
	      </span>
	   </div>
	</form>
</div>
@stop

@section('content')

<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
  	{!! getBreadcrumbItem('Trang chủ', '/') !!}
  	{!! getBreadcrumbItem('Tin tức', route('post.index')) !!}
  	{!! getBreadcrumbItem($category->getName(), '', true) !!}
</ol>

<div class="row pd-bt-20">
	<div class="col-sm-12">
		<div class="page-head">
			<h1 class="page-head-block">{{ $category->getName() }}</h1>
		</div>
		<ul class="list-unstyled post-cat-item">
			<li class="pull-left"><a href="{{ route('post.index') }}" title="Tin tức"><h3>Tin tức</h3></a></li>
			@foreach($categories as $pCat)
				@if($category->getId() != $pCat->getId())
					<li class="pull-left">
						<a href="{{ route('post.category', [$pCat->getId(), $pCat->getSlug()]) }}" class="{{ isset($category) && $category->getSlug() == $pCat->getSlug() ? 'active' : '' }}">
							<h3 class="title">{{ $pCat->getName() }}</h3>
						</a>
					</li>
				@endif
			@endforeach
		</ul>
	</div>
</div>

<div class="row">

	<div class="col-sm-12">
		<div class="row">
		@foreach($posts as $post)
			<div class="col-sm-4 col-xs-12 col-md-4 col-lg-3">
				<div class="post-item post-listing">
					<a class="post-url" href="{{ $post->getUrl($category->getId(), $category->getSlug()) }}" title="{{ $post->getTitle() }}">
						<img class="post-img" src="{{ $post->getImage() }}" title="{{ $post->getTitle() }}">
					</a>
					<p class="pit-time mg-bt-0 mg-t-10"><i class="fa fa-calendar"></i> {{ $post->getUpdatedAtStr() }}</p>
					<h2><a href="{{ $post->getUrl() }}" class="post-txt">{{ $post->getTitle() }}</a></h2>
					<h5 class="sapo">{{ cutString($post->getTeaser(), 180) }}</h5>
				</div>
			</div>
		@endforeach
	</div>
	</div>
</div>


<div class="row">
	<div class="col-sm-12 text-center">{!! pagination($posts, $posts->total(), $posts->perPage())  !!}</div>
</div>
@stop