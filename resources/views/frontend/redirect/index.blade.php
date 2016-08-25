<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ $product->getName() }}</title>
	<link rel="stylesheet" href="/bs3/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/common.css">
	<script src="/js/jquery.js"></script>
	<style>
		.logo {
			display: block;
			background: #F5F5F5;
			text-align: center;
			padding: 10px;
		}

		.content {
		   padding: 10px;
		}

		.box-container {
			border: 1px solid #ccc;
			margin: 30px auto;
			text-align: center;
		}

		.product-name {
		   color: #17AA9D;
		}
		.btn-redirect {
			background: #17aa9d;
			display: inline-block;
			padding: 5px 20px;
			text-decoration: none;
			color: #fff;
		}
		.btn-redirect:hover, .btn-redirect:focus, .btn-redirect.active {
			text-decoration: none;
			color: #fff;
    		background: #0FB7A8;
		}
	</style>
</head>
<body>

	<div class="container">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<div class="box-container">
				<a class="logo" href="/">
					<img src="/img/logo.png">
				</a>
				<div class="content">
					<p><b>Cảm ơn bạn đã sử dụng {{ Request::server('SERVER_NAME') }}, bây giờ bạn sẽ tới nơi bán sản phẩm</b></p>
					<p><span class="product-name">{{ $product->getName() }}</span> để xem chi tiết sản phẩm</p>
					<p><b>Sẽ chuyển hướng tới trang trong <span data-url="{{ $targetUrl }}" id="second-counter">3</span> giây!</b></p>
					<a href="{{ $targetUrl }}" class="btn-redirect btn-flat">Chuyển trang</a>
				</div>
			</div>
		</div>
		<div class="col-sm-4"></div>
	</div>

	<script>
		$(function() {
			var second = 3;
			var timer = setInterval(function() {
				second --;
				$('#second-counter').text(second);

				if(second == 0) {
					clearInterval(timer);
					window.location.href = $('#second-counter').data('url');
				}

			}, 1000);
		});
	</script>

</body>
</html>