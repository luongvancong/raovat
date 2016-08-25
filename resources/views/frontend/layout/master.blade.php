<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ $setting->getTitle() }}</title>
	<link rel="stylesheet" href="/bs3/css/bootstrap.min.css">
	<link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="/owl-carousel/owl.carousel.css">
   <link rel="stylesheet" href="/owl-carousel/owl.theme.css">
	<link rel="stylesheet" href="/css/product.css">
	<style>
		body {
			padding-top: 70px;
		}
	</style>
	@yield('styles')
</head>
<body>

   <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">SearchOn</a>
         </div>
         <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
               <li class="active"><a href="/">Trang chủ</a></li>
               <li><a href="#product">Sản phẩm</a></li>
               <li><a href="#news">Tin tức</a></li>
               <li><a href="#price-compare">So sánh giá</a></li>
               <li><a href="#video">Video review</a></li>
               <li class="dropdown hide">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                     <li class="active"><a href="/">Trang chủ</a></li>
                     <li><a href="#product">Sản phẩm</a></li>
                     <li><a href="#news">Tin tức</a></li>
                     <li><a href="#price-compare">So sánh giá</a></li>
                     <li><a href="#video">Video review</a></li>
                     <li role="separator" class="divider"></li>
                  </ul>
               </li>
            </ul>
            <form class="form-inline pull-right" id="searchon" action="{{ route('searchon') }}" method="get">
               <div class="form-group">
                  <input type="search" class="form-control input-sm" id="search" name="q" placeholder="Tìm kiếm...">
               </div>
            </form>
         </div>
         <!--/.nav-collapse -->
      </div>
   </nav>

	<div class="container">
		@yield('content')
	</div>

   <div id="footer">
      <div>
         <h3>Searchon</h3>
         <div>Trang tổng hợp thông tin sản phẩm và so sánh giá</div>
      </div>
      <p>Bản quyền thuộc về &copy; Searchon</p>
   </div>

	<script src="/js/jquery.js"></script>
	<script src="/bs3/js/bootstrap.min.js"></script>
   <script src="/owl-carousel/owl.carousel.js"></script>
	@yield('scripts')
</body>
</html>