@extends('admin/layouts/master')

@section('main-content')
	<section class="panel">
		<header class="panel-heading">
			<h4>
				Thống kê chi tiết event - {{ $key }}
			</h4>
		</header>
		<div class="panel-body">
			<div class="adv-table">
				<div class="dataTables_wrapper">
					<table class="display table table-bordered table-striped">
						<thead>
							<tr>
								<th>Mô tả</th>
								<th>Thống kê</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($events as $key => $event)
								<tr>
									<td>
										<?php
											$productRepository = App::make('Nht\Hocs\Products\ProductRepository');
											if($event->getKey() == 'click_to_shop_link') {
												$product = $productRepository->getById($event->getValue());
												echo 'Phát hiện ở sản phẩm: <a target="_blank" href="'. $product->getUrl() .'"><b>'. $product->getName() .'</b></a>';
											}
										?>
									</td>
									<td>
										<?php
											// Tổng cửa hàng được click khi khách xem sp này
											$shopClick = DB::table('events')
															->selectRaw("COUNT(shop_name) as total_click_shop")
															->where('value', $event->getValue())
															->groupBy('value')
															->first();

											// Danh sách cửa hàng và số lượng click vào cửa hàng
											$shops = DB::table('events')
															->selectRaw("COUNT(*) as total_click, created_at, shop_name, created_at")
															->where('value', $event->getValue())
															->groupBy('shop_name')
															->get();
										?>
										<table class="table">
											<tr>
												<td>Click</td>
												<td><b>{{ $event->count }}</b></td>
											</tr>
											<tr>
												<td>Cửa hàng được click</td>
												<td><b>{{ $shopClick->total_click_shop }}</b></td>
											</tr>

												<tr>
													<td>
														<table class="table">
															<thead>
																<th>Cửa hàng</th>
																<th>Click</th>
																<th>Thời gian</th>
															</thead>
															<tbody>
																@foreach($shops as $shop)
																<tr>
																	<td><a target="_blank" href="http://{{ $shop->shop_name }}">{{ $shop->shop_name }}</a></td>
																	<td><a target="_blank" href="http://{{ $shop->shop_name }}">{{ $shop->total_click }}</a></td>
																	<td>{{ $shop->created_at }}</td>
																</tr>
																@endforeach															</tbody>
														</table>
													</td>
												</tr>
										</table>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@include('admin/partials/paginate', ['data' => $events, 'appended' => $_GET])
				</div>
			</div>
		</div>
	</section>
@stop