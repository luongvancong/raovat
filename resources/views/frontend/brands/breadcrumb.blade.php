{{-- BREADCRUMB --}}
@section('breadcrumb')
    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
        {!! getBreadcrumbItem('Trang chủ', '/') !!}
        {!! getBreadcrumbItem('Sản phẩm', route('product.newest')) !!}
        {!! getBreadcrumbItem($thisBrand->getName(), '', true) !!}
    </ol>
@show
{{-- END BREADCRUMB --}}