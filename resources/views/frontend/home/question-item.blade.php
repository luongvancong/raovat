<div class="col-xs-12 col-sm-12">
    <div class="post-item">
        <div class="row">
            <div class="col-sm-12 col-xs-9">
                <a target="_blank" class="post-title" href="{{ $qt->getUrl() }}" title="{{ $qt->getQuestion() }}">
                    <h3>{{ $qt->getQuestion() }}</h3>
                </a>
                <h6 class="post-teaser"><i>{{ trim($qt->answer->count()) }} trả lời</i></h6>
            </div>
        </div>
    </div>
</div>