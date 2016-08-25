<div class="col-xs-12 col-sm-12">
    <div class="post-item">
        <div class="row">
            <div class="col-sm-3 col-xs-3">
                <a target="_blank" class="post-image" href="{{ $p->getUrl() }}" title="{{ $p->getTitle() }}">
                    <img class="lazy" data-type="post" data-id="{{ $p->getId() }}" data-src="{{ $p->getImage('thumbs/big') }}" alt="{{ $p->getTitle() }}">
                </a>
            </div>
            <div class="col-sm-9 col-xs-9">
                <a target="_blank" class="post-title" href="{{ $p->getUrl() }}" title="{{ $p->getTitle() }}">
                    <h3>{{ $p->getTitle() }}</h3>
                </a>
                <h6 class="post-teaser"><i>{{ trim($p->getTeaser()) }}</i></h6>
            </div>
        </div>
    </div>
</div>