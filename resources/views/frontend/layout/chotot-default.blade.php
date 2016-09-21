<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>@yield('title')</title>
        <!-- Bootstrap -->
        <link rel="shortcut icon" type="image/png" href="/images/icon/favicon_vn.png"/>
        <link rel="shortcut icon" href="/images/icon/favicon_vn.png" type="image/x-icon"/>
        <link href="/css-chotot/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css-chotot/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css-chotot/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="/css-chotot/mystyle.css">
        <link rel="stylesheet" type="text/css" href="/css-chotot/responsive.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

        <!-- header -->
        <header>
            <!-- menu-top -->
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{!! url('/') !!}">
                        <img src="{!! asset('img/logo-chotot.png') !!}">
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{!! url('/') !!}" class="padding-top">
                                <span><img src="{!! asset('images/icon/search.png') !!}"></span>
                                <span>Tìm rao vặt</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="padding-top">
                                <span><img src="{!! asset('images/icon/chat.png') !!}"></span>
                                <span>Chat</span>
                                </a>
                            </li>
                            @if(!empty(Auth::user()))
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <img src="{!! asset('uploads/users/'.Auth::user()->avatar) !!}" width="28" height="28">
                                        {!! Auth::user()->name !!}
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="{{ route('danhsachtindang') }}"><i class="fa fa-file-text-o" aria-hidden="true"></i> Các tin đã đăng
                                        </a>
                                        </li>
                                        <li><a href="{!! route('profile.chinhsua') !!}"><i class="fa fa-user-secret" aria-hidden="true"></i> Thông tin cá nhân
                                        </a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-history" aria-hidden="true"></i> Lịch sử giao dịch</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="{!! route('get.logout') !!}"><i class="fa fa-sign-out fa-fw"></i>Thoát</a>
                                        </li>
                                    </ul>
                                    <!-- /.dropdown-user -->
                                </li>
                            @else
                                <li>
                                    <a href="{!! route('dangnhap') !!}" class="padding-top">
                                    <span><img src="{!! asset('images/icon/log.png') !!}"></span>
                                    <span>Đăng nhập/Đăng ký</span>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{!! route('get.dangtin') !!}">
                                <span class="btn dang-tin">Đăng tin</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
            <!-- end menu top -->
        </header>
        <!-- end header -->
        @include('notifications')
        @yield('content')
        <!-- footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <h4>Liên kết</h4>
                        <a href=""><span><img src="{!! asset('images/icon/facebook.png') !!}"></span> Facebook</a>
                        <a href=""><span><img src="{!! asset('images/icon/gplus.png') !!}"></span> Google+</a>
                        <a href=""><span><img src="{!! asset('images/icon/youtube.png') !!}"></span> Youtube</a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <h4>Hỗ trợ khách hàng</h4>
                        <a href="">Trung tâm trợ giúp</a>
                        <a href="">An toàn mua bán</a>
                        <a href="">Quy định cần biết</a>
                        <a href="">Liên hệ hỗ trợ</a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <h4>Về Chottot.com</h4>
                        <a href="">Giới thiệu</a>
                        <a href="">Tuyển dụng</a>
                        <a href="">Truyền thông</a>
                        <a href="">Blog</a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <h4>Chứng nhận</h4>
                        <img src="{!! asset('images/icon/bocongthuong.png') !!}">
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script src="{!! asset('js-chotot/bootstrap.min.js') !!}"></script>
        <script src="{!! asset('js-chotot/owl.carousel.min.js') !!}"></script>
        <script src="{!! asset('js-chotot/myscript.js') !!}"></script>
    </body>
</html>