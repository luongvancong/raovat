<?php

namespace Nht\Hocs\Products;

/**
 * Interface description.
 *
 * @author	AlvinTran
 */
interface ProductRepository
{
	public function getRelatedProducts(Product $product, $item = 5);

	public function countProductsByBrand($brand);

	public function getProductsPaginated($perPage = 20, $filterArray = array(), array $sortArray = array());


    public function getByName($name, $take = 20);

    public function getByIds(array $ids);

    /**
     * Lấy tất cả sản phẩm có thể bán được
     @return Collection
     */
    public function getAllProductAvaiables();


    /**
     * Sản phẩm mới
     * @param  integer $item
     * @param  array $filter
     * @param  array $sort
     * @return Collection
     */
    public function getNewProducts($item = 12, array $filter = array(), array $sort = array());


    /**
     * Sản phẩm hot
     * @param  integer $item
     * @param  array $filter
     * @param  array $sort
     * @return Collection
     */
    public function getHotProducts($item = 12, array $filter = array(), array $sort = array());


    /**
     * Lấy sản phẩm có nhiều cửa hàng bán
     * @param  integer $take
     * @param  array $filter
     * @param  array $sort
     * @return Collection
     */
    public function getProductsHaveMoreShop($take = 20, array $filter = array(), array $sort = array());


    /**
     * Lấy sản phẩm đã có sự thay đổi giá
     * @param  integer $take
     * @return Collection
     */
    public function getProductsHaveChangePrice($take = 20, array $filter = array(), array $sort = array());


    /**
     * Lấy sản phẩm có nhiều hỏi đáp nhất
     * @param  integer $take
     * @return Collection
     */
    public function getProductsHaveMostQuestion($take = 20, array $filter = array(), array $sort = array());


    /**
     * Gắn điều kiện query chung vào câu query
     * @param  Model/DB $query
     * @return void
     */
    public function chainGlobalQueryCondition($query);

}