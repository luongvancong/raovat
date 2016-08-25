<?php

namespace Nht\Hocs\Products;

use Nht\Hocs\Core\BaseRepository;
use Nht\Hocs\Products\Product;
use Illuminate\Support\Collection;
use Input;

use Nht\Hocs\ProductImages\ProductImage;
use Xss;

/**
 * Class DbSettingRepository.
 *
 * @author	SaturnLai
 */
class DbProductRepository extends BaseRepository implements ProductRepository
{
	protected $model;
	protected $client;

	public function __construct(Product $model)
	{
		$this->model     = $model;
	}



	public function getRelatedProducts(Product $product, $item = 5) {
		$query = $this->model->where('id', '<>', $product->getId())
								 ->where('brand', $product->getBrand())
								 ->orderBy('updated_at', 'DESC')
								 ->take($item);

		$query = $this->chainGlobalQueryCondition($query);

		return $query->get();
	}

	public function getNewProducts($item = 12, array $filter = array(), array $sort = array()) {
		$query = $this->model->orderBy('news_count_7day_ago', 'DESC')
						     ->orderBy('data_count_7day_ago', 'DESC')
						     ->orderBy('updated_at', 'DESC')
						     ->where('new', 1);

		$query = $this->chainGlobalQueryCondition($query);

		$type = array_get($filter, 'type');
		if($type > 0) {
			$query->where('type', $type);
		}

        return $query->take($item)
					->get();
	}

	public function getHotProducts($item = 12, array $filter = array(), array $sort = array()) {
		$time      = strtotime('-7 days');
		$startTime = date('Y-m-d 00:00:00', $time);
		$endTime   = date('Y-m-d 23:59:59');

		$query = $this->model->orderBy('post_count', 'DESC')
							->orderBy('updated_at', 'DESC')
						   ->where('hot', 1);

		$query = $this->chainGlobalQueryCondition($query);

		$type = array_get($filter, 'type');
		if($type > 0) {
			$query->where('type', $type);
		}

		$queryCount = clone $query;

		$countHot = $queryCount->whereBetween('hot_updated_at', [$startTime, $endTime])->count();

		// Nếu số sp hot ko đủ thì bỏ qua lấy các sản phẩm hot trong 7 ngày
		// ngược lại nếu đủ thì tiếp tục lấy
		if( $countHot < 5 ) {
			return $query->take($item)->get();
		}

		return $query->whereBetween('hot_updated_at', [$startTime, $endTime])
					 ->orderBy('post_count', 'DESC')
					 ->orderBy('updated_at', 'DESC')
				     ->take($item)->get();
	}



	public function countProductsByBrand($brand) {
		return $this->model->where('brand_id', $brand->getId())->count();
	}



	public function getNewProductsPaginated($perPage = 20, $filterArray = array(), $sortArray = array()) {
		$brand = Xss::clean(array_get($filterArray, 'brand'));
		$type  = array_get($filterArray, 'type');
		$sort  = Xss::clean(array_get($sortArray, 'sort'));

		$query = $this->model->whereRaw(1);

		$query = $this->chainGlobalQueryCondition($query);

		if($brand) {
			$query->where('brand', 'LIKE', '%'. $brand .'%');
		}

		if($sort == 'name_asc') {
			$query->orderBy('name', 'ASC');
		}
		else if($sort == 'newest') {
			$query->orderBy('updated_at', 'DESC');
		}
		else if($sort == 'rate_desc') {
			$query->orderBy('rating_count', 'DESC');
		}
		else if($sort == 'total_shop_desc') {
			$query->orderBy('total_shop', 'DESC');
		}
		else if($sort == 'view_desc') {
			$query->orderBy('views', 'DESC');
		}
		else if($sort == 'hot_updated_at_desc') {
			$query->orderBy('hot_updated_at', 'DESC');
			$query->orderBy('total_shop', 'DESC');
		}
		else {
			$query->orderBy('updated_at', 'DESC');
		}


		switch ($type) {
			case 'hot':
				$query->where('hot', 1);
				break;

			default:
				# code...
				break;
		}

		return $query->paginate($perPage);
	}


	public function getHotProductsPaginated($perPage = 20, $filterArray = array(), $sortArray = array()) {
		$brand = Xss::clean(array_get($filterArray, 'brand'));
		$sort  = Xss::clean(array_get($sortArray, 'sort'));

		$query = $this->model->where("hot", 1);

		if($brand) {
			$query->where('brand', 'LIKE', '%'. $brand .'%');
		}

		if($sort == 'name_asc') {
			$query->orderBy('name', 'ASC');
		}
		else if($sort == 'newest') {
			$query->orderBy('updated_at', 'DESC');
		}
		else {
			$query->orderBy('updated_at', 'DESC');
		}

		return $query->paginate($perPage);
	}



	public function getByIds(array $ids) {
		return $this->model->whereIn('id', $ids)->orderBy('updated_at', 'DESC')->get();
	}


	public function getAllWithPaginate($filter = [], $pageSize = 20)
	{
		if ( ! empty($filter))
		{
			foreach ($filter as $key => $value)
			{
				if ($value == '')
				{
					unset($filter[$key]);
				}
			}
			return $this->model->where($filter)->orderBy('id', 'DESC')->paginate($pageSize);
		}

		return $this->model->orderBy('id', 'DESC')->paginate($pageSize);
	}


	public function getProductsPaginated($perPage = 20, $filterArray = array(), array $sortArray = array()) {
		$query = $this->model->whereRaw(1);

		$this->buildQueryWithParams($query, $filterArray);

		$query = $this->chainGlobalQueryCondition($query);

		foreach($sortArray as $key => $value) {
			$query->orderBy($key, $value);
		}

		return $query->orderBy('id', 'DESC')->paginate($perPage);
	}

	/**
	 * Binding params to query
	 *
	 * @param  [type] &$query
	 * @param  array  $filterArray
	 * @return void
	 */
	private function buildQueryWithParams(&$query, array $filterArray) {
		$id      = (int) array_get($filterArray, 'id');
		$name    = array_get($filterArray, 'name');
		$price   = (int) array_get($filterArray, 'price');
		$type    = array_get($filterArray, 'type');
		$brandId = (int) array_get($filterArray, 'brand_id');
		$device  = (int) array_get($filterArray, 'device');

		if($brandId) {
			$query->where('brand_id', $brandId);
		}

		switch ($device) {
			case Product::LAPTOP:
				$query->where('is_laptop', 1);
				break;

			case Product::TABLET:
				$query->where('is_tablet', 1);
				break;

			case Product::PHONE:
				$query->where('is_smartphone', 1);
				break;

			case Product::CAMERA:
				$query->where('is_camera', 1);
				break;
		}

		switch ($type) {
			case 'hot':
				$query->where('hot', 1);
				break;

			case 'banner':
				$query->where('is_banner', 1);

			default:
				# code...
				break;
		}

		if($id > 0) {
			$query->where('id', $id);
		}

		if($name) {
			$query->where('name', 'LIKE', '%'. $name .'%');
		}

		if($price > 0) {
			$query->where('price', $price);
		}
	}


	public function getBannerProducts($take = 5) {
		$products = $this->model->where('is_banner', 1)->take($take)->orderBy('is_banner_time', 'DESC')->get();
		return $products;
	}


	public function getByName($name, $take = 20) {
		return $this->model->where('name', 'LIKE', '%'. $name .'%')->take($take)->orderBy('name', 'ASC')->get();
	}



    public function getAllProductAvaiables() {
    	return $this->model->where('price', '>', 0)->orderBy('updated_at', 'DESC')->get();
    }


    public function getProductsHaveMoreShop($take = 20, array $filter = array(), array $sort = array()) {
    	$query = $this->model->where('total_shop', '>', 0);

    	$query = $this->chainGlobalQueryCondition($query);

    	$type = array_get($filter, 'type');

    	if($type > 0) {
    		$query->where('type', $type);
    	}

	   return $query->orderBy('total_shop', 'DESC')
				   ->orderBy('updated_at', 'DESC')
				   ->take($take)
				   ->get();
    }


    public function getProductsHaveChangePrice($take = 20, array $filter = array(), array $sort = array()) {
    	$query = $this->model->where('has_change_price', 1);

    	$query = $this->chainGlobalQueryCondition($query);

    	$type = array_get($filter, 'type');

    	if($type > 0) {
    		$query->where('type', $type);
    	}

		return $query->orderBy('updated_at', 'DESC')
				    ->take($take)
				    ->get();
    }

    public function getProductsHaveMostQuestion($take = 20, array $filter = array(), array $sort = array()) {
    	$query = $this->model->where('question_count', '>', 0);

    	$query = $this->chainGlobalQueryCondition($query);

    	$type = array_get($filter, 'type');

    	if($type > 0) {
    		$query->where('type', $type);
    	}

    	return $query->orderBy('question_count', 'DESC')
				    ->orderBy('updated_at', 'DESC')
				    ->take($take)
				    ->get();
    }

    public function chainGlobalQueryCondition($query) {
    	return $query->where('price', '>', 0)
    				->whereRaw("price >= avg_price / 2");
    }

}