<?php namespace Nht\Hocs\Tags;

use Nht\Hocs\Products\Product;

interface TagRepository {
    public function take($take = 10);


    /**
     * Get paginated
     * @param  int $perPage
     * @param  array  $with
     * @param  array  $filterArray
     * @param  array  $sortArray
     * @return Paginator
     */
    public function getPaginated($perPage, array $with = array(), array $filterArray = array(), array $sortArray = array());

    /**
     * [getPositions description]
     * @param  Tag    $tag
     * @return array
     */
    public function getPositions(Tag $tag);

    /**
     * Save positions by tag
     * @param  Tag    $tag
     * @param  array  $positionIds
     * @return boolean
     */
    public function savePositions(Tag $tag, array $positionIds);


    /**
     * Get tag by positions
     * @param  array  $positionIds
     * @return Collection
     */
    public function getByPositions(array $positionIds, $take = 20);


    /**
     * Get all tags by product
     * @param  Product $product
     * @return Tag Collection
     */
    public function getAllTagsByProduct(Product $product);

    public function searchTagByNamePaginated($name, $perPage = 10);

    public function getByName($name);


    public function getBySlug($slug);
}