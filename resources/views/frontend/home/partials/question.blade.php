<section class="contentOuter post-home list-posts col-sm-6">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="hp-post review">
                <a href="{{ route('hoidap.index') }}" title="Hỏi đáp">Hỏi đáp</a>
            </h3>
        </div>
    </div>
    <div class="row">
        @foreach($questions as $qt)
            @if($qt->answer->count() > 0)
                @include('frontend/home/question-item')
            @endif
        @endforeach
    </div>
</section>