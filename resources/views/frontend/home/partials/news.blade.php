<div class="row mg-t-30">
    <section class="contentOuter post-home list-posts col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="hp-post newspaper">
                    <a href="{{ route('post.index') }}" title="Tin tức công nghệ">Tin tức</a>
                </h3>
            </div>
        </div>
        <div class="row">
            @foreach($posts as $p)
                @include('frontend/home/post-item')
            @endforeach
        </div>
    </section>

    <section class="contentOuter post-home list-posts col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="hp-post review">
                    <a href="/tin-tuc/2-review.html" title="Đánh giá">Đánh giá</a>
                </h3>
            </div>
        </div>
        <div class="row">
            @foreach($reviewPosts as $p)
                @include('frontend/home/post-item')
            @endforeach
        </div>
    </section>
</div>