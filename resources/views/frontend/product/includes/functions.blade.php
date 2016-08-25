{{-- <div id="functions" class="nav">
    <div class="main-item action">
        <i class="fa fa-star"></i>
        <span>Xem thêm</span>
    </div>

    <a class="item" data-scroll href="#infomations-main">
        <i class="fa fa-info-circle"></i>
        <span>Thông tin sản phẩm</span>
    </a>

    <a class="item" data-scroll href="#prices">
        <i class="fa fa-money"></i>
        <span>So sánh</span>
    </a>

    @if($picture->count() >= 4)
    <a class="item" data-scroll href="#images-user">
        <i class="fa fa-file-image-o"></i>
        <span>Ảnh</span>
    </a>
    @endif

    @if($videos->count() > 0)
    <a class="item" data-scroll href="#video">
        <i class="fa fa-youtube"></i>
        <span>Video</span>
    </a>
    @endif

    @if($posts->total() > 0)
    <a class="item" data-scroll href="#news">
        <i class="fa fa-newspaper-o"></i>
        <span>Tin tức</span>
    </a>
    @endif

    @if($reviewPosts->total() > 0)
    <div class="item" data-scroll href="#review">
        <i class="fa fa-star-o"></i>
        <span>Đánh giá</span>
    </div>
    @endif

    @if($opponents->count() > 0)
    <a class="item" data-scroll href="#opponents">
        <i class="fa fa-user"></i>
        <span>Đối thủ</span>
    </a>
    @endif

    <a class="item" data-scroll href="#product-spec">
        <i class="fa fa-file-text-o"></i>
        <span>Thông số</span>
    </a>

    <a class="item" data-scroll href="#box-comments">
        <i class="fa fa-comments-o"></i>
        <span>Bình luận</span>
    </a>

    <a class="item" data-scroll href="#answer-question">
        <i class="fa fa-question-circle"></i>
        <span>Hỏi đáp</span>
    </a>

    @if($classifields->total())
    <a class="item" data-scroll href="#raovat">
        <i class="fa fa-smile-o"></i>
        <span>Rao vặt</span>
    </a>
    @endif

    <a class="item" data-scroll href="#lt-products">
        <i class="fa fa-th-large"></i>
        <span>Sản phẩm liên quan</span>
    </a>
</div> --}}

<div id="functions">
    <ul class="nav navbar-nav">
        <!-- <li>
            <a class="main-item action">
                <i class="fa fa-star"></i>
                <span>Xem thêm</span>
            </a>
        </li> -->

        <li>
            <a class="item" data-id="#infomations-main" href="#infomations-main" >
                <i class="fa fa-info-circle"></i>
                <span>Thông tin sản phẩm</span>
            </a>
        </li>

        <li>
            <a class="item" data-id="#prices" href="#prices">
                <i class="fa fa-money"></i>
                <span>So sánh</span>
            </a>
        </li>

        @if($picture->count() >= 4)
        <li>
            <a class="item" data-id="#images-user" href="#images-user">
                <i class="fa fa-file-image-o"></i>
                <span>Ảnh</span>
            </a>
        </li>
        @endif

        @if($videos->count() > 0)
        <li>
            <a class="item" data-id="#video" href="#video">
                <i class="fa fa-youtube"></i>
                <span>Video</span>
            </a>
        </li>
        @endif

        @if($posts->total() > 0)
        <li>
            <a class="item" data-id="#news" href="#news">
                <i class="fa fa-newspaper-o"></i>
                <span>Tin tức</span>
            </a>
        </li>
        @endif

        @if($reviewPosts->total() > 0)
        <li>
            <div class="item" data-id="#review" href="#review">
                <i class="fa fa-star-o"></i>
                <span>Đánh giá</span>
            </div>
        </li>
        @endif

        @if($opponents->count() > 0)
        <li>
            <a class="item" data-id="#opponents" href="#opponents">
                <i class="fa fa-user"></i>
                <span>Đối thủ</span>
            </a>
        </li>
        @endif

        <li>
            <a class="item" data-id="#product-spec" href="#product-spec">
                <i class="fa fa-file-text-o"></i>
                <span>Thông số</span>
            </a>
        </li>

        <li>
            <a class="item" data-id="#box-comments" href="#box-comments">
                <i class="fa fa-comments-o"></i>
                <span>Bình luận</span>
            </a>
        </li>

        @if($questions->total())
        <li>
            <a class="item" data-id="#answer-question" href="#answer-question">
                <i class="fa fa-question-circle"></i>
                <span>Hỏi đáp</span>
            </a>
        </li>
        @endif

        @if($classifields->total())
        <li>
            <a class="item" data-id="#raovat" href="#raovat">
                <i class="fa fa-smile-o"></i>
                <span>Rao vặt</span>
            </a>
        </li>
        @endif

        <li>
            <a class="item" data-id="#lt-products" href="#lt-products">
                <i class="fa fa-th-large"></i>
                <span>Sản phẩm liên quan</span>
            </a>
        </li>
    </ul>
</div>
