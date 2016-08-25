<div id="home-navtab" class="row">
    <div class="col-sm-12">

        <!-- Nav tabs -->
        <ul id="homepage-navtab-ul" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a data-type="hot" class="navtab-head hot" href="#product-hot" >
                    <h2>Hot nhất</h2>
                </a>
            </li>
            <li role="presentation">
                <a data-type="have-more-shop" class="navtab-head have-more-shop" href="#products-have-more-shop">
                    <h2>Nhiều người bán</h2>
                </a>
            </li>
            <li role="presentation">
                <a data-type="have-change-price" class="navtab-head have-change-price" href="#product-have-change-price">
                    <h2>Mới thay đổi giá</h2>
                </a>
            </li>
            <li role="presentation">
                <a data-type="newest" class="navtab-head newest" href="#product-newest">
                    <h2>Mới cập nhật</h2>
                </a>
            </li>
            <li role="presentation">
                <a data-type="care" class="navtab-head care" href="#product-care">
                    <h2>Quan tâm nhiều nhất</h2>
                </a>
            </li>

            <li class="hp-slider-controls">
                <a href="javascript:;" class="custom-control-slider-product hot prev pull-left btn-flat"><i class="fa fa-angle-left"></i></a>
                <a href="javascript:;" class="custom-control-slider-product hot next pull-left btn-flat"><i class="fa fa-angle-right"></i></a>
            </li>

            <li class="clearfix"></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content pd-t-40">
            <div role="tabpanel" class="tab-pane" id="products-have-more-shop">
                <div class="row">
                    <div class="have-more-shop product-tab-carousel">
                        @foreach($productsHaveMoreShop as $key => $p)
                            {!! $p->presenter()->getItem(['key' => ($key+1), 'page_is' => 'home']) !!}
                        @endforeach
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="product-have-change-price">
                <div class="row">
                    <div class="have-change-price product-tab-carousel">
                        @foreach($productsHaveChangePrice as $key => $p)
                            {!! $p->presenter()->getItem(['key' => ($key+1), 'page_is' => 'home']) !!}
                        @endforeach
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane active" id="product-hot">
                <div class="row">
                    <div class="hot product-tab-carousel">
                        @foreach($hot_products as $key => $product)
                            {!! $product->presenter()->getItem(['key' => ($key+1), 'page_is' => 'home']) !!}
                        @endforeach
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="product-newest">
                <div class="row">
                    <div class="newest product-tab-carousel">
                        @foreach($products as $key => $p)
                            {!! $p->presenter()->getItem(['key' => ($key+1), 'page_is' => 'home']) !!}
                        @endforeach
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="product-care">
                <div class="row">
                    <div class="care product-tab-carousel">
                        @foreach($productHaveMostQuestion as $key => $p)
                            {!! $p->presenter()->getItem(['key' => ($key+1), 'page_is' => 'home']) !!}
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>