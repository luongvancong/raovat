<li class="video-item">
    <a class="link" href="{{ $vid->getUrl() }}" title="{{ $vid->getTitle() }}">
        <img class="img" src="{{ $vid->getImage() }}" alt="{{ $vid->getTitle() }}">
        <i class="icon-play fa fa-play-circle"></i>
        <h6 class="caption flex-caption">{{ $vid->getTitle() }}</h6>
    </a>
</li>