<li class="product-item">
    <a class="link-wrapper" href="{{ $p->getUrl() }}" title="{{ $p->getName() }}">
        <img class="img img-responsive img-thumbnail" src="{{ $p->getImage('thumbs/small') }}" alt="{{ $p->getName() }}">
        <div class="info">
            <h4 class="name">{{ $p->getName() }}</h4>
            <div class="price">
                <span class="">{{ $p->presenter()->getPrice() }}</span>
            </div>
            <div class="info-something">
                <div class="inline-block hidden-{{ $p->getTotalShop() }}"><span>{{ $p->getTotalShop() }}</span> Cửa hàng bán</div>
                <div class="inline-block hidden-{{ $p->getPostCount() }}"><span>{{ $p->getPostCount() }}</span> Tin tức</div>
                <div class="inline-block hidden-{{ $p->getRatingCount() }}"><span>{{ $p->getRatingCount() }}</span> Đánh giá</div>
                <div class="inline-block hidden-{{ $p->getVideoCount() }}"><span>{{ $p->getVideoCount() }}</span> Video</div>
                <div class="inline-block hidden-{{ $p->getQuestionCount() }}"><span>{{ $p->getQuestionCount() }}</span> Hỏi đáp</div>
                <div class="inline-block hidden-{{ $p->getRaovatCount() }}"><span>{{ $p->getRaovatCount() }}</span> Rao vặt</div>
            </div>
        </div>
    </a>
</li>