@extends('frontend/layout/chotot-default')
@section('title','Mua bán')
@section('content')
    <!-- main -->
    <div class="main">
        <div class="container">
            <div class="row">

                <!-- menu trái -->
                @include('frontend.includes.chotot-menutrai')
                <!-- end menu trái -->

                <div class="col-md-9">
                    <div class="mua-ban">
                        <div class="mua-ban-right">
                            <a href="{!! route('home-page') !!}" title="chottot.com">chottot.com <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                            <a href="{!! url('danh-sach-tin/'.$city->getId()) !!}" class="in-dam" title="{!! $city->getName() !!}"> {!! $city->getName() !!} <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                            <a href="" class="in-dam">@if(isset($category_item)){!! $category_item->getName() !!}@endif</a>

                            <!-- search -->
                            @include('frontend.includes.chotot-search')
                            <!-- end search -->

                            <div class="col-md-12">
                                <div class="row">
                                    <h3>Rao vặt @if(isset($category_item)){!! $category_item->getName() !!}@endif tại {!! $city->getName() !!}</h3>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#tatca" aria-controls="tatca" role="tab" data-toggle="tab"><b>Tất cả</b> 1 - {!! $data_posts->perPage() !!} trong {!! $data_posts->total() !!}</a></li>
                                            <!-- <li role="presentation"><a href="#canhan" aria-controls="canhan" role="tab" data-toggle="tab">Cá nhân 1-20 trong 106996</a></li>
                                            <li role="presentation"><a href="#congty" aria-controls="congty" role="tab" data-toggle="tab">Cá nhân 1-20 trong 83061</a></li> -->
                                            <li>
                                                <div class="btn-group" role="group" aria-label="...">
                                                    <ul class="nav nav-pills">
                                                        <li class="active"><a href="#" title="Tin mới trước" data-toggle="tab" class="btn btn-default"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
                                                        </li>
                                                        <li><a href="#" title="Giá rẻ trước" data-toggle="tab" class="btn btn-default">VND <i class="fa fa-long-arrow-down" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="btn-group" role="group" aria-label="...">
                                                    <ul class="nav nav-pills">
                                                        <li class="active"><a href="#" title="Xem hình thu nhỏ" data-toggle="tab" class="btn btn-default xem-hinh-nho"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                                                        </li>
                                                        <li> <a href="#" title="Ẩn hình thu nhỏ" data-toggle="tab" class="btn btn-default an-hinh-nho"><i class="fa fa-align-justify" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="tatca">
                                                @foreach($data_posts as $key => $item)
                                                <!-- item post -->
                                                @include('frontend.includes.chotot-item-post')
                                                <!-- end item post -->
                                                @endforeach
                                                <!-- phân trang -->
                                                <nav>
                                                    <div class="pagination">
                                                        {!! pagination($data_posts, $data_posts->total(), $data_posts->perPage())  !!}
                                                    </div>
                                                </nav>
                                            </div>
                                            <!-- tất cả tin -->
                                            <!-- <div role="tabpanel" class="tab-pane" id="canhan">...</div>
                                            <div role="tabpanel" class="tab-pane" id="congty">...</div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end nội dung -->

                            <!-- category bottom -->
                            @include('frontend.includes.category-bottom')
                            <!-- end category bottom -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main -->
@endsection