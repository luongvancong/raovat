<div class="col-md-12">
    <div class="row mua-ban-item">
        <div class="col-md-2">
            <div class="row">
                <p class="item-hinh-an">{!! $item->getDoiTime() !!} phút trước <i class="fa fa-camera-retro" aria-hidden="true"></i></p>
                <a href="{!! route('getChitiettin', $item->getId()) !!}" class="item-hinh-hien" title="{!! $item->post_image->first()->image !!}">
                <img class="img-responsive thumbnail" src="{!! asset('uploads/posts/'.$item->post_image->first()->image) !!}" alt="{!! $item->getTitle() !!}">
                </a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="mua-ban-row">
                <a href="{!! route('getChitiettin', $item->getId()) !!}" title="{!! $item->getTitle() !!}">{!! $item->getTitle() !!}</a>
                <span class="nguoi-dang-tin"><sup><i class="fa fa-check" aria-hidden="true"></i></sup></span>
                <p class="item-tien-hien">{!! format_number($item->getPrice()) !!} đ</p>
                <p>{!! $item->getChildCategory->name !!} ở {!! $item->getChildDistrictCity->cit_name !!}
                </p>
            </div>
        </div>
        <div class="col-md-2">
            <div class="row">
                <p class="item-tien-an">{!! format_number($item->getPrice()) !!} đ</p>
                <p class="item-thoi-gian">{!! $item->getDoiTime() !!} phút trước</p>
            </div>
        </div>
    </div>
</div>