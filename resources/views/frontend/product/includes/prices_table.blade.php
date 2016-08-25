@if(isset($dbProductPrices))
	@foreach($dbProductPrices as $priceItem)
	<div class="price-items-table">
		<div id="shop-{{ $priceItem->shop_id }}" class="row">
			<div class="col-sm-3 hidden-xs">
				<a class="shop-link-img" href="javascript:;" title="{{ $priceItem->shop_name }}">
					<img src="{{ $priceItem->shop_logo }}" onerror="fillNoLogo(this)" alt="{{ $priceItem->shop_name }}" class="img-responsive">
				</a>
                <?php
                    $countRate       = $priceItem->rating_count;
                    $countView       = $priceItem->view_count;
                    $countWrongInfo  = $priceItem->wrong_info_count;
                    $countWrongPrice = $priceItem->wrong_price_count;
                    $avgRate         = $priceItem->avg_rating;
                ?>
                <div class="rate-star pd-t-5">
                    @for($i = 0; $i < $avgRate; $i ++)
                    <i class="fa fa-star icon"></i>
                    @endfor
                </div>
                <div class="info-number">
                    @if($priceItem->rating_count)
                        <span class="inline-block text-bester-rating-value">{{ formatCurrency(($priceItem->rating_5_count/$priceItem->rating_count)*100) }}% đánh giá tốt (trong tổng số {{ $countRate }} đánh giá)</span>
                    @endif
                    <span class="inline-block hidden-{{ $countRate }}">Đánh giá ({{ $countRate }}) </span>
                    <span class="inline-block hidden-{{ $countWrongInfo }}">Sai thông tin ({{ $countWrongInfo }}) </span>
                    <span class="inline-block hidden-{{ $countWrongPrice }}">Sai giá ({{ $countWrongPrice }}) </span>
                    <span class="inline-block hidden-{{ $countView }}">Xem ({{ $countView }})</span>
                </div>
			</div>
			<div class="col-sm-9">

				<div class="item-infomation first">
					<div class="row">
						<div class="col-sm-6">
							<div>
								<h3 class="item-name">
									<a data-id="{{ $product->getId() }}" data-priceId="{{ $priceItem->getId() }}" data-shop="{{ $priceItem->getSource() }}" href="{{ route('redirect', [$product->getId(), $priceItem->getId()]) }}">{{ $priceItem->getProductName() }}</a>
								</h3>
								<span class="item-link">{{ $priceItem->getOriginLink() }}</span>
								<div class="item-time">Cập nhật lúc: {{ $priceItem->getCrawledTimeStr() }}</div>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="item-price">{{ $priceItem->presenter()->getMinPrice() }}</div>
						</div>
						<div class="col-sm-2">
							@if( $priceItem->count_items > 1 )
								<div data-shop="{{ $priceItem->shop_id }}" data-price_id="{{ $priceItem->id }}" data-productId="{{ $product->getId() }}" data-source="{{ $priceItem->shop_name }}" data-sourceid="{{ $priceItem->shop_id }}" data-total_product_viewmore="{{ $priceItem->count_items - 1 }}" class="item-viewmore text-center">
									<span class="viewmore-text btn btn-default" data-text-old="{{ $priceItem->count_items - 1 }} sản phẩm" >{{ $priceItem->count_items - 1 }} sản phẩm <i class="fa fa-angle-down"></i></span>
								</div>
							@endif
						</div>

						<div class="col-sm-2">
							<a class="block btn btn-sm btn-store goto-shop-link" data-id="{{ $product->getId() }}" data-priceId="{{ $priceItem->getId() }}" data-shop="{{ $priceItem->getSource() }}" href="{{ route('redirect', [$product->getId(), $priceItem->getId()]) }}" target="_blank">Đến nơi bán</a>
                            <div class="actions-user">
                                <span class="action btn-action-user-rating-merchant" data-product="{{ $product->getId() }}" data-merchant="{{ $priceItem->shop_id }}" data-merchant_name="{{ $priceItem->shop_name }}">Đánh giá</span>
                                <span class="action btn-action-wrong-price block btn-wrong-price" data-pricename="{{ $priceItem->getProductName() }}" data-price="{{ $priceItem->getPriceStr() }}" data-priceId="{{ $priceItem->getId() }}" data-merchant="{{ $priceItem->shop_id }}">Báo lỗi</span>
                            </div>
                        </div>

						{{-- <div class="col-sm-1">
							<a href="javascript:;" data-priceName="{{ $priceItem->getProductName() }}" data-price="{{ $priceItem->getPriceStr() }}" data-priceId="{{ $priceItem->getId() }}" class="btn-action-wrong-price block btn-wrong-price"><i class="fa fa-bell-o"></i> Báo lỗi</a>
						</div> --}}
					</div>
				</div>

				<div id="viewmore-placement-{{ $priceItem->shop_id }}" class="hide"></div>
			</div>
		</div>
	</div>
	@endforeach

@endif

<script>
	function noImage(obj) {
		obj.src = '/images/grey.gif';
	}

	// $(function() {
	// 	var currentPage = null;

	// 	@if(round($dbProductPrices->total() / $dbProductPrices->perPage()) > 1)
	// 		// init bootpag
 //        	$('#table-prices-pagination').bootpag({
 //            	total: {{ ceil($dbProductPrices->total() / $dbProductPrices->perPage()) }},
 //            	page: {{ Request::get('page', 1) }}
 //        	}).on("page", function(event, /* page number here */ page) {
 //        		// var href = window.location.href;
 //        		// window.location.href = urlAddParams('page', num + '#prices');
 //        		currentPage = page;

 //                // $('html,body').animate({
 //                //     scrollTop: $('#prices').offset().top - 150
 //                // }, 700);

 //        		$.ajax({
 //        			url : '/ajax/getPricesTable',
 //        			type : 'GET',
 //        			data : {
 //        				product_id : {{ $product->getId() }},
 //        				page : page,
 //        				take : {{ $dbProductPrices->perPage() }},
 //        				sort : $('.btn-action-sort').val()
 //        			},
 //        			beforeSend : function() {
 //        				$('#info-prices-table').html('Đang tải <i class="fa fa-spin fa-spinner"></i>');
 //        			},
 //        			success : function(response) {

 //        			}
 //        		}).done(function(response) {
 //                    $('#info-prices-table').append(response);
 //                });

 //            // $("#content").html("Insert content"); // some ajax content loading...
 //        	});
 //    	@endif
	// });
</script>

