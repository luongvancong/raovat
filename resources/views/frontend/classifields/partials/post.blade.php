<li class="post-item">
    <a class="link" href="{{ $p->getUrl() }}" title="{{ $p->getTitle() }}">
        <img class="image img-responsive img-thumbnail" src="{{ $p->getImage('thumbs/small') }}" alt="{{ $p->getTitle() }}">
        <div class="info">
            <h5 class="title">{{ $p->getTitle() }}</h5>
            <h6 class="sapo">{{ $p->getTeaser() }}</h6>
        </div>
    </a>
</li>