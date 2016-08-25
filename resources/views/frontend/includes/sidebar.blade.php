<div class="col-sm-3">
	<div class="sidebar">
		<div class="box-site box-white box-sidebar">
			<h3 class="box-heading bg-color text-color-white title-heading-global">
				<i class="fa fa-list"></i>
				Danh Mục
			</h3>
			<ul class="list-unstyled">
				<li>
					<h4><a href="{{ route('product.newest') }}">Sản phẩm <i class="fa fa-angle-right pull-right"></i></a></h4>
				</li>
				<li>
					<h4><a href="{{ route('post.index') }}">Tin tức <i class="fa fa-angle-right pull-right"></i></a></h4>
				</li>
				<li>
					<h4><a href="{{ route('compare') }}">So sánh <i class="fa fa-angle-right pull-right"></i></a></h4>
				</li>
				<li>
					<h4><a href="{{ route('video.index') }}">Video review <i class="fa fa-angle-right pull-right"></i></a></h4>
				</li>
			</ul>
		</div>

		<div class="box-site box-white box-sidebar">
			<h3 class="box-heading bg-color text-color-white title-heading-global">
				<i class="fa fa-delicious"></i>
				Hãng sản xuất
			</h3>
			<ul class="list-unstyled">
				@foreach($GLB_Brands as $brand)
				@if($brand->getTotalProducts())
					<li class="{{ isset($brandName) && $brandName == strtolower($brand->getName()) ? 'active' : '' }}">
						<h5><a href="{{ route('product.brand', strtolower($brand->getName())) }}">{{ $brand->getName() }} ({{ $brand->total_products }}) <i class="fa fa-angle-right pull-right"></i></a></h5>
					</li>
				@endif
				@endforeach
			</ul>
		</div>
	</div>
</div>