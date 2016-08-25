<?php

namespace Nht\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Nht\Hocs\AuctionClicks\AuctionClickRepository;
use Nht\Hocs\AuctionProductIgnores\AuctionProductIgnoreRepository;
use Nht\Hocs\Auctions\AuctionRepository;
use Nht\Hocs\Brands\BrandRepository;
use Nht\Hocs\Classifields\ClassifieldRepository;
use Nht\Hocs\Elasticsearchs\Price as EsPrice;
use Nht\Hocs\MerchantReports\MerchantReport;
use Nht\Hocs\Pictures\PictureRepository;
use Nht\Hocs\Posts\DbPostRepository;
use Nht\Hocs\Posts\EsPostRepository;
use Nht\Hocs\ProductImages\ProductImage;
use Nht\Hocs\ProductLikes\ProductLikeRepository;
use Nht\Hocs\ProductPriceHistories\ProductPriceHistoryRepository;
use Nht\Hocs\ProductPrices\ProductPriceRepository;
use Nht\Hocs\ProductVideos\ProductVideoRepository;
use Nht\Hocs\ProductViews\ProductViewRepository;
use Nht\Hocs\Products\Product;
use Nht\Hocs\Products\ProductRepository;
use Nht\Hocs\Questions\QuestionRepository;
use Nht\Hocs\Rates\RateRepository;
use Nht\Hocs\Sites\SiteRepository;
use Nht\Hocs\Users\UserRepository;
use Nht\Http\Controllers\FrontendController;
use Nht\Http\Requests;
use OpenGraph;

class ProductController extends FrontendController
{

   public function __construct(DbPostRepository $post, ProductRepository $product,
                              ProductPriceRepository $price, ProductVideoRepository $video,
                              SiteRepository $site, ProductLikeRepository $like,
                              QuestionRepository $question, RateRepository $rate, ClassifieldRepository $cif,
                              BrandRepository $brand, PictureRepository $picture, ProductViewRepository $productView,
                              AuctionRepository $auction, UserRepository $user, AuctionClickRepository $auctionClick, EsPrice $esPrice, Request $request)
   {
        parent::__construct();
        $this->post     = $post;
        $this->product  = $product;
        $this->price    = $price;
        $this->esPrice  = $esPrice;
        $this->video    = $video;
        $this->site     = $site;
        $this->like     = $like;
        $this->question = $question;
        $this->rate     = $rate;
        $this->cif      = $cif;
        $this->brand    = $brand;
        $this->picture  = $picture;
        $this->productView = $productView;
        $this->auction = $auction;
        $this->user = $user;
        $this->auctionClick = $auctionClick;
        $this->request = $request;
   }

    public function getDetail($id, $slug, Request $request, AuctionProductIgnoreRepository $auctionProductIgnoreRepository) {
        $productDetail = $product = $this->product->getById($id);

        if($slug != $productDetail->getSlug()) {
            return redirect()->to(route('product.detail', [$id, $productDetail->getSlug()]), 301);
        }

        $brand = $productDetail->brand()->first();

        $posts   = $this->post->searchPostsRelateWithProduct($product, 4);
        // _debug($posts);die;
        $countPosts = $posts->total();

        $reviewPosts = $this->post->searchReviewPostsRelateWithProduct($product, 4);
        $countReviewPosts = $reviewPosts->total();

        // _debug($countReviewPosts);die;

        $relatedProducts = $this->product->getRelatedProducts($product, 12);

        // Giá lấy từ search engine
        // $dbProductPrices = $this->price->getPricesGroupByShopPaginated($product, 10, $this->getSortParams());
        // dd($dbProductPrices);

        // Video
        $videos      = $this->video->searchVideosByKeyword($product->getVideoKeyword(), 4);
        $countVideos = $this->video->countVideoByKeyword($product->getVideoKeyword());

        // Ảnh sản phẩm
        $productImagesFull  = $product->getImages('full');
        $productImagesSmall = $product->getImages('thumbs/small');

        // Like
        $likeNumber = $this->like->getLikeProduct($product);

        // Hỏi đáp
        $questions = $this->question->getQuestionProductPaginated($product, 10);

        // Opponents - Đối thủ
        $opponents = $this->product->getByIds($product->getArrayOpponents());

        // Ratings
        $countRating = $this->rate->countRateOfProduct($product, $product->fakeTotalRating());

        // Mặc định 4-5 sao
        $avgRatingValue = $this->rate->avgRateValueOfProduct($product, $product->fakeRatingValue());

        // Rao vặt
        $classifields = $this->cif->getRaovatOfProductPaginated($product);

        // Metadata
        $metaTitle = $product->getMetatitle() ? $product->getMetatitle() : $product->getName();
        $metaKeyword = $product->getMetaKeyword() ? $product->getMetaKeyword() : "Thông số kỹ thuật {$product->getName()}, so sánh {$product->getName()}, {$product->getName()} tốt nhất, mua {$product->getName()}, bán {$product->getName()}, giá {$product->getName()}";
        $metaDescription = $product->getMetaDescription() ? $product->getMetaDescription() : 'Đây là thông tin giới thiệu tổng quan của sản phẩm '. $product->getName() .'. Mỗi sản phẩm đều có những tính năng và đặc tính riêng, đảm bảo được tính cá nhân hóa của chủ nhân cao. Mọi thông tin chi tiết về sản phẩm này sẽ luôn được cập nhật tại website '. route('home-page') .'>'. firstLetterUpperCase($request->server('SERVER_NAME')) .'';

        $this->metadata->setTitle($metaTitle);
        $this->metadata->setMetaDescription(mb_substr($metaDescription, 0, 160));
        $this->metadata->setMetaKeyword($metaKeyword);

        // picture
        $picture = $this->picture->getByProductId($id);

        // Increment View
        $this->productView->addView($product, getRealIp());

        // Auto generate keyword
        $arrayPrependTags = $this->buildPrependTags($product);
        $arrayAppendTags  = $this->buildAppendTags($product);

        // Shop ads
        $auctions = $this->auction->getAvaiableAuctions();

        // _debug($auctions);die;
        $shopAds = new Collection();

        foreach($auctions as $auction) {
            // Nếu sản phẩm nằm trong danh sách bỏ qua của shop thì lượn
            if(!$auctionProductIgnoreRepository->isProductInIgnoreList($product->getId(), $auction->getId(), $auction->shop_id)) {
                foreach($dbProductPrices as $dp) {
                    if($dp->shop_id == $auction->shop_id) {
                        $dp->auction_id = $auction->getId();
                        $shopAds->push($dp);
                    }
                }
            }
        }


        // Mảng tọa độ các cửa hàng để show lên map
        $geos = [];
        $shops = $product->shops()->distinct()->get();
        foreach($shops as $sh) {
            if($sh->getLatitude() != 0 && $sh->getLongitude() != 0) {
                $geos[] = [
                    'lat'  => $sh->getLatitude(),
                    'long' => $sh->getLongitude(),
                    'title' => $sh->getAlias()
                ];
            }
        }


        // Setter something
        $product->post_count = $countPosts;
        $product->video_count = $countVideos;
        $product->question_count = $questions->total();
        $product->classifield_count = $classifields->total();

        // open-graph
        $openGraph = OpenGraph::setTitle($this->metadata->getTitle())
						->setType("product")
						->setUrl($request->url())
						->setImage( asset($product->getImage()) )
						->setDescription($this->metadata->getMetaDescription())
						->facebook(function($facebook) {
							$facebook->setAdmins(100001247771720);
						})
						->google(function($google) use($picture, $product) {
							$google->setName($this->metadata->getTitle());
							$google->setDescription($this->metadata->getMetaDescription());
							$google->setImage( asset($product->getImage()) );
						})
						->twitter(function($twitter) use($request, $picture, $product) {
							$twitter->setCard('product');
						    $twitter->setSite($request->url());
						    $twitter->setTitle($this->metadata->getTitle());
						    $twitter->setDescription($this->metadata->getMetaDescription());
						    $twitter->setImage( asset($product->getImage()) );
                            $twitter->setProduct([
                                'label1' => $this->metadata->getTitle(),
                                'data1'  => $product->getPrice()
                            ]);
						})
						->generate();

        return view('frontend/product/detail', compact('product', 'questions' ,
                                                        'productDetail' ,
                                                       'productImagesFull', 'productImagesSmall' ,
                                                       'posts', 'relatedProducts', 'prices',
                                                       'dbProductPrices' , 'videos', 'countVideos' ,
                                                       'totalShopSell', 'reviewPosts', 'likeNumber',
                                                       'countReviewPosts', 'countPosts', 'opponents',
                                                       'countRating', 'avgRatingValue', 'classifields', 'brand',
                                                       'picture', 'arrayPrependTags', 'arrayAppendTags' ,'openGraph',
                                                       'shopAds', 'geos'));
    }


   /**
    * Sản phẩm mới nhất, trang sản phẩm khi click vào menu sản phẩm
    * @return View
    */
    public function getNewest(Request $request) {

        $products = $this->product->getNewProductsPaginated(20, $request->all(), $request->all());

        $arraySort = $this->getArraySort();

        $this->metadata->setTitle('Sản phẩm mới nhất, kiểm tra giá, so sánh giá, tiêu dùng thông minh');
        $this->metadata->setMetaKeyword('so sánh giá, điện thoại mới, đồ công nghệ, giá rẻ, iphone6, iphone6s...');
        $this->metadata->setDescription('Giá máy tính, giá điện thoại di dộng, giá rẻ, so sánh giá');

        if($request->get('layout') == 'grid') {
            $view = 'frontend/product/newest_grid';
        } else {
            $view = 'frontend/product/newest_list';
        }

        // Biến xác định đang ở trang nào
        // Trang hsx cũng sử dụng biến này để xác định hsx nào đang active
        $requestId = 0;


        // Phần này phục vụ việc load thêm dữ liệu scroll pagination
        if( $request->ajax() ) {
            $totalPage = ceil($products->total() / $products->perPage());

            if($request->get('page') > $totalPage) {
                return response()->json([
                    'code' => 0
                ]);
            } else {
                return response()->json([
                    'code'                 => 1,
                    'currentPage'          => (int) $request->get('page'),
                    'html'                 => $this->parseHtmlProductItem($products),
                    'html_pagination'      => pagination($products, $products->total(), $products->perPage(), $request->get('page')),
                    'html_button_viewmore' => $this->htmlButtonLoadMoreProduct($request->get('page'))
                ]);
            }

        }

        return view($view, compact('products', 'arraySort', 'requestId'));
   }


    /**
    * Sản phẩm hot
    * @return View
    */
    public function getHot(Request $request) {
        $products = $this->product->getHotProductsPaginated(20, $request->all(), $request->all());
        $this->metadata->setTitle('Sản phẩm hot nhất, kiểm tra giá, so sánh giá, tiêu dùng thông minh');
        $this->metadata->setMetaKeyword('so sánh giá, so sánh giá hot nhất, điện thoại mới, đồ công nghệ, giá rẻ, iphone6, iphone6s...');
        $this->metadata->setDescription('Giá máy tính, giá điện thoại di dộng, giá rẻ, so sánh gía, hot nhất');
        return view('frontend/product/hot', compact('products'));
    }


   /**
    * Sản phẩm giá rẻ
    * @return View
    */
   public function getCheap() {

   }


   /**
    * Trang danh sách máy tính, điện thoại, máy tính bảng
    * @param  Request $request
    * @return view
    */
   public function getByType($type, $brandSlug = null)
   {
        $request = $this->request;
        $filterArray = [];
        $brand = $this->brand->getBySlug($brandSlug);
        $sort = $request->get('sort');
        $layout = $request->get('layout');
        $device = '';
        $route = '';

        switch ($type) {
            case 'dien-thoai':

                $filterArray = [
                    'device' => Product::PHONE
                ];

                $device = 'Điện thoại';

                $route = 'phone';

                $this->metadata->setTitle('Điện thoại hot nhất, kiểm tra giá, so sánh giá, tiêu dùng thông minh, trang '. $request->get('page', 1));
                $this->metadata->setMetaKeyword('so sánh giá, so sánh điện thoại, so sánh giá hot nhất, điện thoại mới, đồ công nghệ, giá rẻ, iphone6, iphone6s..., trang '. $request->get('page', 1));
                $this->metadata->setDescription('Giá máy tính, điện thoại, giá điện thoại di dộng, giá rẻ, so sánh gía, hot nhất, trang '. $request->get('page', 1));
                break;

            case 'laptop':
                $filterArray = [
                    'device' => Product::LAPTOP
                ];

                $device = 'Laptop';

                $route = 'laptop';

                $this->metadata->setTitle('Laptop hot nhất, kiểm tra giá, so sánh giá, tiêu dùng thông minh, trang '. $request->get('page', 1));
                $this->metadata->setMetaKeyword('so sánh giá, so sánh giá laptop ,so sánh giá hot nhất, điện thoại mới, đồ công nghệ, giá rẻ, iphone6, iphone6s..., trang '. $request->get('page', 1));
                $this->metadata->setDescription('Giá máy tính, laptop, giá điện thoại di dộng, giá rẻ, so sánh gía, hot nhất, trang '. $request->get('page', 1));
                break;

            case 'may-tinh-bang':
                $filterArray = [
                    'device' => Product::TABLET
                ];

                $device = 'Máy tính bảng';

                $route = 'tablet';

                $this->metadata->setTitle('Máy tính bảng hot nhất, kiểm tra giá, so sánh giá, tiêu dùng thông minh, trang '. $request->get('page', 1));
                $this->metadata->setMetaKeyword('so sánh giá, so sánh máy tính bảng, so sánh giá hot nhất, điện thoại mới, đồ công nghệ, giá rẻ, iphone6, iphone6s..., trang '. $request->get('page', 1));
                $this->metadata->setDescription('Giá máy tính, máy tính bảng ,giá điện thoại di dộng, giá rẻ, so sánh gía, hot nhất, trang '. $request->get('page', 1));
                break;

            case 'may-anh':
                $filterArray = [
                    'device' => Product::CAMERA
                ];

                $device = 'Máy ảnh';

                $route = 'camera';

                $this->metadata->setTitle('Máy ảnh hot nhất, kiểm tra giá, so sánh giá, tiêu dùng thông minh, trang '. $request->get('page', 1));
                $this->metadata->setMetaKeyword('so sánh giá, so sánh máy ảnh, so sánh giá hot nhất, điện thoại mới, đồ công nghệ, giá rẻ, iphone6, iphone6s..., trang '. $request->get('page', 1));
                $this->metadata->setDescription('Giá máy tính, máy ảnh ,giá điện thoại di dộng, giá rẻ, so sánh gía, hot nhất, trang '. $request->get('page', 1));
                break;
        }

        if($brand) {
            $filterArray['brand_id'] = $brand->getId();
        }

        $filterArray['type'] = $this->request->get('type');

        $products = $this->product->getProductsPaginated(20, $filterArray, $this->prepareSortParams($sort));

        $arraySort = $this->getArraySort();

        $requestId = $brand ? $brand->getId() : 0;
        $sortType  = $sort;

        if($request->get('layout') == 'grid') {
            $view = 'frontend/product/type_grid';
        } else {
            $view = 'frontend/product/type';
        }


        // Phần này phục vụ việc load thêm dữ liệu scroll pagination
        if( $request->ajax() ) {
            $totalPage = ceil($products->total() / $products->perPage());

            if($request->get('page') > $totalPage) {
                return response()->json([
                    'code' => 0
                ]);
            } else {
                return response()->json([
                    'code'                 => 1,
                    'currentPage'          => (int) $request->get('page'),
                    'html'                 => $this->parseHtmlProductItem($products),
                    'html_pagination'      => pagination($products, $products->total(), $products->perPage(), $request->get('page')),
                    'html_button_viewmore' => $this->htmlButtonLoadMoreProduct($request->get('page'))
                ]);
            }

        }

        return view($view, compact('products', 'requestId', 'arraySort', 'type', 'sortType', 'device', 'route'));
   }


   public function getDataPricesOfProduct($product, $take = 2, $sort = []) {
      // Giá lấy từ search engine
      $ignore = explode(',', $product->getIgnoreKeyword());
      return $this->price->search($product->getKeyword(), 1000, $sort, $ignore);
   }

   public function getUploadPhoto($productId)
   {
       $product = $this->product->getById($productId);
       return view('frontend/product/upload', compact('product'));
   }


    public function postUploadPhoto(Request $request, $productId)
    {
        $product = $this->product->getById($productId);
        $image        = \App::make('ImageFactory');
        $thumbs       = \Config::get('image.array_crop_image');
        $resultUpload = $image->upload('file', PATH_UPLOAD_IMAGE_PRODUCT, $thumbs, 'crop');

        if($resultUpload['status'] > 0) {

            $productImage = new ProductImage();
            $productImage->product_id = $product->getId();
            $productImage->image = $resultUpload['filename'];
            $productImage->save();

            return response()->json(['statusCode' => 200, 'url_back' => $product->getUrl()]);
        }

        return response()->json(['statusCode' => 400]);
    }


   /**
    * Ajax lấy bảng html so sánh giá
    *
    * @param  Request $request
    *
    * @return html
    */
   public function ajaxGetPricesTable(Request $request) {
        $page      = $request->get('page');
        $sort      = $request->get('sort');
        $take      = $request->get('take');
        $productId = $request->get('product_id');
        $priceId   = $request->get('price_id');

        $product = $this->product->getById($productId);

        $dbProductPrices = $this->price->getPricesGroupByShopPaginated($product, $take, $this->getSortParams($sort));

        if($dbProductPrices->count()) {
            return response()->json([
                'code' => 1,
                'html' => view('frontend/product/includes/prices_table', compact('dbProductPrices', 'product'))->render()
            ]);

        }

        return response()->json([
            'code' => 0,
            'html' => ''
        ]);
   }

   private function getSortParams($sortValue = null) {

        switch ($sortValue) {
            // Mới nhất
            case 1:
                return ['updated_at' => 'DESC'];

            // Cũ nhất
            case 2:
                return ['updated_at' => 'ASC'];

            // Uy tín giảm dần
            case 3:
                return ['rank' => 'ASC'];

            // Uy tín tăng dần
            case 4:
                return ['rank' => 'DESC'];

            // Giá tăng dần
            case 5:
                return ['price' => 'ASC'];

            // Giá giảm dần
            case 6:
                return ['price' => 'DESC'];

            default:
                return ['price' => 'ASC'];
      }
   }


   public function ajaxLoadPricesViewMore(Request $request)
   {
        $productId = $request->get('product_id');
        $priceId   = $request->get('price_id');
        $sort      = $request->get('sort');
        $source    = $request->get('source');
        $sourceId  = (int) $request->get('source_id');

        $product = $this->product->getById($productId);

        $dbProductPrices = $this->price->getPricesOfProduct($product, ['excpet_price_ids' => [$priceId], 'source' => $source, 'source_id' => $sourceId], $this->getSortParams($sort));

        return view('frontend/product/includes/loadMorePriceItems', compact('dbProductPrices', 'product'));
   }


   public function ajaxGetMinPrice(Request $request)
   {
        $productId = $request->get('product_id');
        $product   = $this->product->getById($productId);

        // Nếu giá thấp nhất với giá hiện tại khác nhau thì cập nhật giá thấp nhất

        $minPrice = $this->price->getMinPriceOfProduct($product);

        // Cập nhật giá thấp nhất
        $this->product->update(['price' => $minPrice, 'min_price' => $minPrice], ['id' => $productId]);

        return response()->json([
            'price'     => $minPrice,
            'price_str' => formatCurrency($minPrice),
            'code'      => 1
        ]);
   }


   public function ajaxGetTotalShop(Request $request)
   {
        $productId = $request->get('product_id');
        $product   = $this->product->getById($productId);

        $totalShop = $this->price->countStoreByProduct($product);

        $this->product->update(['total_shop' => $totalShop, 'total_shop_update' => $totalShop], ['id' => $productId]);

        return response()->json([
            'total_shop' => $totalShop,
            'code'       => 1
        ]);
   }


   public function ajaxViewmoreQuestion(Request $request)
   {
        $product   = $this->product->getById((int) $request->get('product_id'));
        $perPage   = $request->get('per_page');
        $questions = $this->question->getQuestionProductPaginated($product, $perPage);
        return view('frontend/product/includes/loadmoreQuestion', compact('questions'));
   }


   public function ajaxRating(Request $request)
   {
        $productId = $request->get('product_id');
        $ip        = $request->get('ip');
        $value     = $request->get('value');

        $product = $this->product->getById($productId);
        $user = \Auth::user();

        if(!\Auth::check()) {
            \Session::put('redirect', $product->getUrl());
            return response()->json(['code' => 2, 'message' => 'Bạn cần đăng nhập để thực hiện tính năng này', 'url_login' => route('auth.login_form')]);
        }

        if($this->rate->isUserRated($user->getId(), $productId)) {
            return response()->json(['code' => 0, 'message' => 'Bạn đã đánh giá sản phẩm này trước đây']);
        }

        if($this->rate->rating($productId, $value, $ip, $user->getId())) {
            return response()->json(['code' => 1, 'message' => 'Cảm ơn bạn đã đánh giá sản phẩm này']);
        }

        return response()->json(['code' => 0, 'message' => 'Có lỗi xảy ra vui lòng thử lại sau']);
    }


    public function ajaxFindBrands(Request $request)
    {
        $q = $request->get('q');

        // Biến xác định hsx nào đang active
        $currentId = (int) $request->get('current_id');

        $brands   = $this->brand->searchByName($q);
        $response = [];

        foreach($brands as $brand) {
            $response[] = [
                'id'   => $brand->getId(),
                'name' => $brand->getName(),
                'url'  => $brand->getUrl(),
                'html' => $brand->htmlPresenter()->getItem($currentId)
            ];
        }

        return response()->json($response);
    }


    /**
     * Build prepend tags
     * @param  Product $product
     * @return array
     */
    private function buildPrependTags(Product $product) {
        $prependTags = [
            'Mua', 'Bán', 'So sánh giá', 'Thông tin', 'Thông số kỹ thuật', 'Giá bán'
        ];

        foreach($prependTags as $key => $tag) {
            $prependTags[$key] = $tag . ' ' . $product->getName();
        }

        return $prependTags;
    }


    /**
     * Build append tags
     * @param  Product $product
     * @return array
     */
    private function buildAppendTags(Product $product) {
        $tags = [
            'hàng công ty', 'giá rẻ', 'giá sock', 'khuyến mại khủng', 'full box', 'mới', 'giá gốc', 'chính hãng', 'xách tay', 'hot nhất', 'mua nhiều nhất', 'giảm giá nhiều nhất', 'yêu thích nhất'
        ];

        foreach($tags as $key => $tag) {
            $tags[$key] = $product->getName() . ' ' . $tag;
        }

        return $tags;
    }



    public function ajaxShopAdsClick(Request $request) {
        $productId = $request->get('product_id');
        $shopId = $request->get('shop_id');
        $auctionId = $request->get('auc');

        $product = $this->product->getById($productId);

        // Luu click
        $this->auctionClick->saveClick($auctionId, $request->ip());

        // Kiểm tra xem thằng nào đang đăng ký đấu giá click
        // trừ tiền của nó
        $auctions = $this->auction->getAvaiableAuctionsByProduct($product);

        foreach($auctions as $auction) {
            if($auction->shop_id == $shopId) {
                // Trừ tiền trong tài khoản user
                $this->user->deductionMoneyUserAccount($auction->creator_id, $auction->money_per_click);
                // Trừ tiền trong ngân sách của chiến dịch
                $this->auction->deductionBudgetAuction($auction->id, $auction->money_per_click);
            }
        }

        return response()->json(['code' => 200]);
    }


    public function getPriceHistories($id, $slug, ProductPriceHistoryRepository $productPriceHistoryRepository)
    {
        $product = $this->product->getById($id);
        $dataChart = $productPriceHistoryRepository->getDataHightChartProduct($product);

        return view('frontend/product/price_history', compact('product', 'dataChart'));
    }



    public function ajaxLoadPriceTable(Request $request)
    {
        $productId = (int) $request->get('product_id');
        $product = $this->product->getById($productId);
        $dbProductPrices = $this->price->getPricesGroupByShopPaginated($product, 10, $this->getSortParams());
        return view('frontend/product/includes/prices_table', compact('product', 'dbProductPrices'));
    }


    /**
     * Chuyển đổi tham số sort thành query
     * @param  string $sort
     * @return array
     */
    public function prepareSortParams($sort = null) {

        switch ($sort) {
            case 'total_shop_desc':
                return ['total_shop' => 'DESC'];

            case 'newest':
                return ['updated_at' => 'DESC'];

            case 'name_asc':
                return ['name' => 'ASC'];

            case 'rate_desc':
                return ['rating_count' => 'DESC'];

            case 'view_desc':
                return ['views' => 'DESC'];

            default:
                return ['updated_at' => 'DESC'];
        }
    }



    private function parseHtmlProductItem($products) {
        $html = '';
        foreach($products as $product) {
            $html .= $product->presenter()->getItemDetail();
        }

        return $html;
    }


    /**
     * Html button load more product
     * @param  int $currentPage
     * @return html
     */
    private function htmlButtonLoadMoreProduct($currentPage) {
        $currentPage = (int) $currentPage;
        $params = $this->request->all();
        $params['page'] = $currentPage + 1;
        $linkNextPage = $this->request->path() . '?' . http_build_query($params);
        return '<a id="btn-link-view-more" href="/'. $linkNextPage .'" class="btn btn-md btn-giaca">Xem thêm</a>';
    }



    /**
     * Get array sort
     * @return array
     */
    private function getArraySort() {
        $arraySort = [
            'hot_updated_at_desc' => 'Hot',
            'newest'          => 'Sản phẩm mới nhất',
            'name_asc'        => 'Alphabet',
            'rate_desc'       => 'Đánh giá nhiều nhất',
            'total_shop_desc' => 'Nhiều người bán',
            'view_desc'       => 'Nhiều người xem'
        ];

        return $arraySort;
    }



    /**
     * Ajax: user đánh giá gian hàng trên sản phẩm
     * @return json
     */
    public function ajaxUserRatingMerchant(Request $request) {
        $rateValue  = (int) $request->get('value');
        $merchantId = (int) $request->get('merchant_id');
        $userId     = \Auth::user()->getId();

        $exists = \DB::table('merchant_rates')->where('user_id', $userId)
                                              ->where('merchant_id', $merchantId)
                                              ->where('value', $rateValue)
                                              ->first();

        if(!$exists) {
            \DB::table('merchant_rates')->insert([
                'user_id'     => $userId,
                'merchant_id' => $merchantId,
                'value'       => $rateValue
            ]);

            return response()->json([
                'code' => 1,
                'message' => 'Bạn đã đánh giá thành công'
            ]);
        }

        return response()->json([
            'code' => 0,
            'message' => 'Bạn đã đánh giá gian hàng này trước đây'
        ]);
    }



    /**
     * Lưu thông tin đánh giá của khách hàng với sản phẩm này
     * price này, gian hàng này
     * @param  Request $request
     * @return json
     */
    public function ajaxUserReportMerchant(Request $request) {
        $productId  = (int) $request->get('product_id');
        $priceId    = (int) $request->get('price_id');
        $merchantId = (int) $request->get('merchant_id');
        $type       = (int) $request->get('type');
        $userId     = \Auth::user()->getId();

        $exist = MerchantReport::where('customer_id', $userId)
                               ->where('product_id', $productId)
                               ->where('merchant_id', $merchantId)
                               ->where('price_id', $priceId)
                               ->where('type', $type)
                               ->count();

        if($exist) {
            return response()->json(['code' => 0, 'message' => 'Bạn đã báo lỗi này trước đây']);
        }

        MerchantReport::insert([
            'customer_id' => $userId,
            'product_id'  => $productId,
            'price_id'    => $priceId,
            'merchant_id' => $merchantId,
            'type'        => $type,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s')
        ]);

        return response()->json(['code' => 1, 'message' => 'Cảm ơn bạn đã báo lỗi']);
    }
}
