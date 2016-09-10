<div class="col-md-12 rao-vat-cung-loai">
    <div class="row">
        <h3>Tìm thêm các rao vặt khác tại Hà Nội</h3>
        <div class="col-md-12">
            <div class="row">
                @foreach($categories as $key => $item)
                <div class="col-md-6">
                    <div class="row">
                        <div class="item-rao-vat-cung-loai">
                            <p>{!! $item->name !!}</p>
                            @foreach($item->getChild as $item_cate)
                            <a href="{!! route('getDanhsachcategorychild', [$city->getId(), $item_cate->getID()]) !!}">{!! $item_cate->getName() !!}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>