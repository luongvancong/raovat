<div class="col-sm-12">
    <div class="classifield-item pd-bt-20">
        <div class="bound row">
            <div class="image pd-bt-10 col-sm-3">
                <div class="crop">
                    <a href="{{ $cf->getUrl() }}" title="{{ $cf->getTitle() }}">
                        <img class="img-responsive img-thumbnail" onerror="this.src='/images/grey.gif'" src="{{ $cf->getImage() }}" alt="{{ $cf->getTitle() }}" title="{{ $cf->getTitle() }}">
                    </a>
                </div>
            </div>
            <div class="infomation col-sm-9">

                <h3 class="title pd-bt-5 pd-t-5">
                    <a href="{{ $cf->getUrl() }}" title="{{ $cf->getTitle() }}">{{ $cf->getTitle() }}</a>
                </h3>
                <div class="mg-bt-5">
                @if($cf->presenter()->getPrice())
                    <p class="price">{{ $cf->presenter()->getPrice() }}đ</p>
                @endif
                </div>
                <h4 class="teaser">{{ $cf->getTeaser() }}</h4>
            </div>
        </div>
    </div>
</div>