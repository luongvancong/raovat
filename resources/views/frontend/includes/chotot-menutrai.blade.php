<div class="col-md-3">
    <div class="mua-ban">
        <div class="mua-ban-left">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#mua" aria-controls="mua" role="tab" data-toggle="tab">Mua</a></li>
                <li role="presentation"><a href="#ban" aria-controls="ban" role="tab" data-toggle="tab">Bán</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="mua">
                    <ul>
                        @foreach($categories as $key => $category)
                        <li>
                            <i class="fa fa-caret-right ctrl-cate" aria-hidden="true" onclick=""></i>
                            <a href="{!! route('getDanhsachcategory', [$city->getId(), $category->getID()]) !!}" title="{!! $category->getName() !!}"> {!! $category->getName() !!}</a>
                            <ul class="cate-con">
                                @foreach($category->getChild as $key => $category_con)
                                <li><a href="{!! route('getDanhsachcategorychild', [$city->getId(), $category_con->getID()]) !!}" title="{!! $category_con->getName() !!}">{!! $category_con->getName() !!}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane" id="ban">...</div>
            </div>
        </div>
    </div>
</div>