@extends('frontend/layout/default')

@section('styles')
    <style>
        .timerepeat {
            display: none;
        }
        .wrap_relate {
            display: none;
        }
        .contrelate.d1 {
            display: none;
        }
        .contrelate.d2 {
            display: none;
        }
        .list_gameapp {
            display: none;
        }
    </style>

    <link rel="canonical" href="{{ $classifield->getUrl() }}" />

@stop

@section('content')
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage":{
    "@type":"WebPage",
    "@id":"https://google.com/article"
  },
  "headline": "{{ $classifield->getTitle() }}",

  "datePublished": "{{ $classifield->presenter()->getDateTimeIso8601() }}",
  "dateModified": "{{ $classifield->presenter()->getDateTimeIso8601() }}",
  "author": {
    "@type": "Organization",
    "name": "Giaca.org"
  },
   "publisher": {
    "@type": "Organization",
    "name": "Giaca.org",
    "logo": {
      "@type": "ImageObject",
      "url": "http://{{ getServerName() }}/img/logo.png",
      "width": 197,
      "height": 42
    }
  },
  "description": "{{ $classifield->getTeaser() }}"
}
</script>

<div id="raovat-detail-page">

    <div id="breadcrumb">
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
            {!! getBreadcrumbItem('Trang chủ', '/') !!}
            {!! getBreadcrumbItem('Rao vặt', '') !!}
            {!! getBreadcrumbItem($classifield->getTitle(), '', true) !!}
        </ol>
    </div>

    <div class="row">
        <div class="col-sm-8">

            <div class="page-head mg-bt-10">
                <h1 class="page-head-block">{{ $classifield->getTitle() }}</h1>
            </div>

            <div class="post-datetime mg-bt-15">
                <small class="text-default"><i class="fa fa-calendar"></i> Cập nhật lúc: {{ $classifield->presenter()->getUpdatedAt() }}</small>
            </div>

            <div class="classifield-info">
                <div class="row">
                    <div class="col-sm-4">
                        <img class="img-thumbnail" src="{{ $classifield->getImage() }}" alt="{{ $classifield->getTitle() }}">
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_native_toolbox mg-t-20"></div>
                    </div>
                    <div class="col-sm-8">
                        {!! $classifield->getInfo() !!}
                        @if($classifield->getPhone())
                            <span>Liên hệ:</span> {!! $classifield->presenter()->getPhone() !!}
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div id="post-content" class="post-content">{!! Xss::clean($classifield->getContent()) !!}</div>

            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_native_toolbox mg-t-20"></div>

            <div class="post-source">
                <div class="text-right"><small>Nguồn: {{ $classifield->getSource() }}</small></div>
            </div>
        </div>

        <div class="ralated-classifields">
            <div class="col-sm-4">
                <div class="list-group">
                    <div class="page-head">
                        <div class="page-head-block">Tin liên quan</div>
                    </div>
                    @foreach($ralatedClassifieds as $ci)
                        <h2 class="heading-item list-group-item"><a href="{{ $ci->getUrl() }}" title="{{ $ci->getTitle() }}">{{ $ci->getTitle() }}</a></h2>
                    @endforeach
                </div>

                @if($product)
                <div class="ralated-classifields classifield-product-related">
                    <div class="list-group">
                        <div class="page-head">
                            <div class="page-head-block">Sản phẩm liên quan</div>
                        </div>
                        <div class="heading-item list-group-item">
                            <a href="{{ $product->getUrl() }}" title="{{ $product->getName() }}">
                                <img src="{{ $product->getImage('thumbs/small') }}" height="50" alt="{{ $product->getName() }}">
                                <h2 class="product-name">{{ $product->getName() }}</h2>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5674cf635e4c5b26" async="async"></script>
@stop


