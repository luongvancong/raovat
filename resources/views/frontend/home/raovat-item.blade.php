<div class="col-xs-12 col-sm-12">
    <div class="post-item">
        <div class="row">
            <div class="col-sm-3 col-xs-3">
                <a target="_blank" class="post-image" href="{{ $cf->getUrl() }}" title="{{ $cf->getTitle() }}">
                    <img class="lazy" data-type="post" data-id="{{ $cf->getId() }}" data-src="{{ $cf->getImage('thumbs/big') }}" alt="{{ $cf->getTitle() }}">
                </a>
            </div>
            <div class="col-sm-9 col-xs-9">
                @if($cf->getPrice())
                <div class="price mg-bt-5">
                    <span class="label label-danger">{{ $cf->presenter()->getPrice() }}</span>
                </div>
                @endif
                <a target="_blank" class="post-title" href="{{ $cf->getUrl() }}" title="{{ $cf->getTitle() }}">
                    <h3>{{ $cf->getTitle() }}</h3>
                </a>
                <h6 class="post-teaser"><i>{{ trim($cf->getTeaser()) }}</i></h6>
            </div>
        </div>
    </div>
</div>