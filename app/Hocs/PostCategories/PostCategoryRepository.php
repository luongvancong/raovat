<?php namespace Nht\Hocs\PostCategories;

interface PostCategoryRepository {
	public function getCategories($perPage = 25, $filterArray = array());
	public function getAllCategories();
}