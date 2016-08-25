@extends('frontend/layout/default')

@section('content')
<div id="search-page">
	<div class="row">

		<div class="col-sm-12">
			<div class="main-primary">
				<h3 class="mg-bt-5">Kết quả tìm kiếm với từ khóa "{{ clean($q) }}"</h3>
				<section class="contentOuter listProducts">
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="page-head-none">
								<div class="btn-group">
									<a href="" class="btn btn-sm btn-default hidden-{{ $totalResultProduct }}"><span class="badge">{{ formatCurrency($totalResultProduct) }}</span> sản phẩm</a>
									<a href="" class="btn btn-sm btn-default hidden-{{ $totalResultPost }}"><span class="badge">{{ formatCurrency($totalResultPost) }}</span> tin tức</a>
									<a href="" class="btn btn-sm btn-default hidden-{{ $totalResultVideo }}"><span class="badge">{{ formatCurrency($totalResultVideo) }}</span> video</a>
									<a href="" class="btn btn-sm btn-default hidden-{{ $totalResultQuestion }}"><span class="badge">{{ formatCurrency($totalResultQuestion) }}</span> hỏi đáp</a>
									<a href="" class="btn btn-sm btn-default hidden-{{ $totalResultClassifield }}"><span class="badge">{{ formatCurrency($totalResultClassifield) }}</span> rao vặt</a>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="col-sm-6 hidden-xs hidden-sm">
							<form id="form-sort" action="" method="GET">
                                <input type="hidden" name="q" value="{{ Request::get('q') }}">
                                <input type="hidden" name="page" value="{{ Request::get('page') }}">
                                <div class="row">
                                    <div class="col-sm-3 control-bound pd-bt-5">
                                        <select name="sort_by" class="sort-control form-control input-sm btn-flat">
                                            <option value="">Sắp xếp theo</option>
                                            @foreach($arraySort as $key => $value)
                                            <option value="{{ $key }}" {{ $key == Request::get('sort_by') ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3 control-bound pd-bt-5">
                                        <input type="text" placeholder="Giá từ" name="price_from" value="{{ Request::get('price_from') }}" class="form-control input-sm btn-flat">
                                    </div>
                                    <div class="col-sm-3 control-bound pd-bt-5">
                                        <input type="text" placeholder="đến" name="price_to" value="{{ Request::get('price_to') }}" class="form-control input-sm btn-flat">
                                    </div>
                                    <div class="col-sm-3 control-bound pd-bt-5">
                                        <button type="submit" class="btn btn-black btn-sm block" style="width: 100%"><i class="fa fa-filter"></i> Lọc</button>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>

					{{-- FILTER CONTROLS --}}
					<div class="row pd-t-20">
						<div class="col-sm-6">

						</div>
					</div>

					<div class="row pd-t-20">
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

				<section class="contentOuter listPosts">
					<div class="row">
						<div class="col-sm-12">
							<div class="page-head">
								<h3 class="page-head-block">{{ formatCurrency($totalResultPost) }} tin tức "{{ $q }}"</h3>
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
								Hiện chưa có tin tức liên quan đến sản phẩm này
							@endforelse
								<div class="col-sm-12 text-center mg-bt-30">
									<a target="_blank" title="Xem tất cả tin liên quan" href="{{ route('post.index') }}?q={{ Request::get('q') }}" class="btn btn-primary btn-md">Xem tất cả tin liên quan</a>
								</div>
							</div>
						</div>
				</section>

				<section class="contentOuter listPosts hidden-{{ $totalResultVideo }}">
					<div class="row">
						<div class="col-sm-12">
							<div class="page-head">
								<h3 class="page-head-block">{{ formatCurrency($totalResultVideo) }} video "{{ $q }}"</h3>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-12 pd-t-20">
							<div class="row">
							@foreach($videos as $video)
								<div class="col-sm-4 col-xs-12 col-md-4 col-lg-3">
									<div class="post-item">
										<a class="post-url" href="{{ $video->getUrl() }}" title="{{ $video->getTitle() }}">
											<i class="fa fa-play-circle video-play-icon"></i>
											<img class="post-img" src="{{ $video->getImage() }}" alt="{{ $video->getTitle() }}" title="{{ $video->getTitle() }}">
										</a>
										<h2><a class="post-txt" href="{{ $video->getUrl() }}" title="{{ $video->getTitle() }}">{{ $video->getTitle() }}</a></h2>
									</div>
								</div>
							@endforeach
								<div class="col-sm-12 text-center mg-bt-30">
									<a target="_blank" title="Xem tất cả video liên quan" href="{{ route('video.index') }}?q={{ Request::get('q') }}" class="btn btn-primary btn-md">Xem tất cả video liên quan</a>
								</div>
							</div>
						</div>
					</div>
				</section>

				<section class="contentOuter listQuestion hidden-{{ $totalResultQuestion }}">
					<div class="row">
						<div class="col-sm-12">
							<div class="page-head">
								<h3 class="page-head-block">{{ formatCurrency($totalResultQuestion) }} hỏi đáp "{{ $q }}"</h3>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-12 pd-t-20">
							<div class="row">
							@foreach($questions as $k => $question)
								<div class="col-sm-12">
									<div class="hoidap-item">
										<a class="hoidap-url" href="{{ $question->getUrl() }}" title="{{ $question->getQuestion() }}"></a>
										<h2><a class="hoidap-txt" href="{{ $question->getUrl() }}" title="{{ $question->getQuestion() }}">{{ ($k+1) . '. ' . $question->getQuestion() }}</a></h2>
									</div>
								</div>
							@endforeach
								<div class="col-sm-12 text-center mg-bt-30 mg-t-20">
									<a target="_blank" title="Xem tất cả hỏi đáp liên quan" href="{{ route('hoidap.search',$q) }}" class="btn btn-primary btn-md">Xem tất cả hỏi đáp liên quan</a>
								</div>
							</div>
						</div>
					</div>
				</section>


				<section class="contentOuter listPosts hidden-{{ $totalResultClassifield }}">
					<div class="row">
						<div class="col-sm-12">
							<div class="page-head">
								<h3 class="page-head-block">{{ formatCurrency($totalResultClassifield) }} rao vặt "{{ $q }}"</h3>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-12 pd-t-20">
							<div class="row">
							@foreach($classifields as $cf)
								<div class="col-sm-3 col-xs-6 col-md-4 col-lg-2">
									<div class="raovat-item">
										<a class="raovat-url" href="{{ $cf->getUrl() }}" title="{{ $cf->getTitle() }}">
											<img class="raovat-img" src="{{ $cf->getImage() }}" alt="{{ $cf->getTitle() }}" title="{{ $cf->getTitle() }}">
										</a>
										<div>
											<span class="label label-danger">{{ $cf->presenter()->getPrice() }}</span>
										</div>
										<h2>
											<a class="raovat-txt" href="{{ $cf->getUrl() }}" title="{{ $cf->getTitle() }}">
												{{ $cf->getTitle() }}
											</a>
										</h2>
									</div>
								</div>
							@endforeach
								<div class="col-sm-12 text-center mg-bt-30 mg-t-20">
									<a target="_blank" title="Xem tất cả rao vặt liên quan" href="{{ route('raovat.search', $q) }}" class="btn btn-primary btn-md">Xem tất cả rao vặt liên quan</a>
								</div>
							</div>
						</div>
					</div>
				</section>

		</div>
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