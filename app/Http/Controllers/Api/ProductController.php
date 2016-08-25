<?php

namespace Nht\Http\Controllers\Api;

use Illuminate\Http\Request;

use Nht\Http\Requests;
use Illuminate\Routing\Controller as BaseController;

use Nht\Hocs\Products\ProductRepository;
use Nht\Hocs\ProductLikes\ProductLikeRepository;

class ProductController extends BaseController {
   public function __construct(ProductRepository $product, ProductLikeRepository $like) {
      $this->product = $product;
      $this->like    = $like;
   }

   public function addLike(Request $request, $productId) {
      $product = $this->product->getById($productId);
      $ip = $request->getClientIp();
      $exist = $this->like->isExist($product, $ip);
      if($exist) {
         if($this->like->removeLike($product, $ip)) {
            return response()->json(['code' => 2, 'message' => 'remove Like susccess']);
         } else {
            return response()->json(['code' => 0, 'message' => 'error remove Like']);
         }
      } else {
         if($this->like->addLike($product, $ip)) {
            return response()->json(['code' => 1, 'message' => 'add like susccess']);
         } else {
            return response()->json(['code' => 0, 'message' => 'add like error']);
         }
      }
   }
}